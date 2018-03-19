<?php

namespace frontend\modules\search\controllers;

use common\models\Category;
use Yii;
use common\models\Addlfeild;
use common\models\Gods;
use yii\web\Controller;
use yii\data\ActiveDataProvider;
use yii\db\Expression;
use frontend\modules\search\models\SearchModel;
/**
 * Default controller for the `search` module
 */
class SearchController extends Controller
{
    /**
     * Renders the index view for the module
     * @return string
     */
    public function actionIndex($query)
    {
        $arr=array(" ",'-',':','"','&laquo;','&raquo;',"«","»") ;
        $querys=str_replace($arr,'%',$query);
        $expression = new Expression('"%'.$querys.'%"');
        $addFeilds=Addlfeild::find()->where(['like','value',$query])->andWhere(['key_feild'=>'article'])->all();
        $idaddfeild=array();
        foreach ($addFeilds as $addFeild){
        	if(isset($addFeild->goods))
            	$idaddfeild[]=$addFeild->goods->id;
        }
        if(!empty($idaddfeild)){
            $goods=Gods::find()->where(['id'=>$idaddfeild])->with('prise', 'images', 'addfeilds', 'ratingCountAggregation', 'ratingSumAggregation');
        }else {
            $goods = Gods::find()->where(['or', ['like', 'title', $expression]])->with('prise', 'images', 'addfeilds', 'ratingCountAggregation', 'ratingSumAggregation')->orderBy(['id' => SORT_DESC]);
        }
        $goodsDataProvider = new ActiveDataProvider([
        'query' => $goods,
        'pagination' => [
            'pageSize' => 24,
        ],
        ]);
        return $this->render('index',[
            'goodsDataProvider'     =>  $goodsDataProvider,
            'breadcrumbs'           =>  $query
        ]);
    }
    public function actionFilter(){
        $model= new SearchModel();
        if ($model->load(Yii::$app->request->get())) {
            $arrPost = Yii::$app->request->get("SearchModel");
            if (isset($arrPost["parent"])) {
                $category = Category::findOne($arrPost["parent"]);
                $categoryAll = null;
            } else {
                $category = null;
                $categoryAll = 'full';
            }
            $searchId = $model->idgoods($arrPost, $categoryAll);
            if (isset($arrPost["sort"])) {
                if ($arrPost["sort"] == 0) {
                    $varSort = 'SORT_ASC';
                } else {
                    $varSort = 'SORT_DESC';
                }
                $goods = Gods::find()->where(['abh_gods.id' => $searchId, 'have' => 0])->joinWith('prise')->orderBy(['abh_prise.price1' => $varSort])->with('images', 'addfeilds', 'ratingCountAggregation', 'ratingSumAggregation');
            } else {
                $goods = Gods::find()->where(['id' => $searchId, 'have' => 0])->with('images', 'addfeilds', 'ratingCountAggregation', 'ratingSumAggregation');
            }

            $filterDataProvider = new ActiveDataProvider([
                'query' => $goods,
                'pagination' => [
                    'pageSize' => 24,
                ],
            ]);
            return $this->render('html', [
                'filterDataProvider' => $filterDataProvider,
                'breadcrumbs' => 'фильтр поиска',
                'category' => $category
            ]);
            /*return var_dump($searchId);*/
        }
    }
}
