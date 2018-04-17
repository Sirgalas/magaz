<?php
namespace frontend\widget\social;

use common\models\FrontendSetup;
use yii\base\Widget;

class Social extends Widget{
    public function init(){
        parent::init();
    }
    public function run(){
        $social=FrontendSetup::find()->where(['description'=>'social'])->all();
        return $this->render('html',[
            'social'=>$social
        ]);
    }
}