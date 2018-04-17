<?php
use yii\widgets\ActiveForm;
use yii\helpers\Html;
use yii\widgets\MaskedInput;
if(Yii::$app->user->id){
$email= Yii::$app->user->identity->email;
}else{
 $email='';
} ?>
<div class="container-fluid">
    <div class="row">
        <?php if($messege == 'not'){ ?>
            <h1><?=Yii::t('frontend','SOMETHINGWENTWRONG')?></h1>
            <?php }
        if($user){
                ?>
                <?= Html::tag('p','Для оформления заказа заполните, пожалуйста, форму приведенную ниже.  Поля отмеченные звездочкой - обязательны к заполнению.',['class'=>'col-lg-8 col-md-8 col-sm-12 col-xs-24 col-lg-offset-8 col-md-offset-8 col-sm-offset-6 col-xs-offset-0 textСarttab']) ?>
                <?php $form = ActiveForm::begin(['action' => Yii::$app->urlManager->createUrl(['/cart/cart/user/']), 'options' => ['class' => 'carttab order col-lg-8 col-md-8 col-sm-12 col-xs-24 col-lg-offset-8 col-md-offset-8 col-sm-offset-6 col-xs-offset-0']]); ?>
                <?= $form->field($user, 'name')->textInput()->label(Yii::t('frontend', 'USERNAME')); ?>
                <?= $form->field($user, 'famaly')->label(Yii::t('frontend', 'USERFEMALY'))->textInput(['value'=>'']); ?>
                <?= $form->field($user, 'email')->label(Yii::t('frontend', 'USEREMAIL'))->textInput(['value'=>'']); ?>
                <?= $form->field($user, 'tel')->label(Yii::t('frontend', 'USERPHONE'))->widget(MaskedInput::className(), ['mask' => '+99 (999) 999 99 99',])->textInput(['placeholder' => Yii::t('frontend', 'USERPHONE')]); ?>
                <?= $form->field($user, 'sity')->label(Yii::t('frontend', 'USERESITY'))->textInput(['value'=>'']); ?>
                <?= $form->field($user, 'adress')->label(Yii::t('frontend', 'USERADRESS'))->textInput(['value'=>'']); ?>
                <?= $form->field($user, 'officeNewPost')->label(Yii::t('frontend', 'USEROFFICENEWPOST'))->textInput(['value'=>'']); ?>
                <?= $form->field($user, 'operation_id')->label(false)->hiddenInput(['value'=>$operation_id]); ?>
                <?= $form->field($user, 'orderid')->label(false)->hiddenInput(['value'=>$orderid]); ?>
                <?= $form->field($order, 'comment')->textarea()->label(Yii::t('frontend', 'ORDERCOMMENT')); ?>
                <div class="form-group">
                    <?= Html::submitButton(Yii::t('frontend', 'USERCREATE'), ['class' => 'button']) ?>
                </div>

                <?php ActiveForm::end();
            }else{?>
                <h1><?=Yii::t('frontend','THANKYOU')?></h1>
            <?php } ?>
    </div>
</div>
