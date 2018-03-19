<?php

namespace frontend\modules\post\controllers;

use common\models\Category;
use common\models\Post;
use yii\data\ActiveDataProvider;
use yii\web\Controller;

/**
 * Default controller for the `post` module
 */
class PostController extends Controller
{
    /**
     * Renders the index view for the module
     * @return string
     */
    public function actionCategory()
    {
        $posts=Post::find()->orderBy(['id'=>SORT_DESC])->with('images','addfeilds');
        $postDataProvider= new ActiveDataProvider([
            'query' => $posts,
            'pagination' => [
                'pageSize' => 20,
            ],
        ]);
        $category=Category::findOne(['name'=>'Новости']);
        if(empty($posts)){
            return $this->redirect('site/error');
        }else {
            return $this->render('list', [
                'postDataProvider' => $postDataProvider,
                'category'  =>  $category
            ]);
        }
    }
    public function actionOnepost($id)
    {
        $posts=Post::find()->where(['slug_post'=>$id])->orderBy(['id'=>SORT_DESC])->with('images','addfeilds')->one();
        return $this->render('onepost',[
            'model'=>$posts,
        ]);
    }

}
