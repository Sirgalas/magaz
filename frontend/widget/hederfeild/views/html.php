<?php
use yii\helpers\Html;
use yii\widgets\ActiveForm;
?>
<div class="col-lg-4 col-md-4 col-sm-12 col-xs-24 workSearch">
    <p class="col-lg-24 col-md-24 col-sm-24 col-xs-24 work">
        <?= $work->vaelye; ?>
    </p>
    <div class="col-lg-24 col-md-24 col-sm-24 col-xs-24 search">
        <?php $form=ActiveForm::begin(['action'=>Yii::$app->urlManager->createUrl('/search/search/index'),'method'=>'get','options'=>['class'=>'displayNone'] ]);?>
            <?= Html::textInput('query','', ['placeholder'=>"Найти"]); ?>
        <?php $form=ActiveForm::end(); ?>
    </div>
</div>
<div class="col-lg-5 col-md-6 col-sm-12 col-xs-24 tel">
    <?= $tel->vaelye; ?>

</div>
