<?php

namespace common\models;

use Yii;
use yii\helpers\Html;
use common\models\Image;
/**
 * This is the model class for table "abh_orders".
 *
 * @property integer $id
 * @property integer $datetime
 * @property integer $user_id
 * @property integer $anonim_id
 * @property integer $received_sell
 */
class Orders extends \yii\db\ActiveRecord
{
    public $bascet_id;
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'abh_orders';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['datetime'], 'required'],
            [['datetime', 'user_id', 'anonim_id', 'received_sell'], 'integer'],
        ];
    }

    public function getBaskets(){
        return $this->hasMany(Basket::className(),['order_id'=>'id']);
    }

    public function  getGood(){
        return $this->hasOne(Gods::className(),['id'=>'goodsid'])->viaTable('abh_basket', ['order_id' => 'id']);
    }

    public function wathPrice($price,$size,$goods){
        if($size=='size1'){
            $result=$price->price1;
        }
        if($size=='size2'){
            $result=$price->price2;
        }
        if($size=='size3'){
            $result=$price->priceEvro;
        }
        if($size=='size3'){
            $result=$price->priceSem;
        }
        $price_selling=$goods->price_selling?$goods->price_selling:0;
        return $result-$price_selling;
    }


    public function  theGetValue($id,$feild){
        $model=Orders::findOne($id);

        if(isset($model->good->addfeilds)) {
            $arts = array_filter($model->good->addfeilds, function ($item) {
                return $item->key_feild=='article';
            });
            foreach ($arts as $art){
                return $art->value;
            }

        }
    }
    public function getArticle(){
        $models = Orders::find()->all();
        $article=array();
        foreach ($models as $model){
           if(isset($model->good->addfeilds)) {
                $arts = array_filter($model->good->addfeilds, function ($item) {
                    return $item->key_feild == 'article';
                });
                foreach ($arts as $art) {
                    $article[$art->value] = $art->value;
                }
            }
        }
        return $article;
    }


    /**
     * @param $post string
     * @param $id string
     */

    public function saveBasket($post){
        $bascet= new Basket();
        $operation_id= Basket::find()->max('operation_id');
        $summ_id=$operation_id;
        if(preg_match(',%%,',$post)){
            $mathes=explode(',%%,',$post);
            $arr=array();
            foreach ($mathes as $math){
                $finmathes = explode(':', $math);
                $bascetmodel = Basket::findOne([$finmathes[0]]);
                $arr[]=$bascetmodel;
                if(isset($bascetmodel)) {
                    $bascetmodel->operation_id = $summ_id;
                    $bascetmodel->quantity = $finmathes[1];
                    $bascetmodel->save();
                }
            }
        }else{
            $finmathes=explode(':',$post);
            $bascetmodel=Basket::findOne($finmathes[0]);
            $arr[]=$bascetmodel;
            if(isset($bascetmodel)) {
                $bascetmodel->operation_id=$summ_id;
                $bascetmodel->quantity=$finmathes[1];
                $bascetmodel->save();
            }
        }
        return $summ_id;
    } /**
     * @param $post string
     * @param $id string
     */

    public function saveOrder($post,$id){
        $bascets= Basket::find()->where(['operation_id'=>$post])->all();
        $arr=array();
        foreach ($bascets as $bascet){
            $bascet->order_id = $id;
            if($bascet->save()){}else{
                $arr[]=$bascet->getErrors();
            }
        }
        return $arr;
    }



    /**
     * @return int
     */
    public function getFullRowOrder($id)
    {
        /*цена + резинка*/
        $order=Orders::find()->where(['id'=>$id])->with('baskets','baskets.gods','baskets.colors', 'baskets.sizes','baskets.prises')->one();
        $position='';
        $arr= array();
        if(isset($order)) {
            foreach ($order->baskets as $basket) {
            	if(is_object($basket->gods)){
            	          	
                $image =Image::findOne(['id_gods'=>$basket->goodsid,'forHome'=>1]);
                $position .=Html::a( Html::img(Yii::getAlias('@frontendWebroot').'/image/'.$image->path.''.$image->name,['width'=>100,'style'=>'float:left;padding-right:5px']),'http://miliydom.com.ua/goods/'.$basket->gods->slug_gods);
                $position .=    "<p>" . $basket->gods->title . "<br/>";

                if(is_object($basket->colors)) {
                    $position .="<strong> Цвет: </strong> <span class='fa fa-square' style='color:". $basket->colors->value ."'></span> <br/>";
                }else{
                    $position .='цвет не выбран <br/>';
                }
                if(isset($basket->sizes->value)) {
                    $position .='<strong> Размер: </strong>'. $basket->sizes->value . "<br/>";
                }else{
                    $position .='размер не выбран <br/>';
                }
                if(is_object($basket->prises)){
                    $sizeField= is_object($basket->sizes)?$basket->prises::$price_size[$basket->sizes->key_feild]:'price1';
                    $price_selling=$basket->gods->price_selling?$basket->gods->price_selling:0;
                    $position.= '<strong> Цена: </strong>'.($basket->prises->$sizeField - $price_selling) . " грн.<br/> <strong> количество </strong>";
                }else{
                     $sizeField= is_object($basket->sizes)?$basket->gods->prise::$price_size[$basket->sizes->key_feild]:'price1';
                     $position .=   "<strong> Цена: </strong>". $basket->gods->prise->$sizeField ." грн.<br/> <strong> количество </strong>";
                }
                   
                $position.=    $basket->quantity . " шт </p>";
                }else{
            		var_dump($basket->id);
            	}
            }
        }else{
            $position='товара нет в корзине по тем или инным причинам';
        }
        return $position;
    }
    public function getUser($id){
        $user=User::find()->where(['id'=>$id])->one();
        if(isset($user)) {
            if (isset($user->email)) {
                $email = $user->email;
            } else {
                $email = "Email не оставлен";
            }
            return "<p><strong>Имя:</strong> $user->name <br/><strong>Фамилия:</strong> $user->famaly <br/><strong>Телефон:</strong> $user->tel <br/><strong>Email:</strong>  $email<br/><strong>Город:</strong>  $user->sity <br/><strong>Адрес</strong>  $user->adress  <br/><strong>Отделение 'Новой почты'</strong>  $user->officeNewPost ";
        }else{
            return '<p>пользователь не зарегистрирован</p>';
        }
    }
    public function getAnonimUser($id){
        $user=Anonim::find()->where(['id'=>$id])->one();
        if(isset($user)) {
            if (isset($user->email)) {
                $email = $user->email;
            } else {
                $email = "Email не оставлен";
            }
            return "<p><strong>Имя:</strong> $user->name <br/><strong>Фамилия:</strong> $user->famaly <br/><strong>Телефон:</strong> $user->tel <br/><strong>Email:</strong>  $email<br/><strong>Город:</strong>  $user->sity <br/><strong>Адрес</strong>  $user->adress  <br/><strong>Отделение 'Новой почты'</strong>  $user->officeNewPost ";
        }else{
            return '<p>видимо пользователь зарегистрирован</p>';
        }
    }
    public function getReceivedSell($received){
        switch ($received) {
            case 0:
                return "Новый заказ";
            case 1:
                return "Принятый";
            case 2:
                return "Выполненый";
            case 3:
                return "Отказ";
            default:
                return "Отменен";
        }
    }

    public function getAdmin($admin_id){
        if(isset($admin_id)){
            $user=User::findOne($admin_id);
            return $user->name;
        }else{
            return 'пользователь не указан';
        }

    }


    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'datetime' => 'Datetime',
            'user_id' => 'User ID',
            'anonim_id' => 'Anonim ID',
            'received_sell' => 'Received Sell',
        ];
    }
}
