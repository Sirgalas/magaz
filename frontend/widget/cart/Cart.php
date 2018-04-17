<?php


namespace frontend\widget\cart;
use common\models\Addlfeild;
use common\models\Anonim;
use common\models\Basket;
use common\models\Gods;
use yii\base\Widget;
use Yii;
class Cart extends Widget{
    public $goods;
    public function init(){
        parent::init();
    }
    public function run(){
        $model= new Basket();

        $error='';
        $sizeFeild=null;
        $theVar=null;
        if (Yii::$app->request->post()) {

            $session = Yii::$app->session;
            $basket=Yii::$app->request->post('Basket');
            $model->goodsid=$this->goods->id;
            $model->datetime=time();
            $model->customer=$session->get('id');
            $model->quantity=$basket['quantity'];

            if(isset($basket['user_id'])){
                $model->user_id=$basket['user_id'];
            }else{
                $cookies = Yii::$app->request->cookies;
                $cooke = Yii::$app->response->cookies;
                if (($cookie = $cookies->get('anonim_id')) !== null) {
                    $var_dump='yes';
                    $anonim_id = $cookie->value;
                    $anonim=Anonim::findOne(['id'=>$anonim_id]);
                    if(isset($anonim)){
                    	$anonim->update_at=time();
                    	$anonim->save();
                    }else{
                    	$anonimus= new Anonim([
                    			'id'=>$anonim_id,
                    			'created_at'=>time()
                    		]);
                    	$anonimus->save();
                    }
                    $model->anonim_id=$anonim_id;
                    $cooke->offsetUnset('anonim_id');
                    $cooke->add(new \yii\web\Cookie([
                        'name'=> 'anonim_id',
                        'value' => $cookie->value,
                        'expire' => time()+(60*60*24*30*6)
                    ]));
                }else{
                    $var_dump='no';
	                $cookie = Yii::$app->response->cookies;
                    $anonim = new Anonim(['scenario' => Anonim::SCENARIO_ALL]);
                    $anonim->cookie=$session->get('id');
                    $anonim->created_at=time();
                    $anonim->save();
                    $model->anonim_id=$session->get('id');
                    $cooke->add(new \yii\web\Cookie([
                        'name'=> 'anonim_id',
                        'value' => $session->get('id'),
                        'expire' => time()+(60*60*24*30*6)
                    ]));
	            }
	        }
            $model->color=$basket['color'];
            if(!is_numeric($basket['size'])){
                $sizes=array_filter($this->goods->addfeilds, function($item)use($basket) {
                    return $item->value == $basket['size'];
                });
                $sizeFeild=array_shift($sizes);
            }else{
                $sizeFeild=Addlfeild::findOne($basket['size']);
                if(empty($sizeFeild)||$sizeFeild->id==7){
                    $sizes=array_filter($this->goods->addfeilds, function($item) {
                        return $item->key_feild == 'size1';
                    });
                    $sizeFeild=array_shift($sizes);
                }
            }
            $size=$sizeFeild->id;
            $model->size=$size;

            $model->price=$this->goods->prise->id;
            if(isset($basket['elastic'])) {
                $model->elastic = $basket['elastic'];
            }else{
                $model->elastic =0;
            }
            $operation_id=Basket::find()->max('operation_id');
            $model->operation_id=(integer)$operation_id + 1;
            if($model->save()){
            Yii::$app->session->setFlash([
              'success',
               'Спасибо Ваш товар отправлен в корзину']
            );
               $this->render('html',[
                    'model'=>$model,
                    'models'=>$this->goods,
                    'godsId'=>$this->goods->id,
                    'prise'=>$this->goods->prise->id,

                ]);
            }else{

                return var_dump($model->getErrors());}
        }
        return $this->render('html',[
            'model'=>$model,
            'models'=>$this->goods,
            'godsId'=>$this->goods->id,
            'prise'=>$this->goods->prise->price1,
            'error'=>$error,
            ]);
    }
}