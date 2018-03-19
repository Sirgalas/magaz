<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;
/* @var $this yii\web\View */
/* @var $model common\models\Image */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="image-form">

    <?php $form = ActiveForm::begin(); ?>

    <?= \zainiafzan\widget\Dropzone::widget([
        'options' => [
            'addRemoveLinks'    => true,
            'url'               => 'create?feild='.$class,
        ],
        'clientEvents' => [
            'complete' => "function(file,dataUrl){
                 var value=document.getElementById('image-name').getAttribute('value');
                 if(value==undefined){
                    var name=file.name
                 }else{ 
                    var name =value+',%, '+file.name } 
                 document.getElementById('image-name').setAttribute('value',name)}",
            'removedfile' => "function(file){
                var value = document.getElementById('image-name').value;
                string=',%, '+file.name
                if(value.indexOf(string)!=-1){
                    newvalue = value.replace(string,'');
    
                }else if(value.indexOf(file.name)!=-1){
                    newvalue = value.replace(file.name,'');
                }else{
                    newvalue = value
                }
                document.getElementById('page-image').value = newvalue;
                }",
            'success'=>'function(file){console.log(file)}',
            'sending' => "function(file, xhr, formData){formData.append('".Yii::$app->request->csrfParam."','".Yii::$app->request->getCsrfToken() ."')}"
        ]
    ])?>
    <?php $model->path = '1'; ?>
    <?= $form->field($model, 'forHome')->radioList([
        '1'=>'На категорию',
        '0'=>'Не выводить на категорию',

    ])->label(false); ?>
    <?= $form->field($model, 'forFancy')->radioList([
        '1'=>'на один товар',
        '0'=>'Не выводить на один товар'
    ])->label(false); ?>

    <?= $form->field($model, 'name')->hiddenInput()->label(false); ?>


    <div class="form-group">
        <?= Html::submitButton($model->isNewRecord ? Yii::t('backend','CREATE') : Yii::t('backend','UPDATE'), ['class' => $model->isNewRecord ? 'btn btn-success' : 'btn btn-primary']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
