<?php

namespace frontend\widget\carusel;

use common\models\Category;
use common\models\FrontendSetup;
use yii\base\Widget;

class Carusel extends Widget{
    public function init(){
        parent::init();
    }
    public function run(){
        $model= new FrontendSetup();
        $work=FrontendSetup::find()->with('cat')->where(['description'=>'carmenu'])->all();
        $lisritem ='';
        $lisritem = $model->addForCar($work);
        return $this->render('html',[
            'works'=>$lisritem,
        ]);
    }
}