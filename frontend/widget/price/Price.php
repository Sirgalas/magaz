<?php
namespace frontend\widget\price;

use common\models\Prise;
use yii\base\Widget;

class Price extends Widget{
    public $model;
    public function init(){
        parent::init();
    }
    public function run()
    {
        $price = $this->model->prise;
        $prise = '';
        if(is_object($price)){
            if ($price->price1!=0) {
            $prise = $price->price1;
            }elseif($price->price2!=0) {
                $prise = $price->price2;
            }
            elseif ($price->priceEvro!=0) {
                $prise = $price->priceEvro;
            }
            else{
                $prise = $price->priceSem;
            }
        }
        
        if (isset($this->model->price_selling)){
            $action = $prise - $this->model->price_selling;
            $percent=($this->model->price_selling *100)/$prise;
        }else{
            $action=false;
            $percent=false;
        }
        return $this->render('html', [
            'price'     =>  $prise,
            'action'    =>  $action,
            'percent'   =>  $percent
        ]);
    }
}