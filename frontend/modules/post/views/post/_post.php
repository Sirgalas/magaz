<?php
use yii\helpers\Html;
$utc  = new DateTimeZone('UTC');
$date = new DateTime($model->data, $utc);
?>
<div class="col-lg-24 col-md-24 col-sm-24 col-xs-24">
    <h2 class="col-lg-24 col-md-24 col-sm-24 col-xs-24"><?= $model->title ?> <small><?= $date->format('j.m.Y'); ?></small></h2>
    <div class="col-lg-8 col-md-8 col-sm-12 col-xs-12">
    <?php $img = array_filter($model->images, function($item) {
        return $item->forHome == 1;
    });
    if(isset($img)){
        foreach($img as $image){
            echo Html::img(Yii::getAlias('@frontendWebroot/image/') . $image->path . 'news-' . $image->name, ['alt' => $model->title, 'width'=>187]);}
    }
    ?>
    <p></p>
    </div>
    <p class="col-lg-16 col-md-16 col-sm-12 col-xs-12"><?= $model->quote; ?></p>
    <a href="<?= Yii::$app->urlManager->createUrl(['/post/post/onepost','id'=>$model->slug_post]);?>" class="opentext"><?= Yii::t('frontend','OPENTEXT') ?></a>

</div>
