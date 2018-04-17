<?php
use yii\helpers\Html;
use kartik\select2\Select2;
use yii\helpers\ArrayHelper;
if(is_object($category)){
    $size2 = array_filter($models->addfeilds, function ($item) {
        return $item->key_feild == 'size2';
    });
    $size1 = array_filter($models->addfeilds, function ($item) {
        return $item->key_feild == 'size1';
    });
    $size3 = array_filter($models->addfeilds, function ($item) {
        return $item->key_feild == 'size3';
    });
    $size4 = array_filter($models->addfeilds, function ($item) {
        return $item->key_feild == 'size4';
    });
    $size5 = array_filter($models->addfeilds, function ($item) {
        return $item->key_feild == 'size5';
    });
    if($category->size=='Постельное'||$category->name=='Хиты'){
        $one=Yii::t('frontend', 'ONE_AND_A_HALF');
        $double=Yii::t('frontend', 'DOUBLE_SET');
        $evro=Yii::t('frontend', 'EVRO');
        $family=Yii::t('frontend', 'FAMILY');
    }elseif($category->size=='Полуторное'){
        $one=Yii::t('frontend', 'ONE_AND_A_HALF_NOT').' '.$category->name;
        $double=Yii::t('frontend', 'DOUBLE_SET_NOT').' '.$category->name;
        $evro=Yii::t('frontend', 'EVRO_NOT').' '.$category->name;
        $family=Yii::t('frontend', 'FAMILY_NOT').' '.$category->name;
    }else{
        if (isset($size1)) {
            $sizeText='';
            $count=0;
            foreach ($size1 as $size) {
                $count++;
                if($count<count($size1)){
                    $sizeText.=$size->value.', ';
                }else{
                    $sizeText.=$size->value;
                }

            }
            $one = $sizeText;
        }
        if (isset($size2)) {
            foreach ($size2 as $size) {
                $double = $category->size . ': ' . $size->value;
            }
        }
        if (isset($size3)) {
            foreach ($size3 as $size) {
                $evro=$category->size .': '.$size->value;
            }
        }
        if (isset($size4)) {
            foreach ($size4 as $size) {
                $family = $category->size . ': ' . $size->value;
            }
        }
    }
    $theSelect = array();
    $value=array();
        if (isset($size1)) {
            $arr = array();
            foreach ($size1 as $size) {
                $theSelect[$one][$models->prise->price1.$size->value] = $size->value;
                $value[] = $size->value;
            }
        }
        if (isset($size2)) {
            foreach ($size2 as $size) {
                $theSelect[$double][$models->prise->price2] = $size->value;
                $value[] = $size->value;
            }
        }
        if (isset($size3)) {
            foreach ($size3 as $size) {
                $theSelect[$evro][$models->prise->priceEvro] = $size->value;
                $value[] = $size->value;
            }
        }
        if (isset($size4)) {
            foreach ($size4 as $size) {
                $theSelect[$family][$models->prise->priceSem] = $size->value;
                $value[] = $size->value;
            }
        }
    if($target=='goods') {
        if (!empty($size2)||!empty($size3)||!empty($size4)) {

            echo Select2::widget([
                'name' => 'size',
                'data' => $theSelect,
                'options' => ['placeholder' => Yii::t('frontend', 'SELECTSIZE')],
                'pluginOptions' => [
                    'tags' => true,
                ],
                'pluginEvents' => [
                    "change" => "function(event) {
                        document.getElementById('basket-size').setAttribute('value',event.target.nextSibling.innerText); 
                        $('form .field-basket-price #basket-price').val(event.currentTarget.value);
                    }",]
            ]);
        } else {
            $size = array_filter($models->addfeilds, function ($item) {
                return $item->key_feild == 'size1';
            });
            $theSelect = ArrayHelper::map($size, 'id', 'value');
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
        }
    }else {

        $sizes = $size1;
        if($models->categorys->id!=55&&$models->categorys->parrent_category!=55){
            echo Yii::t('backend','SIZE').' '.$one ;
        }else if($set==2){
            foreach ($sizes as $size) {
                if (isset($models->prise->price1) && $models->prise->price1 != 0 && isset($value[0]))
                    echo Yii::t('backend','SIZE').' '.$value[0] . ': ' . $models->prise->price1 . ' грн.</br>';
                if (isset($models->prise->price2) && $models->prise->price2 != 0 && isset($value[1]))
                    echo Yii::t('backend','SIZE').' '.$value[1] . ': ' . $models->prise->price2 . '  грн. </br>';
                if (isset($models->prise->priceEvro) && $models->prise->priceEvro != 0 && isset($value[2]))
                    echo Yii::t('backend','SIZE').' '.$value[2] . ': ' . $models->prise->priceEvro . '  грн.</br>';
                if (isset($models->prise->priceSem) && $models->prise->priceSem != 0 && isset($value[3]))
                    echo Yii::t('backend','SIZE').' '.$value[3] . ': ' . $models->prise->priceSem . '  грн.</br>';
                if (isset($models->prise->addtional) && $models->prise->addtional != 0 && $category->id == 41 && isset($value[4]))
                    echo Yii::t('backend','SIZE').' '.$value[4] . ': ' . $models->prise->priceSem . '  грн.</br>';
            }
        }else if($set==1){

            if (isset($models->prise->price1) && $models->prise->price1 != 0)
                echo  $one.'</br>';
            if (isset($models->prise->price2) && $models->prise->price2 != 0)
                echo  $double.'</br>';
            if (isset($models->prise->priceEvro) && $models->prise->priceEvro != 0)
                echo $evro.'</br>';
            if (isset($models->prise->priceSem) && $models->prise->priceSem != 0)
                echo $family.'</br>';
            if (isset($models->prise->addtional) && $models->prise->addtional!=0 && $category->id==41)
                echo $family.'</br>';
        }else{
            echo Yii::t('backend','SIZE').' '.$one ;
        }
    }
}else{

}
