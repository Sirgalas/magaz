<?php
namespace frontend\widget\cat;


use Yii;
use common\models\Category;
use common\models\FrontendSetup;
use common\models\Gods;
use yii\base\Widget;

class Cat extends Widget{
    public $location;
    public $carusel;
    public $classes;
    public $FrontSet;
    public function init(){
        parent::init();
    }
    public function run(){
        $loc=$this->location;
        $cats=array_filter($this->FrontSet,function ($item) use ($loc) {
            return $item->key_setup == $loc;
        });
        foreach ($cats as $cat ){
            $json=json_decode($cat->vaelye);
        }
        if($this->carusel==false){
            return $this->render('not',[
                'json' => $json,
            ]);
        }
        elseif($json->id==65){
            $goods=Gods::getDb()->cache(function (){
                return Gods::find()->where(['have'=>0])->orderBy(['id'=>SORT_DESC])->with('prise','category','images','addfeilds')->limit(100)->all();
            }) ;

            return $this->render('news', [
                'json' => $json,
                'classes' => $this->classes,
                'goods'     =>$goods
            ]);
        }else {


                $category = Category::getDb()->cache(function ()use($json){
                    return Category::find()->where(['id' => $json->id])->with('gods','gods.prise', 'gods.images','gods.category','gods.addfeilds')->one();
                });
                  return $this->render('html', [
                'json' => $json,
                'category' => $category,
                'classes' => $this->classes,
                //'goods'     => $goods
            ]);
        }
    }
}