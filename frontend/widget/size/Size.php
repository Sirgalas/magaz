<?php
namespace frontend\widget\size;

use common\models\Category;
use common\models\FrontendSetup;
use yii\base\Widget;

class Size extends Widget{
    public $models;
    public $target;
    public $category;
    public $set;
    public function init(){
        parent::init();
    }
    public function run(){
        $models = $this->models;
        foreach ($this->category as $cat){
           if($cat->size != null){
               $category=$cat;
               break;
           }
        }
        if($this->target=='goods'){
            return $this->render('goods',[
                'models'=>$models,
                'target'=>$this->target,
                'category'=>$category,
                'set'   => $this->set
            ]);
        }else{
            return $this->render('category',[
                'models'=>$models,
                'target'=>$this->target,
                'category'=>$category,
                'set'   => $this->set
            ]);
        }

    }
}