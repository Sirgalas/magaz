<?php
namespace frontend\widget\slider;

use common\models\FrontendSetup;
use yii\base\Widget;

class Slider extends Widget{
    public function init(){
        parent::init();
    }
    public function run(){
        $slider=FrontendSetup::find()->where(['description'=>'slider'])->all();
        return $this->render('html',[
            'slider'=>$slider
        ]);
    }
}