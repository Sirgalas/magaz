<?php
namespace frontend\widget\countcart;
use common\models\Basket;
use yii\base\Widget;
use Yii;
class Countcart extends Widget{
    public function init(){
        parent::init();
    }
    public function run(){
        $session = Yii::$app->session;
        $count=Basket::find()->where(['customer'=>$session->get('id'),'order_id'=>null])->count();
        return $this->render('html',[
            'count'=>$count
            ]);
    }
}