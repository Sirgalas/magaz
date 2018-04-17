<?php
use yii\helpers\Html;
use kartik\select2\Select2;
use yii\helpers\ArrayHelper;

if(is_object($category)){

    if($category->size=='Одежда'){
        
            echo $this->render('goods/_clothes',[
            'sizesСlothes'=>$sizesСlothes=$models->size1
        ]);

    }
    if($category->size=='Постельное'){
        echo $this->render('goods/_beding',[
            'models'=>$models
        ]);
    }
    if($category->size=='Полуторное'){
        echo $this->render('goods/_other',[
            'models'=>$models,
            'name'=>$category->name
        ]);
    }
    
    
    
    
    
    
    
    
   /* $size2 = array_filter($models->addfeilds, function ($item) {
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

        if (!empty($size2) || !empty($size3) || !empty($size4)) {

            
        } */
    }
