<?php
use yii\helpers\Url;
use frontend\widget\cat\Cat;
use yii\helpers\Html;
/* @var $this yii\web\View */
$this->params['body-class'] = 'index';
$this->title = 'Интернет магазин "Милый дом" - оптово-розничный магазин модной одежды для всей семьи и товаров для дома.';
$this->registerMetaTag([
    'name' => 'description',
    'content' => Yii::t('frontend','site_description')
]);

?>

<section class="container-fluid category" id="direction-waypoint">
    <div class="row">
        <div class="col-lg-offset-4 col-md-offset-0 col-lg-16 col-md-24 col-sm-24 col-xs-24">
            
            <?= Cat::widget(['location'=>'Левая','FrontSet'  =>  $FrontSet,'carusel'=>false,'classes'=>false]) ?>
            <?= Cat::widget(['location'=>'Центр','FrontSet'  =>  $FrontSet,'carusel'=>false,'classes'=>false]) ?>
            <?= Cat::widget(['location'=>'Правая','FrontSet'  =>  $FrontSet,'carusel'=>false,'classes'=>false]) ?>
        </div>
    </div>
</section>
<div class="container-fluid">
    <div class="row">
        <h1 class="home col-lg-offset-4 col-md-offset-0 col-lg-16 col-md-24 col-sm-24 col-xs-24"><?=Yii::t('frontend','BUYGOODFORSHOP'); ?></h1>
        <section class="godscarusels">
            <?= Cat::widget(['location'=>'Врехняя','FrontSet'  =>  $FrontSet,'classes'=>'hit','carusel'=>true]); ?>
        </section>
        <section class="godscarusels">
            <?= Cat::widget(['location'=>'Средняя','FrontSet'  =>  $FrontSet,'classes'=>'sales','carusel'=>true]); ?>
        </section>
        <section class="godscarusels">
            <?= Cat::widget(['location'=>'Нижняя','FrontSet'  =>  $FrontSet,'classes'=>'news','carusel'=>true]); ?>
        </section>
    </div>
</div>    
<section class="container-fluid revcarusels">
    <div class="row">
        <h3 class="col-lg-offset-4 col-md-offset-0 col-lg-16 col-md-24"><?= Yii::t('frontend','REVIEWS') ?></h3>
        <div class="col-lg-24 col-md-24">
            <div class="col-lg-offset-4 col-md-offset-0 col-lg-1 col-md-2 col-sm-4 col-xs-4 arrow">
                <a href="#" class="revprev"><span class="fa fa-angle-left fa-4x"></span> </a>
            </div>
            <div class="col-lg-14 col-md-20 col-sm-16 col-xs-16 rewcarusel owl-carousel owl-theme">
                <?php foreach ($comments as $comment){ ?>
                <div class="item col-lg-24 col-md-24 col-sm-24 col-xs-24">
                    <?php if(isset($comment->user->avatar)){ ?>
                        <?= Html::img(Yii::getAlias('@frontendWebroot').'/image/'.$comment->user->avatar,['alt'=>$comment->user->username.'-avatar']); ?>
                    <?php }else{ ?>
                        <?= Html::img(Yii::getAlias('@frontendWebroot').'/image/frontendImage/noavatar.jpeg',['alt'=>$comment->user->username.'-noavatar']); ?>
                    <?php } ?>
                    <h4 class="name"><?= $comment->user->name; ?></h4>
                    <p><?= $comment->text ?></p>
                </div>
                <?php } ?>
            </div>
            <div class="col-lg-1 col-md-2 col-sm-4 col-xs-4 arrow">
                <a href="#" class="revnext"><span class="fa fa-angle-right fa-4x"></span> </a>
            </div>
        </div>
    </div>
</section>
<section class="container-fluid blogs">

    <div class="row">
        <div class="col-lg-offset-3 col-md-offset-0 col-lg-1 col-md-2 col-sm-4 col-xs-4 arrow">
            <a href="#" class="blogprev"><span class="fa fa-angle-left fa-2x"></span> </a>
        </div>
        <div class="col-lg-16 col-md-20 col-sm-16 col-xs-16 blogcarusel owl-carousel owl-theme">
            <?php
            foreach ($pages as $page){
               
                ?>
            <div class="item">
                <?php $img = array_filter($page->images, function($item) {
                    return $item->forHome == 1;
                });
                if(isset($img)){
                    foreach($img as $image){
                        echo Html::img(Yii::getAlias('@frontendWebroot/image/') . $image->path . 'news-' . $image->name, ['alt' => $page->title]);}
                }
                ?>
                <div class="text">
                    <h4><a href="<?= Yii::$app->urlManager->createUrl(['/post/post/onepost','id'=>$page->slug_post]);?>"><?= $page->title ?></a></h4>
                    <p><?= $page->quote ?></p>
                    <a href="<?= Yii::$app->urlManager->createUrl('/post/post/category');?>"><?= Yii::t('frontend','GOALL')?><span class="fa fa-angle-right"></span> </a>
                </div>
            </div>
            <?php } ?>
        </div>
        <div class="col-lg-1 col-md-2 col-sm-4 col-xs-4 arrow">
            <a href="#" class="blognext"><span class="fa fa-angle-right fa-2x"></span> </a>
        </div>
    </div>
</section>