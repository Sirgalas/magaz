<?php

namespace frontend\widget\hederfeild;

use common\models\FrontendSetup;
use yii\base\Widget;

class Hederfeild extends Widget{
    public function init(){
        parent::init();
    }
    public function run(){
        $work=FrontendSetup::find()->where(['key_setup'=>'work'])->one();
        $tel=FrontendSetup::find()->where(['key_setup'=>'tel'])->one();
        return $this->render('html',[
            'work'=>$work,
            'tel'=>$tel
        ]);
    }
}