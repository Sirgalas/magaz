<?php
use kartik\select2\Select2;
use \yii\helpers\ArrayHelper;

$size1 = array_filter($models->addfeilds, function ($item) {
    return $item->key_feild == 'size1';
});
$size1=array_shift($size1);
$size2 = array_filter($models->addfeilds, function ($item) {
    return $item->key_feild == 'size2';
});
$size2=array_shift($size2);
$sizeEvro = array_filter($models->addfeilds, function ($item) {
    return $item->key_feild == 'size3';
});
$sizeEvro=array_shift($sizeEvro);
$sizeSem = array_filter($models->addfeilds, function ($item) {
    return $item->key_feild == 'size4';
});
$sizeSem=array_shift($sizeSem);
$one=Yii::t('frontend', 'ONE_SIZE');
$double=Yii::t('frontend', 'DOUBLE_SIZE');
$evro=Yii::t('frontend', 'EVRO_SIZE');
$family=Yii::t('frontend', 'FAMILY_SIZE');


if(is_object($size1))
    $item[$one][$size1->id]=$size1->value;

if(is_object($size2))
    $item[$double][$size2->id]=$size2->value;

if(is_object($sizeEvro))
    $item[$evro][$sizeEvro->id]=$sizeEvro->value;

if(is_object($sizeSem))
    $item[$family][$sizeSem->id]=$sizeSem->value;

//var_dump($item);
echo Select2::widget([
    'name' => 'size',
    'data' => $item,
    'options' => ['placeholder' => Yii::t('frontend', 'SELECTSIZE'),'data-price'=>$models->prise->id],
    'pluginOptions' => [
        'tags' => true,
    ],
    'pluginEvents' => [
        "change" => "function(event) {
            var price=  event.currentTarget.getAttribute('data-price');
            var size= event.currentTarget.value
            $('form .field-basket-price #basket-price').val(price);
            $('#prises').html(size);
            $.ajax({
                method: 'POST',
                url: '/cart/cart/get-price',
                data: {price: price, size: size},
                success: function (data) {
                   $('#prises').html(data);
                   $('form .field-basket-price #basket-price').val(price);
                   $('#basket-size').val(size); 
                }
            });
        } ",]
]);
/* document.getElementById('basket-size').setAttribute('value',event.target.nextSibling.innerText);
           $('form .field-basket-price #basket-price').val(event.currentTarget.value);*/