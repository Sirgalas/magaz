<?php
namespace frontend\widget\seo;

use common\models\FrontendSetup;
use yii\base\Widget;

class Seo extends Widget{
    public $addfeilds;
    public $model;
    public $category;
    public $description;
    public $templates;
    public function init(){
        parent::init();
    }
    public function run(){
        if($this->category){
            $title='name';
        }else{
            $title='title';
        }
        return $this->render('html',[
            'addFields'=>$this->addfeilds,
            'model'=>$this->model,
            'title'=>$title,
            'description'=>$this->description,
            'templates'=>$this->templates
        ]);
    }
}