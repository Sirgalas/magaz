<?php
use yii\helpers\Html;
use yii\helpers\Url;
use frontend\widget\size\Size;
use frontend\widget\price\Price;
?>
<h3 class="col-lg-offset-4 col-md-offset-0 col-lg-16 col-md-24 col-sm-24 col-xs-24"  ><?=$json->text /*?> <small><a href="<?= Yii::$app->urlManager->createUrl(['/gods/gods/category'/*,'slug'=>$json->slug* /])?>"><?= Yii::t('frontend','GODSALL')?><span class="fa fa-long-arrow-right"></span></a> </small>*/ ?> </h3>
<div class="col-lg-24 col-md-24 col-sm-24 col-xs-24">
    <div class="col-lg-offset-3 col-md-offset-0 col-lg-1 col-md-1 col-sm-1 col-xs-1 godsprev <?= $classes; ?>">
        <a href="#"><span class="fa fa-angle-left"></span> </a>
    </div>
    <div class="col-lg-16 col-md-22 col-sm-22-col-xs-22 godscarusels <?= $classes; ?> owl-carousel owl-theme">
    <?php
    if(isset($goods)){
        foreach ($goods as $model) {?>
            <div class="item">
                <a href="<?= Yii::$app->urlManager->createUrl(['/gods/gods/onegods','slug'=>$model->slug_gods]); ?>" class="topitem col-lg-24 col-md-24 col-sm-24 col-xs-24">
                    <div class="img">
                        <?php foreach ($model->category as $cat){
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
                                    echo Html::img(Yii::getAlias('@frontendWebroot/image/') . $image->path . '' . $image->name, ['alt' => $model->title ]);
                                }else{
                                    echo Html::img(Yii::getAlias('@frontendWebroot/image/') . $image->path . '' . $image->name, ['alt' => $model->title]);
                                }
                            }
                        }
                        ?>
                        <?php 
                        $data=time()-(60*60*24*7*3);
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
                            <p class="dimens">
                                <?= Size::widget(['models'=>$model,'target'=>'category','category' => $model->category ,'set'=>$model->sets]); ?>
                            </p>
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
            <?php } 
    } ?>
    </div>
    <div class="col-lg-1 col-md-1 col-sm-1 col-xs-1 godsnext <?= $classes; ?>">
        <a href="#"><span class="fa fa-angle-right"></span> </a>
    </div>
</div>
