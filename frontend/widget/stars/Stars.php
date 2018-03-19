<?php

namespace frontend\widget\stars;


use yii\base\Widget;
use Yii;

class Stars extends Widget{
    public $value;

    public function init(){
        parent::init();
    }
    public function run(){
        return $this->render('html',[
            'value'=>$this->value
        ]);
    }
}