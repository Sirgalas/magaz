<?php
namespace frontend\widget\description;

use common\models\Addlfeild;

use common\models\FrontendSetup;

use yii\base\Widget;

class Description extends Widget{
    public $model;
    public $name;
    public function init(){
        parent::init();
    }
    public function run(){
        $description=FrontendSetup::findOne(['description'=>'Home']);
        return $this->render('html',[
            'description'=>$description->vaelye
        ]);
    }
}