<?php

use yii\helpers\Html;

/* @var $this yii\web\View */
/* @var $name string */
/* @var $message string */
/* @var $exception Exception */

$this->title = $name;
?>
<section class="container-fluid category" id="direction-waypoint">
    <div class="row">
        <div class="site-error">
            <h1 class="col-md-12 col-sm-24 col-md-offset-6 col-sm-offset-0">
                <?= 'Извините но '.nl2br(Html::encode($message)) ?>
            </h1>
            <div class="col-md-12 col-sm-24 col-md-offset-6 col-sm-offset-0">
                <?= Html::img(Yii::getAlias('@frontendWebroot').'/image/frontendImage/404.jpg') ?>

            </div>
        </div>
    </div>
</section>