<?php

namespace frontend\modules\office\controllers;

use common\models\Page;
use yii\web\Controller;

/**
 * Default controller for the `office` module
 */
class OfficeController extends Controller
{
    /**
     * Renders the index view for the module
     * @return string
     */
    public function actionCategory(){
            return $this->render('reviews');
    }
    public function actionIndex($slug){
        $model=Page::find()->where(['slug_page'=>$slug])->with('addfeilds')->one();
        if(!$model)
            return $this->redirect('site/error');
        return $this->render('index',[
                'models'=>$model
            ]);
        
    }

    public function actionLinks(){
        $model=Page::findOne(['slug_page'=>'links']);
        if(!$model)
            return $this->redirect('site/error');
        return $this->render('index',[
            'models'=>$model
        ]);
    }

}
