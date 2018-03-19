<?php
use yii\helpers\Html;
use frontend\widget\recomented\Recomented;
use frontend\widget\comments\Comments;
use frontend\widget\cart\Cart;
use frontend\widget\addlines\Addlines;
use frontend\widget\size\Size;
use frontend\widget\price\Price;
use kartik\checkbox\CheckboxX;
use frontend\widget\seo\Seo;
$article= array_filter($models->addfeilds, function($item) {
    return $item->key_feild == 'article';
});
$session = Yii::$app->session;
$session->get('id');
$this->params['breadcrumbs'][] = ['label' => $category->parentcat->name, 'url' =>['/gods/gods/category','slug'=>$category->parentcat->slug_category] ];
$this->params['breadcrumbs'][] = ['label' => $category->name, 'url' => ['/gods/gods/category','slug'=>$category->slug_category]];
$this->params['breadcrumbs'][] = $models->title;
$this->params['footer'] = 'oneProduct'
?>
<?=Seo::widget([
    'addfeilds'=>$models->addfeilds,
    'model'=>$models,
    'category'=>false,
    'description'=>'discription_gods',
    'templates'=>$category->templates
]);?>
<section class="container-fluid onegods">
    <div class="row">
        <div class="col-lg-24 col-md-24 col-sm-24 col-xs-24">
            <div class="col-lg-24 col-md-24 col-sm-24 col-xs-24 onegodscorusels">
                <div class="col-lg-10 col-md-14 col-sm-24 col-xs-24 col-lg-offset-2 col-md-offset-2 col-sm-offset-0 goodsnopadding">
                    <div class="col-lg-5 col-md-5 col-sm-5 nophone">
                        <a class="jcarousel-next jcarousel-button" href="#"><span class="fa fa-angle-up fa-4x" aria-hidden="true"></span></a>
                        <div class="jcarousel">
                            <ul>
                                <?php $img = array_filter($models->images, function($item) {
                                    return $item->forHome != 1;
                                });
                                if(isset($img)){
                                    $countimg=0;
                                    foreach($img as $image) { ?>
                                        <li><a class="img2" href="#img<?= $countimg ?>"><?php echo Html::img(Yii::getAlias('@frontendWebroot/image/').$image->path.'avatar-'.$image->name,['alt' => $models->title]); ?></a></li>
                                    <?php
                                    $countimg=$countimg+1;
                                    }
                                }?>
                            </ul>
                        </div>
                        <a class="jcarousel-prev jcarousel-button" href="#"><span class="fa fa-angle-down fa-4x" aria-hidden="true"></span></a>
                    </div>
                    <div class="col-lg-18 col-md-18 col-sm-22 col-xs-24 nopaddinggoods">
                        <div class="col-lg-24 col-md-24 col-sm-24 col-xs-24 onegodscarusel owl-carousel owl-theme  col-lg-offset-1  col-md-offset-1  col-sm-offset-1">
                            <?php foreach ($models->images as $images) {
                                if($images->forFancy==1){ ?>
                                    <div class="item"  data-hash="img1"><a class="fancybox-thumb" rel="fancybox-thumb" href="<?=Yii::getAlias('@frontendWebroot/image/').$images->path.''.$images->name; ?>"><?= Html::img(Yii::getAlias('@frontendWebroot/image/').$images->path.''.$images->name,['alt' => $models->title,'class'=>'imgforfancy']); ?></a></div>
                                <?php }elseif($images->forHome==0){
                            $countsimg=2;
                            ?>
                            <div class="item"  data-hash="img<?=$countsimg ?>"><a class="fancybox-thumb" rel="fancybox-thumb" href="<?=Yii::getAlias('@frontendWebroot/image/').$images->path.''.$images->name; ?>"><?= Html::img(Yii::getAlias('@frontendWebroot/image/').$images->path.''.$images->name,['alt' => $models->title,'class'=>'imgforfancy']); ?></a></div>
                                <?php
                                $countsimg=$countsimg+1;}else{}
                            } ?>
                        </div>
                        <div class="col-lg-24 col-md-24 col-sm-24 col-xs-24 imageBottom">
                            <p><?= Yii::t('frontend','ImageBootom') ?></p>
                        </div>
                    </div>
                </div>
                <div class="col-md-10 col-lg-10 col-sm-24">
                    <div class="col-lg-24 col-md-24 col-sm-24 col-xs-24 text">
                        <div class = 'reg-from-popup'>
                            <h1 class="col-lg-24 col-md-24 col-sm-24 col-xs-24"><?= $models->title ?></h1>
                            <h2 class="col-lg-24 col-md-24 col-sm-24 col-xs-24 price"><span class="col-lg-5 col-md-5 col-sm-12 col-xs-12"><?= Html::encode('Цена:'); ?> </span><?= Price::widget(['model'=>$models])?></h2>
                            <p class="col-lg-24 col-md-24 col-sm-24 col-xs-24 price article"><?php if (!empty($article)){ foreach ($article as $articles){ ?>Артикул: <?php echo $articles->value; }} ?></p>
                            <p class="col-lg-24 col-md-24 col-sm-24 col-xs-24 avail">Наличее: <?php if($models->have==0){ ?><small><?=Yii::t('frontend','HAVE'); ?></small><?php }else{?> <small><?=Yii::t('frontend','NOTHAVE'); ?></small><?php } ?></p>
                            <p class="col-lg-24 col-md-24 col-sm-24 col-xs-24 color">
                                <?php $colors = array_filter($models->addfeilds, function($item) {
                                    return $item->key_feild == 'color';
                                });
                                if(isset($colors)){
                                    foreach ($colors as $color) {
                                        ?>
                                         <div class="col-md-3 colorSect">
                                            <p class='colorText'><?= (is_object($color->frontendSetup))?$color->frontendSetup->key_setup:''; ?></p>
                                            <span class="fa fa-square fa-4x color colorinput " style="color:<?= $color->value; ?>" data-color-id="<?= $color->id; ?>" data-color="<?= $color->value; ?>"></span>
                                           
                                        </div>
                                        <?php
                                    }
                                } ?>
                            </p>
                        </div>
                        <div class="col-lg-24 col-md-24 col-sm-24 col-xs-24 size">
                            
                            <?= Size::widget(['models'=>$models,'target'=>'goods','category'=>$models->category]); ?>
                        </div>
                        <?php
                        if($models->viewsTS!=1){
                            if(isset($models->table_size)){
                                $tabelSizeUrl=$models->tablesize->vaelye;
                            }else if(isset($models->prise->tablesize)){
                                $priseArr=array_filter($models->prise->tablesize,function ($item){
                                    return $item->description=='tableDefault';
                                });
                                if(isset($priseArr)){
                                    foreach ($priseArr as $arrPrise){
                                        $tabelSizeUrl=$arrPrise->vaelye;
                                    }
                                }
                            }
                        }
                        if(isset($tabelSizeUrl)){ ?>
                            <p class="col-lg-24 col-md-24 col-sm-24 col-xs-24 table-size"><a class="tableSize fancybox-thumb" rel="fancybox-thumb" href="<?= $tabelSizeUrl ?>">Таблица размеров</a> </p>
                        <?php } ?>
                        <div  class="col-lg-24 col-md-24 col-sm-24 col-xs-24 cart"><?= Cart::widget(['goods'=>$models]);?></div>
                    </div>
                    <div class="col-lg-24 col-md-24 col-sm-24 col-xs-24 description ">
                        <h3 class="col-lg-24 col-md-24 col-sm-24 col-xs-24"><?= Yii::t('frontend','DESCRIPTIONGOODS') ?></h3>
                        <?php $compositions = array_filter($models->addfeilds, function($item) {
                            return $item->key_feild == 'country';
                        });
                        foreach ($compositions as $composition){
                            echo '<p class="col-lg-24 col-md-24 col-sm-24 col-xs-24"><strong> '.Yii::t('frontend','COUNTRY').'</strong>: '.$composition->value.'</p>';
                        }
                        $compositions = array_filter($models->addfeilds, function($item) {
                            return $item->key_feild == 'composition';
                        });
                        foreach ($compositions as $composition){
                            echo '<p class="col-lg-24 col-md-24 col-sm-24 col-xs-24"><strong> '.Yii::t('frontend','COMPOSITION').'</strong>: '.$composition->value.'</p>';
                        }
                        $compositions = array_filter($models->addfeilds, function($item) {
                            return $item->key_feild == 'delivery';
                        });
                        foreach ($compositions as $composition){
                            echo '<p class="col-lg-24 col-md-24 col-sm-24 col-xs-24"><strong> '.Yii::t('frontend','DELIVERY').'</strong>: '.$composition->value.'</p>';
                        }
                        ?>
                        <?php
                            if($category->parentcat->id!=55){
                         ?>
                        <div class="col-lg-24 col-md-24 col-sm-24 col-xs-24"><p><strong><?= Yii::t('frontend','SIZES_VIEWS') ?>: </strong>
                         <?php
                            }
                            if($models->size1){
                                foreach ($models->size1 as $addfeild){
                                    $sizeGoods[]=$addfeild->value;
                                }
                                echo Html::encode(implode(', ',$sizeGoods));
                            } ?>
                        </p>
                        <div class="col-lg-24 col-md-24 col-sm-24 col-xs-24"><?= $models->discription_gods ?></div>
                        <div class="col-lg-24 col-md-24 col-sm-24 col-xs-24"><p>Сделать заказ на сайте miliydom очень просто - нажмите на кнопку купить и оформите заказ, наши специалисты свяжутся с Вами.</p></div>
                    </div>
                </div>


                </div>
                <div class="col-lg-20 col-md-20 col-sm-20 col-sm-20 col-offes-lg-2 col-md-offset-2 col-sm-offest-2 onegodscorusels">
                    <div class="col-lg-24 col-md-24 col-sm-24 col-sm-24 godscarusels recomenteds">
                        <h3 class="col-lg-8 col-md-8 col-sm-24 col-xs-24" ><?= Yii::t('frontend','SEEALSO') ?><small></small></h3>
                        <div class="col-lg-12 col-md-12 nomobile border"></div>
                        <div class=" col-lg-1 col-md-1 col-sm-1 col-xs-1 prev nomobile news">
                            <a href="#"><span class="fa fa-angle-left"></span> </a>
                        </div>
                        <div class="col-lg-1 col-md-1 col-sm-1 col-xs-1 next nomobile news">
                            <a href="#"><span class="fa fa-angle-right"></span> </a>
                        </div>

                    </div>
                    <div class="col-lg-24 col-md-24 col-sm-24 col-xs-24 godscarusels">
                        <div class="col-lg-24 col-md-24 col-sm-24 col-xs-24 owl-carousel owl-theme news recomented">
                            <?= Recomented::widget(['model'=>$models->category]); ?>
                        </div>
                    </div>
                </div>
            </div>
            <div class="linesall col-lg-24 col-md-24 col-sm-24 col-xs-24">
                <?php
                if(isset($models->linesall)){
                    echo '<h3>'.Yii::t('frontend','SELLAPART').'</h3>';
                    if(!empty($models->linesall->idsheerts)){
                        ?>
                        <div class="apart col-lg-8 col-md-8 col-sm-12 col-xs-24" >
                            <h3><?= Yii::t('frontend','sheerts')?></h3>
                            <p>
                                <?= Addlines::widget(['model'=>$models->linesall->idsheerts,'name'=>'простынь']) ?>
                                <a href="<?= Yii::$app->urlManager->createUrl(['/gods/gods/onegods','slug'=>$models->linesall->sheets->slug_gods]); ?>" >Перейти</a>
                            </p>
                        </div>
                    <?php }
                    if(!empty($models->linesall->idpillowcases)){
                        ?>
                        <div class="apart col-lg-8 col-md-8 col-sm-12 col-xs-24" >
                            <h3><?= Yii::t('frontend','pillowcases')?></h3>
                            <p class="apart">
                                <?= Addlines::widget(['model'=>$models->linesall->idpillowcases,'name'=>'наволочка']) ?>
                                <a href="<?= Yii::$app->urlManager->createUrl(['/gods/gods/onegods','slug'=>$models->linesall->pillowcases->slug_gods]); ?>" >Перейти</a>
                            </p>
                        </div>
                    <?php }
                    if(!empty($models->linesall->duvetcover)){
                        ?>
                        <div class="apart col-lg-8 col-md-8 col-sm-12 col-xs-24" >
                            <h3><?= Yii::t('frontend','duvetcover')?></h3>
                            <p class="apart">
                                <?= Addlines::widget(['model'=>$models->linesall->duvetcover,'name'=>'пододеяльник']) ?>
                                <a href="<?= Yii::$app->urlManager->createUrl(['/gods/gods/onegods','slug'=>$models->linesall->duvetscover->slug_gods]); ?>" >Перейти</a>
                            </p>
                        </div>
                    <?php } ?>
                <?php } ?>
            </div>
        </div>
    </div>
</section>

<?= Comments::widget(['godsId'=>$models->id]);?>
