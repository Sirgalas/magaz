<?php



use yii\helpers\Html;
use yii\widgets\MaskedInput;

/**
 * @var yii\web\View $this
 * @var yii\widgets\ActiveForm $form
 * @var dektrium\user\models\Profile $profile
 */

$this->title = Yii::t('frontend', 'PROFILESETTINGS');
$this->params['breadcrumbs'][] = $this->title;
?>

<?= $this->render('_alert', ['module' => Yii::$app->getModule('user')]) ?>

<div class="row">
    <div class="col-md-3">
        <?= $this->render('_menu',[
            'model'=>$model
        ]) ?>
    </div>
    <div class="col-md-16">
        <div class="panel panel-default">
            <div class="panel-heading">
                <?= Html::encode($this->title) ?>
            </div>
            <div class="panel-body">
                <div class="col-md-20 col-sm-20 col-sm-20 col-xs-20">
                    <?php $form = \yii\widgets\ActiveForm::begin(['id' => 'profile-form','options' => ['class' => 'form-horizontal']]); ?>
                </div>
                <div class="col-md-20 col-sm-20 col-sm-20 col-xs-20">
                    <?= $form->field($model, 'name')->textInput(); ?>
                </div>
                <div class="col-md-20 col-sm-20 col-sm-20 col-xs-20">
                    <?= $form->field($model, 'email')->textInput() ?>
                </div>
                <div class="col-md-20 col-sm-20 col-sm-20 col-xs-20">
                    <?= $form->field($model, 'adress')->textInput() ?>
                </div>
                <div class="col-md-20 col-sm-20 col-sm-20 col-xs-20">
                    <?= $form->field($model, 'tel')->label(Yii::t('frontend', 'USERPHONE'))->widget(MaskedInput::className(), ['mask' => '+3 (999) 999 99 99',])->textInput(['placeholder' => Yii::t('frontend', 'USERPHONE')]); ?>
                </div>
                <div class="col-md-20 col-sm-20 col-sm-20 col-xs-20">
                    <?= \zainiafzan\widget\Dropzone::widget([
                        'options' => [
                            'addRemoveLinks'    => true,
                            'url'               => 'profile',
                            'dictDefaultMessage'=> Yii::t('frontend','TEXTDROPFILE'),
                        ],
                        'clientEvents' => [
                            'complete' => "function(file,dataUrl){  
                                document.getElementById('user-avatar').setAttribute('value',file.name);
                                console.log(file.name);
                            }",
                            'success'=>'function(file){console.log(file)}',
                            'sending' => "function(file, xhr, formData){formData.append('".Yii::$app->request->csrfParam."','".Yii::$app->request->getCsrfToken() ."')}"
                        ]
                    ])?>
                </div>
                <div class="col-md-20 col-sm-20 col-sm-20 col-xs-20">
                    <?= $form->field($model, 'avatar')->hiddenInput()->label(false);?>
                </div>

                <div class="form-group">
                    <div class="col-lg-offset-15 col-lg-9">
                        <?= Html::submitButton($model->isNewRecord ? Yii::t('backend','CREATE') : Yii::t('backend','UPDATE'), ['class' => $model->isNewRecord ? 'btn btn-success' : 'btn btn-primary']) ?><br>
                    </div>
                </div>

                <?php \yii\widgets\ActiveForm::end(); ?>
            </div>
        </div>
    </div>
</div>
