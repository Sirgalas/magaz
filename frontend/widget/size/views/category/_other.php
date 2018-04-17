<?php
use yii\helpers\Html;

$size1 = array_filter($models->addfeilds, function ($item) {
    return $item->key_feild == 'size1';
});
$size2 = array_filter($models->addfeilds, function ($item) {
    return $item->key_feild == 'size2';
});

$sizeEvro = array_filter($models->addfeilds, function ($item) {
    return $item->key_feild == 'size3';
});
$sizeSem = array_filter($models->addfeilds, function ($item) {
    return $item->key_feild == 'size4';
});

if(isset($size1)&&(isset($models->prise->price1) && $models->prise->price1 != 0)){
    $item[]=Yii::t('frontend', 'ONE_AND_A_HALF_NOT').' '.$name;
}
if(isset($size2)&&(isset($models->prise->price2) && $models->prise->price2 != 0)){
    $item[]=Yii::t('frontend', 'DOUBLE_SET_NOT').' '.$name;
}
if(isset($sizeEvro)&&(isset($models->prise->priceEvro) && $models->prise->priceEvro != 0)){
    $item[]=Yii::t('frontend', 'EVRO_NOT').' '.$name;
}
if(isset($sizeSem)&&(isset($models->prise->priceSem) && $models->prise->priceSem != 0)){
    $item[]=Yii::t('frontend', 'FAMILY_NOT').' '.$name;
}
echo Html::ul($item);