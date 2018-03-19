<?php
use kartik\rating\StarRating;
use yii\widgets\ActiveForm;
use yii\widgets\Pjax;
use yii\helpers\Html;
Pjax::begin(['id' => 'new_relode']);
$form = ActiveForm::begin(['method'=>'post','options' => ['data-pjax' => true,'class' => 'col-lg-24 col-md-24 col-sm-24 col-xs-24 comment']]);
?>
    <?php echo StarRating::widget([
        'name' => 'rating_21',
        'value' => 0,
        'pluginOptions' => [
            'readonly' => false,
            'showClear' => false,
            'showCaption' => false,
            'theme' => 'krajee-fa',
            'filledStar' => '<span class="fa fa-star"></span>',
            'emptyStar' => '<span class="fa fa-star-o"></span>'
        ],
    ]); ?>
    <div class="col-lg-24 col-md-24 col-sm-24 col-xs-24">
        <p class="col-lg-24 col-md-24 col-sm-24 col-xs-24">
            <label> <span class="col-lg-8 col-md-8 col-sm-12 col-xs-12"> Заголовок</span>
                <?= $form->field($commentmodel, 'title',['options'=>['class'=>'text col-lg-10 col-md-10 col-sm-12 col-xs-24']])->textInput(['maxlength' => true])->label(false) ?>
            </label>
        </p>
    </div>
    <div class="col-lg-24 col-md-24 col-sm-24 col-xs-24">
        <p class="col-lg-24 col-md-24 col-sm-24 col-xs-24">
            <label><span class="col-lg-8 col-md-8 col-sm-12 col-xs-12"> Cообщение</span>
                <?= $form->field($commentmodel, 'text',['options'=>['class'=>'text col-lg-10 col-md-10 col-sm-12 col-xs-24']])->textarea()->label(false); ?>
            </label>
        </p>
    </div>
    <?= $form->field($commentmodel,'user_id')->hiddenInput(['value'=>Yii::$app->user->id])->label(false);?>
    <?= $form->field($commentmodel,'what')->hiddenInput(['value'=>1])->label(false);?>
    <?= $form->field($commentmodel,'created_at')->hiddenInput(['value'=>time()])->label(false);?>
        <?= Html::submitButton('Оставить'); ?>
<?php ActiveForm::end(); ?>
<?php Pjax::end(); ?>

