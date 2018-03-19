<?php
use kartik\select2\Select2;
use yii\helpers\ArrayHelper;

$theSelect = ArrayHelper::map($sizesСlothes, 'id', 'value');
//var_dump($theSelect);
echo Select2::widget([
    'name' => 'size',
    'data' => $theSelect,
    'options' => ['placeholder' => Yii::t('frontend', 'SELECTSIZE')],
    'pluginOptions' => [
        'tags' => true,
    ],
    'pluginEvents' => [
        "change" => "function(event) { 
            document.getElementById('basket-size').setAttribute('value',this.value); 
            $('form .field-basket-price #basket-price').val(event.currentTarget.value);
        }",
    ]
]);