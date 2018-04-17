<?php
namespace frontend\widget\recomented;

use common\models\Category;
use common\models\FrontendSetup;
use common\models\Gods;
use yii\base\Widget;
class Recomented extends Widget{
    public $model;
    public function init(){
        parent::init();
    }
    public function run(){
        $titleCat=FrontendSetup::findOne(['key_setup'=>'recomended']);
        $goodsId=array();
        foreach( $this->model as $cat){
            if($cat->parrent_category!=0||$cat->parrent_category!=null) {
                if($cat->id!=7) {
                    if($cat->id!=62) {
                        foreach ($cat->gods as $goods) {
                            $goodsId[] = $goods->id;
                        }
                    }
                }
            }
        }
        $recomented=Category::find()->where(['name'=>$titleCat->vaelye])->with('gods')->one();

        //return var_dump($recomented->gods);
        $arrRecGoods=array();
        foreach ($recomented->gods as $goods){
            $arrRecGoods[]=$goods->id;
        }
        $goodsarr=array_intersect ($arrRecGoods,$goodsId);
        $vargoods=Gods::find()->where(['id'=>$goodsarr,'have'=>0])->orderBy('RAND()')->with('images')->all();
        return $this->render('html',[
            'recomented'=>$vargoods,
            'titleCat'=>$titleCat
        ]);
    }
}
?>