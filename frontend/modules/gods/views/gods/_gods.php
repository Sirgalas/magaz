<?php
use yii\helpers\Html;
use frontend\widget\size\Size;
use frontend\widget\price\Price;
?>

<div class="item col-lg-8 col-md-8 col-sm-24 col-xs-24">

<a href="<?= Yii::$app->urlManager->createUrl(['/gods/gods/onegods','slug'=>$model->slug_gods]); ?>" class="topitem col-lg-24 col-md-24 col-sm-24 col-xs-24">
        <div class="img">
            <?php if(is_object($model->article)){ ?>
            <p>Артикул: <?= $model->article->value; ?></p>
        <?php }
        foreach ($model->category as $cat){
            if($cat->id == 67) {
                ?>
            <h2 class="action"><span><?=Yii::t('frontend','ACTION') ?></span></h2>
        <?php }
        }
        $img = array_filter($model->images, function($item) {
        return $item->forHome == 1;
        });
        if(isset($img)){
            foreach($img as $image) {
                if ($image->forFancy == 1) {
                    echo Html::img(Yii::getAlias('@frontendWebroot/image/') . $image->path . '' . $image->name, ['alt' => $model->title]);
                }else{
                    echo Html::img(Yii::getAlias('@frontendWebroot/image/') . $image->path . '' . $image->name, ['alt' => $model->title]);
                }
            }
        }
        ?>
        <?php
            $data=time()-(60*60*24*7*3);
            if($model->create_at>=$data){}
        ?>
    </div>
    <div class="text">
        <p class="name"><?= $model->title ?></p>
        <p class="price">
            <?= Price::widget(['model'=>$model])?>
        </p>
    </div>
    <div class="hovertext">
        <div class="top">
            <p class="name"><?= $model->title ?></p>
            <p class="аvail">
                <?php if($model->have==0){
                    echo Yii::t('frontend','HAVE');
                }else{
                    echo Yii::t('frontend','NOTHAVE');
                } ?>
            </p>
            <div class="dimens">
                    <?= Size::widget(['models' => $model, 'target' => 'category', 'category' => $model->category ,'set'=>$model->sets]); ?>
            </div>
            <p class="price">
                <?= Price::widget(['model'=>$model])?>
            </p>
        </div>
        <div class="bottom">
            <a href="<?= Yii::$app->urlManager->createUrl(['/gods/gods/onegods','slug'=>$model->slug_gods]); ?>" class="button"><?=Yii::t('frontend','CUSTOMER'); ?></a>
        </div>
    </div>
</a>

</div>