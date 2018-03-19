<?php

use yii\helpers\Html;

/* @var $this yii\web\View */
/* @var $model common\models\FrontendSetup */

$this->title = Yii::t('backend','tableDefaultUpdate');
$this->params['breadcrumbs'][] = ['label' => Yii::t('backend','tableDefault'), 'url' => ['index']];
$this->params['breadcrumbs'][] = ['label' => $model->id, 'url' => ['view', 'id' => $model->id]];
$this->params['breadcrumbs'][] = 'Update';
?>
<div class="frontend-setup-update">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
        'firmDefault'   =>  $firmDefault
    ]) ?>

</div>
