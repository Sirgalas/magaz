<?php
use yii\helpers\Html;
use kartik\rating\StarRating;
use frontend\widget\stars\Stars;
use frontend\widget\price\Price; ?>

<?php if(isset($recomented)) {
    $arrStarrs=1;
    foreach ($recomented as $goods) {
        echo "<a href=".Yii::$app->urlManager->createUrl(['/gods/gods/onegods','slug'=>$goods->slug_gods])." class='topitem col-lg-24 col-md-24 col-sm-24 col-xs-24'>";
        echo '<div class="item">';
        $img = array_filter($goods->images, function($item) {
            return $item->forHome == 1;
        });
        echo '<div class="image">';
            if(isset($img)){
                foreach($img as $image) {
                    if ($image->forFancy == 1) {
                        echo Html::img(Yii::getAlias('@frontendWebroot/image/') . $image->path . '' . $image->name, ['alt' => $goods->title]);
                    }else{
                        echo Html::img(Yii::getAlias('@frontendWebroot/image/') . $image->path . '' . $image->name, ['alt' => $goods->title]);
                    }
                }
            }
        echo '</div>';
            ?>
            <div class="text">
                    <p class="stars">
                    <?php if(isset($goods->ratingSum[0]['sumed'])&&isset($goods->ratingCount[0]['counted']))
                        $summ=$goods->ratingSum[0]['sumed']/$goods->ratingCount[0]['counted'];
                    else
                        $summ=0;
                    ?>
                    <p class="name"><?= $goods->title ?></p>
                    <p class="price"><?= Price::widget(['model'=>$goods])?></p>
                </div>
                <div class="hovertext">
                    <div class="top">
                        <p class="name"><?= $goods->title ?></p>
                        <p class="аvail"><?php if($goods->have==0){ ?><small><?= Yii::t('frontend','HAVE'); ?></small><?php }else{?> <small><?=Yii::t('frontend','NOTHAVE');?></small><?php } ?></p>
                        <p class="dimens"><?php $sizes = array_filter($goods->addfeilds, function($item) {
                                return $item->key_feild == 'size';
                            });
                            foreach ($sizes as $size){
                                echo $size->value;
                            }
                            ?></p>
                        <p class="price">
                            <span class="new  col-ld-12 col-md-12 col-sm-12 col-xs-12"> <?=$goods->prise->price1 ?> грн</span>
                                <!--<span class="old  col-ld-12 col-md-12 col-sm-12 col-xs-12">450,00 грн</span></p>-->
                    </div>

                </div>
            </div>
        </a>
<?php
            $arrStarrs=$arrStarrs+1;
        }
    
}?>