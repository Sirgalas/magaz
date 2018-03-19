<?php
namespace frontend\modules\gods\controllers;

use common\models\Category;
use common\models\Catgodpost;
use common\models\FrontendSetup;
use common\models\Gods;
use frontend\widget\cat\Cat;
use yii\web\Controller;
use yii\data\ActiveDataProvider;
use backend\models\Urlpriceparser;

/**
 * Default controller for the `gods` module
 */
class GodsController extends Controller
{
    /**
     * Renders the index view for the module
     * @return string
     */
    public function actionIndex()
    {
        return $this->render('index');
    }

    public function actionCategory($slug){
        $category = Category::find()->where(['slug_category'=>$slug])->with('addfeilds')->one();
        
        if($category->parrent_category==0){
            $id = array_unique($this->allid($category->id));
        }else{
            $id = $this->getIds($category->id);
        }
        $godsQuery= Gods::find();
        if ($id !== null) {
            $godsQuery->where(['id' => $id])->andWhere('have!=1')->with('prise','images','addfeilds','ratingCountAggregation','ratingSumAggregation','category','categorys')->orderBy(['upedate_at'=>SORT_DESC]);
        }
        $serialDataProvider = new ActiveDataProvider([
            'query' => $godsQuery,
            'pagination' => [
                'pageSize' => 24,
            ],
        ]);
        $actionImage=FrontendSetup::findOne(['key_setup'=>'action','description'=>'image']);
        if(empty($godsQuery)){
            return $this->redirect('site/error');
        }else {
            return $this->render('list', [
                'category' => $category,
                'productsDataProvider' => $serialDataProvider,
                'actionImage'=>json_decode($actionImage->vaelye)
            ]);
        }
    }
    public function actionOnegods($slug){
        $models=Gods::find()->where(['slug_gods'=>$slug])->with('prise','images','addfeilds','category','prise.tablesize')->one();
        $category= array_filter($models->category, function($item) {
            return $item->size != null;
        });
        if(empty($models)){
            return $this->redirect('site/error');
        }else {
            return $this->render('onegods', [
                'models' => $models,
                'category'=> array_shift($category)
            ]);
        }
    }
    
    public function allid($id){
        $idGoods= array();
        $idCat= array();
       if($id==65) {
           $goods=Gods::find()->orderBy(['id'=>SORT_DESC])->limit(100)->all();
           foreach ($goods as $good){
               $idGoods[]=$good->id;
           }
       }else{
           $catId = Category::find()->where(['parrent_category' => $id])->all();
           if (!empty($catId)) {
               foreach ($catId as $ids) {
                   $idCat[] = $ids->id;
               }
           } else {
               $idCat[] = $id;
           }

           $goodsid = Catgodpost::find()->where(['id_cat' => $idCat])->all();
           foreach ($goodsid as $goods) {
               $idGoods[] = $goods->id_gods;
           }
       }
        return $idGoods;
    }

    public function getIds($categories){
            $godsId=Catgodpost::find()->where(['id_cat'=>$categories])->all();
            $idGods=array();
            foreach ($godsId as $id){
                if(isset($id)){
                    $idGods[] = $id->id_gods;
                }
            }
            return $idGods;
    }
}
