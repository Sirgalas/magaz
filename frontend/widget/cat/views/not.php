<?php
use yii\helpers\Html;
use yii\helpers\Url; ?>

    <div class="col-lg-8 col-md-8 col-sm-24 col-xs-24">
        <?= Html::a(Html::img($json->path).'<span class="black">'.$json->text.'</span>', Url::to(['gods/gods/category','slug'=>$json->slug]) , ['class'=>'col-lg-24 col-md-24 col-sm-24 col-xs-24']); ?>
    </div>
