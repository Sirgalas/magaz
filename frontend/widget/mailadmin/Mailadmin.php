<?php


namespace frontend\widget\mailadmin;


use common\models\Orders;
use yii\base\Widget;
use common\models\FrontendSetup;
class Mailadmin extends Widget
{
    public $text;
    public $orderId;
    public $email;
    public $family;
    public $name;
    public $userTel;
    public $adress;
    public function init(){
        parent::init();
    }

    public function run(){
        $order=Orders::find()->where(['id'=>$this->orderId])->with('baskets','baskets.gods','baskets.gods.images','baskets.sizes','baskets.colors','baskets.prises')->one();
        $tel=FrontendSetup::find()->where(['key_setup'=>'telephone'])->one();
        $social=FrontendSetup::find()->where(['description'=>'social'])->all();
        return $this->render('mail',[
            'tel'       =>  $tel,
            'text'      =>  $this->text,
            'orders'    =>  $order,
            'email'     =>  $this->email,
            'family'    => $this->family,
            'name'      =>  $this->name,
            'userTel'   =>  $this->userTel,
            'socials'   =>  $social,
            'adress'    =>  $this->adress
        ]);
    }

}