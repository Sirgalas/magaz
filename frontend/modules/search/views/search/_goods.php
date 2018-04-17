<?php
use yii\helpers\Html;
use frontend\widget\price\Price;
?>

<div class="item col-lg-8 col-md-8 col-sm-12 col-xs-24">
    <a href="<?= Yii::$app->urlManager->createUrl(['/gods/gods/onegods','slug'=>$model->slug_gods]); ?>" class="topitem col-lg-24 col-md-24 col-sm-24 col-xs-24">
        <div class="img">
            <?php $img = array_filter($model->images, function($item) {
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
        </div>
        <div class="text">
            <p class="name"><?= $model->title ?></p>
            <p class="price"><?= Price::widget(['model'=>$model])?></p>
        </div>
        <div class="hovertext">
            <div class="top">
                <p class="name"><?= $model->title ?></p>
                <p class="аvail">
                    <?php if($model->have==1){
                        echo Yii::t('frontend','NOTHAVE');
                    }else{
                        echo Yii::t('frontend','HAVE');

                    } ?>
                </p>
                <p class="dimens">
                    <?php $sizes = array_filter($model->addfeilds, function($item) {
                        return $item->key_feild == 'size';
                    });
                    if(count($sizes)==1) {
                        foreach ($sizes as $size) {
                            echo $size->value;
                        }
                    }else{
                        $count=0;
                        foreach ($sizes as $size){
                            $count=$count+1;
                            if($count==1){
                                echo Yii::t('frontend','ONE_AND_A_HALF').': '. $model->prise->price1.'</br>';
                            }
                            if($count==2){
                                echo Yii::t('frontend','DOUBLE_SET').': '. $model->prise->price2.'</br>';
                            }
                            if($count==3){
                                echo Yii::t('frontend','EVRO').': '. $model->prise->priceEvro.'</br>';
                            }
                            if($count==4){
                                echo Yii::t('frontend','FAMILY').': '. $model->prise->priceSem.'</br>';
                            }
                        }
                    }
                    ?>
                </p>
                <p class="price"><?= Price::widget(['model'=>$model])?></p>
            </div>
            <div class="bottom">
                <a href="<?= Yii::$app->urlManager->createUrl(['/gods/gods/onegods','slug'=>$model->slug_gods]); ?>" class="button"><?=Yii::t('frontend','CUSTOMER'); ?></a>
            </div>
        </div>
    </a>
</div>