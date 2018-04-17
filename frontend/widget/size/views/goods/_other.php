<?php
use kartik\select2\Select2;
use \yii\helpers\ArrayHelper;

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

$one=Yii::t('frontend', 'NOT_ONE_SIZE').' '.$name;
$double=Yii::t('frontend', 'NOT_DOUBLE_SIZE').' '.$name;
$evro=Yii::t('frontend', 'NOT_EVRO_SIZE').' '.$name;
$family=Yii::t('frontend', 'NOT_FAMILY_SIZE').' '.$name;


if(isset($size1)&&(isset($models->prise->price1) && $models->prise->price1 != 0)){
    $item[$one][$models->prise->price1]=ArrayHelper::getValue(array_shift($size1),'value');
}
if(isset($size2)&&(isset($models->prise->price2) && $models->prise->price2 != 0)){
    $item[$double][$models->prise->price2]=ArrayHelper::getValue(array_shift($size2),'value');
}
if(isset($sizeEvro)&&(isset($models->prise->priceEvro) && $models->prise->priceEvro != 0)){
    $item[$evro][$models->prise->priceEvro]=ArrayHelper::getValue(array_shift($sizeEvro),'value');
}
if(isset($sizeSem)&&(isset($models->prise->priceSem) && $models->prise->priceSem != 0)){
    $item[$family][$models->prise->priceSem]=ArrayHelper::getValue(array_shift($sizeSem),'value');
}

echo Select2::widget([
    'name' => 'size',
    'data' => $item,
    'options' => ['placeholder' => Yii::t('frontend', 'SELECTSIZE'),'data-price'=>$models->prise->id],
    'pluginOptions' => [
        'tags' => true,
    ],
    'pluginEvents' => [
        "change" => "function(event) {
        $('form .field-basket-price #basket-price').val(event.currentTarget.getAttribute('data-price'))
        $('#prises').html(event.currentTarget.value);
        } ",]
]);