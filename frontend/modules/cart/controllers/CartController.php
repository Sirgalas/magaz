<?php

namespace frontend\modules\cart\controllers;

use common\models\Adduserfeild;
use common\models\Orders;
use common\models\Basket;
use common\models\Anonim;
use common\models\Addlfeild;
use common\models\Prise;
use frontend\models\User;
use frontend\widget\mailadmin\Mailadmin;
use yii\web\Controller;
use Yii;
/**
 * Default controller for the `cart` module
 */
class CartController extends Controller
{
    /**
     * Renders the index view for the module
     * @return string
     */
    public function actionIndex()
    {
        $session = Yii::$app->session;
        $sesGoods = Basket::find()->where(['customer'=>$session->get('id'),'order_id'=>null])->with('gods','gods.images','gods.addfeilds','sizes','colors','prises')->all();
        if(Yii::$app->user->id) {
            $userGoods = Basket::find()->where(['user_id' => Yii::$app->user->id, 'order_id' => null])->andWhere("`customer`!='" . $session->get('id') . "'")->with('gods', 'gods.images', 'gods.addfeilds')->orderBy(['datetime' => SORT_DESC])->all();
        }else {
            $cookies = Yii::$app->request->cookies;
            if (($cookie = $cookies->get('anonim_id')) !== null) {
                $user = $cookie->value;
            }else{
                $user=null;
            }
            $userGoods = Basket::find()->where(['anonim_id'=>$user,'order_id'=>null])->andWhere("`customer`!='".$session->get('id')."'")->with('gods','gods.images','gods.addfeilds')->orderBy(['datetime'=>SORT_DESC])->all();
        }
        $order= new Orders();
        if(Yii::$app->request->post()){
            $post= $order->saveBasket(Yii::$app->request->post('id'));
            return $this->redirect(['order','id'=>$post]);
        }
        return $this->render('index',[
            'sesGoods'  =>  $sesGoods,
            'userGoods' =>  $userGoods,
            'order'     =>  $order,
        ]);
    }
    public function actionOrder($id)
    {
        $cookies = Yii::$app->request->cookies;
        $order = new Orders();
        $order->datetime = time();
        if (isset(Yii::$app->user->id)) {
            $user = User::findOne(['id' => Yii::$app->user->id]);
        } else {
            $cook = $cookies->get('anonim_id');
                $user = Anonim::findOne(['cookie' => $cook->value]);
            if(empty($user)){
                $user = new Anonim(['scenario' => Anonim::SCENARIO_REQUIRE]);
            }
        }
        if($order->save()){

        }else{
            return var_dump($order->getErrors());
        }
        return $this->render('order', [
            'user' => $user,
            'messege' => 'yes',
            'operation_id' => $id,
            'orderid' => $order->id,
            'order'   => $order
        ]);

    }
    public function actionUser(){
        if(isset(Yii::$app->user->id)) {
            $user = User::findOne(Yii::$app->user->id);
            if (empty($user)) {
                $user = new User();
            }
        }else{
            $cookies = Yii::$app->request->cookies;
            $cook=$cookies->get('anonim_id');
            if (($cookie = $cookies->get('anonim_id')) !== null) {
                $anonim_id = $cookie->value;
                $user = Anonim::findOne(['cookie' => $anonim_id]);
                if (empty($user)) {
                    $user = new Anonim();
                }
            }
        }
        if($user->load(Yii::$app->request->post())){
            $post=Yii::$app->request->post('User');
            $postOrder=Yii::$app->request->post('Orders');
            if(empty($post)){
                $post=Yii::$app->request->post('Anonim');
            }
            $order=Orders::findOne($post['orderid']);
            $basket=Basket::findOne(['operation_id'=>$post['operation_id']]);
            $basket->order_id=$order->id;
            $basket->save();
            if(isset($postOrder)){
                $order->comment=$postOrder['comment'];
            }
            if(isset(Yii::$app->user->id)){
                $user->updated_at=time();
                $user->email= Yii::$app->user->identity->email;
                if(isset($post['name'])) {
                    if ($user->name != $post['name']) {
                        $user->name = $post['name'];
                    }
                }
                if(isset($post['tel'])) {
                    if ($user->tel != $post['tel']) {
                        $user->tel = $post['tel'];
                    }
                }
                if(isset($post['famaly'])) {
                    if ($user->famaly != $post['famaly']) {
                        $user->famaly = $post['famaly'];
                    }
                }
                if(isset($post['sity'])) {
                    if ($user->sity != $post['sity']) {
                        $user->sity = $post['sity'];
                    }
                }
                if(isset($post['adress'])) {
                    if ($user->adress != $post['adress']) {
                        $user->adress = $post['adress'];
                    }
                }
                if(isset($post['officeNewPost'])) {
                    if ($user->officeNewPost != $post['officeNewPost']) {
                        $user->officeNewPost = $post['officeNewPost'];
                    }
                }

                if($user->save()){
                    if(isset($post['operation_id'])) {
                        $baskets=Basket::find()->where(['operation_id'=>(integer)$post['operation_id']])->all();
                        foreach ($baskets as $basket){
                            $basket->order_id=$post['orderid'];
                            $basket->save();
                        }
                    }
                    Yii::$app->mailer->compose()
                        ->setFrom('admin@miliydom.com.ua')
                        ->setTo('alenatkachen@yandex.ru')
                        ->setSubject('Новый заказ!!!!!')
                        ->setTextBody('Ну собствено')
                        ->setHtmlBody(Mailadmin::widget(['text'=>Yii::t('frontend','adminNewOrder'),'orderId'=>$post['orderid'],'email'=>$post['email'],'family'=>$post['famaly'],'name'=>$post['name'],'userTel'=>$post['tel'],'adress'=>$post['adress']]))
                        ->send();
                    Yii::$app->mailer->compose()
                        ->setFrom('admin@miliydom.com.ua')
                        ->setTo($post['email'])
                        ->setSubject('Новый заказ!!!!!')
                        ->setTextBody('Вы только что совершили новый заказ в интернет магазине "Милый дом"')
                        ->setHtmlBody(Mailadmin::widget(['text'=>Yii::t('frontend','userNewOrder'),'orderId'=>$post['orderid'],'email'=>$post['email'],'family'=>$post['famaly'],'name'=>$post['name'],'userTel'=>$post['tel'],'adress'=>$post['adress']]))
                        ->send();


                }else{
                    var_dump($user->getErrors());
                }
                $order->user_id=$user->id;
                $post= $order->saveOrder($post['operation_id'],$order->id);
            }else{
                $cookies = Yii::$app->request->cookies;
                $cook=$cookies->get('anonim_id');
                if (($cookie = $cookies->get('anonim_id')) !== null) {

                    if(isset($user->cookie))
                    $user->cookie = $cook->value;
                    if(isset($user->created_at))
                    $user->created_at = time();

                    if(isset($post['name'])) {
                        if ($user->name != $post['name']) {
                            $user->name = $post['name'];
                        }
                    }
                    if(isset($post['tel'])) {
                        if ($user->tel != $post['tel']) {
                            $user->tel = $post['tel'];
                        }
                    }
                    if(isset($post['email'])) {
                        if ($user->email != $post['email']) {
                            $user->email = $post['email'];
                        }
                    }
                    if(isset($post['famaly'])) {
                        if ($user->famaly != $post['famaly']) {
                            $user->famaly = $post['famaly'];
                        }
                    }
                    if(isset($post['sity'])) {
                        if ($user->sity != $post['sity']) {
                            $user->sity = $post['sity'];
                        }
                    }
                    if(isset($post['adress'])) {
                        if ($user->adress != $post['adress']) {
                            $user->adress = $post['adress'];
                        }
                    }
                    if(isset($post['officeNewPost'])) {
                        if ($user->officeNewPost != $post['officeNewPost']) {
                            $user->officeNewPost = $post['officeNewPost'];
                        }
                    }
                    if($user->save()){
                        $order->anonim_id=$user->id;
                        if(isset($post['operation_id'])) {
                            $baskets=Basket::find()->where(['operation_id'=>(integer)$post['operation_id']])->all();
                            foreach ($baskets as $basket){
                                $basket->order_id=$post['orderid'];
                                $basket->save();
                            }
                        }
                       Yii::$app->mailer->compose()
                            ->setFrom('admin@miliydom.com.ua')
                            ->setTo('miliy-domik@mail.ru')
                            ->setSubject('Новый заказ!!!!!')
                            ->setTextBody('Ну собствено')
                            ->setHtmlBody(Mailadmin::widget(['text'=>Yii::t('frontend','adminNewOrder'),'orderId'=>$post['orderid'],'email'=>$post['email'],'family'=>$post['famaly'],'name'=>$post['name'],'userTel'=>$post['tel'],'adress'=>$post['adress']]))
                            ->send();
                        Yii::$app->mailer->compose()
                            ->setFrom('admin@miliydom.com.ua')
                            ->setTo($post['email'])
                            ->setSubject('Новый в интернет магазине "Милый дом.')
                            ->setTextBody('Вы только что совершили новый заказ в интернет магазине "Милый дом"')
                            ->setHtmlBody(Mailadmin::widget(['text'=>Yii::t('frontend','userNewOrder'),'orderId'=>$post['orderid'],'email'=>$post['email'],'family'=>$post['famaly'],'name'=>$post['name'],'userTel'=>$post['tel'],'adress'=>$post['adress']]))
                            ->send();
                    }else{
                        var_dump($user->getErrors());
                    }
                }else{
                    $session = Yii::$app->session;
                    $user = new Anonim();
                    $user->cookie=$session->get('id');
                    $user->created_at=time();
                    $user->save();
                    $order->anonim_id=$user->id;
                }

                $cookie = Yii::$app->response->cookies;
                $cookie->remove('anonim_id');
                $cookie->add(new \yii\web\Cookie([
                    'name'      => 'anonim_id',
                    'value'     => $cook->value,
                    'expire'    => time()+(60*60*24*30*6)
                ]));
                $post= $order->saveOrder($post['operation_id'],$order->id);
            }
            $order->save();

        }

        return $this->render('order', [
            'user'=> false,
            'messege'=> 'yes'
        ]);
    }

    public function actionDelpervgoods(){
        $ajax=Yii::$app->request->post();
        $backet=Basket::findOne($ajax['id']);
        $backet->delete();
        return true;
    }

    public function actionGetPrice(){
        $post=Yii::$app->request->post();
        $price=Prise::findOne($post['price']);
        if(!$price)
            return array('price'=>false);
        $size=Addlfeild::findOne($post['size']);
            if(!$size)
            return array('size'=>false);
        $fielld = $price::$price_size[$size->key_feild];
        return $price->$fielld;
    }


}
