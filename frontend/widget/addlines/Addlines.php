<?php
namespace frontend\widget\addlines;

use common\models\Addlfeild;

use common\models\Gods;
use common\models\Prise;
use yii\base\Widget;

class Addlines extends Widget{
    public $model;
    public $name;
    public function init(){
        parent::init();
    }
    public function run(){
        $model=Gods::findOne($this->model);
        $whoprise=Prise::findOne($model->prise->whosales_id);
        return $this->render('html',[
            'model'     =>  $model,
            'whoprise'  =>  $whoprise,
            'name'      =>  $this->name,
        ]);
    }
}