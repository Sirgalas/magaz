<?php
//var_dump($model->addfeilds);
if(isset($model->addfeilds)||!empty($model->addfeilds)){
    $size1=array_filter($model->addfeilds, function($item) {
        return $item->key_feild == 'size1';
    });
    if(isset($size1)){
        foreach ($size1 as $sz1) {
            echo '<br/><span> '.$name.' размером ' . $sz1->value . ' - ' . $model->prise->price1 . ' грн </span><br/>';
        }
    }
    $size2=array_filter($model->addfeilds, function($item) {
        return $item->key_feild == 'size2';
    });
    if(isset($size2)){
        foreach ($size2 as $sz2) {
            echo '<span> '.$name.' размером ' . $sz2->value . ' - ' . $model->prise->price2 . ' грн </span><br/>';
        }
    }
    $size3=array_filter($model->addfeilds, function($item) {
        return $item->key_feild == 'size3';
    });
    if(isset($size3)){
        foreach ($size3 as $sz3) {
            echo '<span> '.$name.' размером ' . $sz3->value . ' - ' . $model->prise->priceEvro . ' грн </span><br/>';
        }
    }
    $size4=array_filter($model->addfeilds, function($item) {
        return $item->key_feild == 'size4';
    });
    if(isset($size4)){
        foreach ($size4 as $sz4) {
            echo '<span> '.$name.' размером ' . $sz4->value . ' - ' . $model->prise->priceSem. ' грн </span><br/>';
        }
    }
    $size5=array_filter($model->addfeilds, function($item) {
        return $item->key_feild == 'size5';
    });
    if(isset($size5)){
        foreach ($size5 as $sz5) {
            echo '<span> '.$name.' размером ' . $sz5->value . ' - ' . $model->prise->addtional. ' грн </span><br/>';
        }
    }
    $size6=array_filter($model->addfeilds, function($item) {
        return $item->key_feild == 'size6';
    });  

    if(isset($size6)){
        foreach ($size6 as $sz6) {
            echo '<span> '.$name.' размером ' . $sz6->value . ' - ' . $model->prise->wholesale. ' грн </span><br/>';
        }
    }
}else{
    echo Yii::t('frontend','NotLines');
}

if(isset($whoprise)){ ?>
    </p>
    <h2><?= Yii::t('frontend','LINESWHOSALES'); ?></h2>
    <p class="apart">
    <?php
    $size1=array_filter($model->addfeilds, function($item) {
        return $item->key_feild == 'size1';
    });
    if(isset($size1)){
        foreach ($size1 as $sz1) {
            echo '<br/><span> '.$name.' размером ' . $sz1->value . ' - ' . $whoprise->price1 . ' грн </span><br/>';
        }
    }
    $size2=array_filter($model->addfeilds, function($item) {
        return $item->key_feild == 'size2';
    });
    if(isset($size2)){
        foreach ($size2 as $sz2) {
            echo '<span>'.$name.' размером ' . $sz2->value . ' - ' . $whoprise->price2 . ' грн </span><br/>';
        }
    }
    $size3=array_filter($model->addfeilds, function($item) {
        return $item->key_feild == 'size3';
    });
    if(isset($size3)){
        foreach ($size3 as $sz3) {
            echo '<span> '.$name.' размером ' . $sz3->value . ' - ' . $whoprise->priceEvro . ' грн </span><br/>';
        }
    }
    $size4=array_filter($model->addfeilds, function($item) {
        return $item->key_feild == 'size4';
    });
    if(isset($size4)){
        foreach ($size4 as $sz4) {
            echo '<span> '.$name.' размером ' . $sz4->value . ' - ' . $whoprise->priceSem. ' грн </span><br/>';
        }
    }
    $size5=array_filter($model->addfeilds, function($item) {
        return $item->key_feild == 'size5';
    });
    if(isset($size5)){
        foreach ($size5 as $sz5) {
            echo '<span> '.$name.' размером ' . $sz5->value . ' - ' . $whoprise->addtional. ' грн </span><br/>';
        }
    }
    $size6=array_filter($model->addfeilds, function($item) {
        return $item->key_feild == 'size6';
    });
    if(isset($size6)){
        foreach ($size6 as $sz6) {
            echo '<span> '.$name.' размером ' . $sz6->value . ' - ' . $whoprise->wholesale. ' грн </span><br/>';
        }
    } ?>
<?php }
?>