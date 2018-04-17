<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;
use kartik\select2\Select2;
if($feild=="id_gods") {
    $arrSelect = array('article' => 'Артикул','site'=>'сайт поставщика','size1'=>'Размер','size2'=>'двойной размер','size3'=>'евро размер','size4'=>'семейный размер','size5'=>'первый дополнительный размер','size6'=>'второй дополнительный размер','color'=>'Цвет','code_provider'=>'код поставщика','link_site'=>'ссылка на сайт','name_provider'=>'Имя поставщика','contact_provider'=>'контакты поставщика','title'=>'title','description'=>'description','keywords'=>'keywords','delivery'=>'Доставка','country'=>'Страна производитель','composition'=>'Состав','winter'=>'Зима','spring'=>'Весна','summer'=>'Лето','fall'=>'Осень');
}else{
    $arrSelect = array('title'=>'title','description'=>'description','keywords'=>'keywords');
}
/* @var $this yii\web\View */
/* @var $model common\models\Addlfeild */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="addlfeild-form">

    <?php $form = ActiveForm::begin(); ?>

        <?= $form->field($model, 'key_feild')->widget(Select2::classname(), [
            'data' => $arrSelect,
            'language' => 'ru',
            'options' => ['placeholder' => 'Выбирите название поля'],
            'pluginOptions' => [
                'allowClear' => true
            ],
            'pluginEvents' => [
                "select2:selecting" => "function(e) {
                    var print = logAdd(e);
                    var id = print.args.data.id;
                    var text = print.args.data.text;
                     if(id=='color'){
                        var input = '<input type=\"color\" id=\"addlfeild-value\" class=\"form-control\" name=\"Addlfeild[value]\" maxlength=\"610\">'
                        $('.field-addlfeild-value').html(input);
                     }                

                }"
            ]
        ]); ?>

    <?= $form->field($model, 'value')->textInput(['maxlength' => true]) ?>

    <div class="form-group">
        <?= Html::submitButton($model->isNewRecord ? Yii::t('backend','CREATE') : Yii::t('backend','UPDATE'), ['class' => $model->isNewRecord ? 'btn btn-success' : 'btn btn-primary']) ?>
    </div>
    <div id="inner"></div>

    <?php ActiveForm::end(); ?>

</div>
