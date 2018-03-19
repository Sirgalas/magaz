<?php
namespace frontend\widget\commentsall;

use common\models\Comment;
use common\models\Rating;
use yii\base\Widget;
use Yii;

class Commentsall extends Widget{
    public $godsId;

    public function init(){
        parent::init();
    }

    public function run(){
        $commentmodel= new Comment();
        $ratingModel= new Rating();
        $comments=Comment::find()->where('what=0')->with('rating','user')->orderBy(['created_at'=>SORT_DESC])->all();
        if ($commentmodel->load(Yii::$app->request->post())) {
            $rating=Yii::$app->request->post('rating_21');
            $ratingModel->id_gods=null;
            $ratingModel->quantity=$rating;
            $ratingModel->id_user=Yii::$app->user->id;
            $ratingModel->save();
            $commentmodel->id_gods=$this->godsId;
            $commentmodel->ratind_id=$ratingModel->id;
            $commentmodel->what=0;
            if($commentmodel->save()){
            }else{
                return var_dump($commentmodel->getErrors());
            }
        }
        return $this->render('html',[
            'commentmodel'  =>$commentmodel,
            'comments'      =>$comments
        ]);
    }
}