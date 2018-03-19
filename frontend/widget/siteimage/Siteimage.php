<?php
namespace frontend\widget\siteimage;

use common\models\FrontendSetup;
use yii\base\Widget;

class Siteimage extends Widget{
    public $name;
    public function init(){
        parent::init();
    }
    public function run(){
        $setup = FrontendSetup::findOne(['key_setup'=>$this->name]);
        $theImage=json_decode($setup->vaelye);
        return $this->render('html',[
            'image'=>$theImage->image
        ]);
    }
}