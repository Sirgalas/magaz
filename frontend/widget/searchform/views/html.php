<?php 
use yii\widgets\ActiveForm;
use yii\helpers\Html;
use yii\helpers\Url;
?>
<?php $form = ActiveForm::begin(['options' => ['class'=>'filters'],'action'=>'/search/search/filter','method'=>'get']); ?>
<div class="form-group">
    <input type="reset" class="button" value="<?= Yii::t('frontend','Reset');?>" id="reset" />
</div>
<div class="select">
    <h4><?= Yii::t('frontend','SortByDesc'); ?></h4>
    <?php
    $sortSelect=array(
        '0'=>Yii::t('frontend','SORTASC'),
        '1'=>Yii::t('frontend','SORTDESC'),
    );
    $params = [
        'prompt' => Yii::t('frontend','SelectSort')
    ];
    echo $form->field($model,'sort')->dropDownList($sortSelect,$params)->label(false); ?>
</div>
    <div class="block sezon">
        <h4><?php Yii::t('frontend','Price'); ?></h4>
        <div id="slider-range" data-max="<?= $max ?>" data-min="<?= $min ?>"></div>
        <p>
            <input type="text" value="<?= $min ?>" name="SearchModel[priceMin]" id="amountmin" class="rangerinput">
            <input type="text" value="<?= $max ?>" name="SearchModel[priceMax]" id="amountmax" class="rangerinput">
        </p>
    </div>
    <?php if(isset($categoryAll)){ ?>
        <div class="block scroll">
            <h4><?=Yii::t('frontend','Category'); ?></h4>
            <?php foreach ($categoryAll as $category) {
                $arrCat[$category->id]=$category->name;
            } 
            ?>
            <?= $form->field($model,'category')->checkboxList($arrCat,['class'=>'checkbox'])->label(false);?>
        </div>
    <?php }else{ ?>

        <?= $form->field($model,'parent')->hiddenInput(['value'=>$category->id])->label(false); ?>
        <div class="block scroll">
            <h4><?=Yii::t('frontend','Category'); ?></h4>
            <?php foreach ($category->child as $child) {
                $arrCat[$child->id]=$child->name;

            }
            ?>
            <?= $form->field($model,'category')->checkboxList($arrCat,['class'=>'checkbox'])->label(false);?>

        </div>
        <?php
        if($category->id==55){ ?>
            <div class="block scroll">
                <h4><?= Yii::t('frontend','Size')?></h4>
            <?php

                $arrSize= array(
                    'size1'=>Yii::t('frontend', 'ONEANDAHALF'),
                    'size2'=>Yii::t('frontend', 'DOUBLESET'),
                    'size3'=>Yii::t('frontend', 'EVROSELECT'),
                    'size4'=>Yii::t('frontend', 'FAMILYSELECT'),
                ); ?>
                <?= $form->field($model,'size')->checkboxList($arrSize,['class'=>'checkbox'])->label(false);?>
            </div>

        <?php }else{ ?>
            <div class="block scroll">
                <h4><?= Yii::t('frontend','Size')?></h4>
                <?php
                $sizes=array_filter($frontendSetup,function ($item){
                    return $item->description=='size';
                }); ?>
                <?php foreach ($sizes as $size){
                $arrSize[$size->vaelye]=$size->vaelye; } ?>
                <?= $form->field($model,'size')->checkboxList($arrSize,['class'=>'checkbox'])->label(false);?>
            </div>
            <div class="block sezon">
                <h4><?= Yii::t('frontend','Sezon')?></h4>
                <?php $arrSeason=array(
                        'winter'=>  Yii::t('frontend','Winter'),
                        'spring'=>  Yii::t('frontend','Spring'),
                        'summer'=> Yii::t('frontend','Summer'),
                        'fall'=> Yii::t('frontend','Fall')
                    );
                ?>
                <?=$form->field($model,'season')->checkboxList($arrSeason,['class'=>'checkbox'])->label(false);?>
            </div>
            <?php } ?>
        <?php } ?>
    <div class="block scroll">
        <h4><?= Yii::t('frontend','Color')?></h4>
        <?php
        $colors=array_filter($frontendSetup,function ($item){
            return $item->description=='color';
        }); ?>
        <?php foreach ($colors as $color){
            $arrColor[$color->vaelye]=$color->key_setup;
        } ?>
        <?= $form->field($model,'color')->checkboxList($arrColor,['item'=>function($index, $label, $name, $checked, $value)
        {
            return '
                <label for="interview-'. $index .'">
                    
                    <input id="interview-'. $index .'" name="'. $name .'" type="checkbox" '. $checked .' value="'. $value .'">
                    <span class="color" style="background-color:'.$value.'"></span>
                    '. $label .'
                </label>';
        },'class'=>'checkbox'])->label(false);?>
    </div>

    <div class="form-group">
        <?= Html::submitButton(Yii::t('backend','Search'), ['class' => 'button']) ?>
    </div>
    <div class="block">
        <?= $contacts->description_page; ?>
    </div>
<?php
ActiveForm::end(); ?>
