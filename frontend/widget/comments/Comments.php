<?php
namespace frontend\widget\comments;

use common\models\Comment;
use common\models\Rating;
use yii\base\Widget;
use Yii;

class Comments extends Widget{
    public $godsId;
    public $postId;
    public function init(){
        parent::init();
    }

    public function run(){
        $commentmodel= new Comment();
        $ratingModel= new Rating();
        if(isset($this->godsId)){
        $comments=Comment::find()->where(['id_gods'=>$this->godsId])->with('rating','user')->orderBy(['created_at'=>SORT_DESC])->all();
            if ($commentmodel->load(Yii::$app->request->post())) {
                $rating=Yii::$app->request->post('rating_21');
                $ratingModel->id_gods=$this->godsId;
                $ratingModel->quantity=$rating;
                $ratingModel->id_user=Yii::$app->user->id;
                if($ratingModel->save()) {
                    $commentmodel->id_gods = $this->godsId;
                    $commentmodel->ratind_id = $ratingModel->id;
                    $commentmodel->what=1;
                    if ($commentmodel->save()) {
                    } else {
                        return var_dump($commentmodel->getErrors());
                    }
                }else{
                    return var_dump($ratingModel->getErrors());
                }
            }
        }else{
            $comments=Comment::find()->where(['id_post'=>$this->postId])->with('rating','user')->orderBy(['created_at'=>SORT_DESC])->all();
            if ($commentmodel->load(Yii::$app->request->post())) {
                $rating=Yii::$app->request->post('rating_21');
                $ratingModel->id_post=$this->postId;
                $ratingModel->quantity=$rating;
                $ratingModel->id_user=Yii::$app->user->id;
                if($ratingModel->save()) {
                    $commentmodel->id_post = $this->postId;
                    $commentmodel->ratind_id = $ratingModel->id;
                    $commentmodel->what=1;
                    if ($commentmodel->save()) {
                    } else {
                        return var_dump($commentmodel->getErrors());
                    }
                }else{
                    return var_dump($ratingModel->getErrors());
                }
            }
        }
        return $this->render('html',[
            'commentmodel'  =>$commentmodel,
            'comments'      =>$comments
        ]);
    }
}