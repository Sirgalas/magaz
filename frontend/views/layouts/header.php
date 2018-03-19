<?php
use frontend\widget\siteimage\Siteimage;
use yii\helpers\Html;
use frontend\widget\hederfeild\Hederfeild;
use frontend\widget\menutest\Menutest;
use frontend\widget\countcart\Countcart;
use frontend\widget\slider\Slider;
use frontend\widget\carusel\Carusel;
use yii\helpers\Url;
use frontend\widget\menu\Menu;


?>
<div class="container-fluid">
    <div class="row">
        
            <div class="col-lg-24 col-md-24 col-sm-24 col-xs-24 logohead">
                <div class="col-lg-5 col-md-6 col-sm-12 col-xs-24 col-lg-offset-2 col-md-offset-0 logoImage">
                    <a href="<?= Yii::$app->homeUrl; ?>"><?= Siteimage::widget(['name'=>'logo']); ?></a>
                </div>
                <div class="col-lg-6 col-md-8 col-sm-12 col-xs-24 entermenu">
                    <?php if (Yii::$app->user->isGuest) { ?>
                        <div class="text">
                            <a href="<?= Yii::$app->urlManager->createUrl('/user/security/login')?>">Вход</a>
                            <a href="<?= Yii::$app->urlManager->createUrl('/user/registration/register')?>">Регистрация</a>
                        </div>
                    <?php }else{ ?>
                        <div class="text">
                            <a href="<?= Yii::$app->urlManager->createUrl('/settings/profile')?>">Профиль</a>
                            <a href="<?= Yii::$app->urlManager->createUrl('/settings/account')?>">Настройки акаунта</a>
                            <?= Html::a('Выход',Url::to(['/user/security/logout']),['data-method'=>'post']); ?>
                        </div>
                    <?php } ?>
                </div>
                <?= Hederfeild::widget(); ?>
            </div>
            
    </div>
</div>
<div class="container-fluid pink">
    <div class="row">
        <div class="col-lg-8 col-md-9 col-sm-20 col-xs-7 col-lg-offset-2 col-md-offset-0 rightmenu">
            <?= Menutest::widget([
                'home'              =>  'Главная',
                'location'          =>  'HederMenuLeft',
                'numberCollaps'     =>  1
            ]);
            ?>
        </div>
        <div class="cart col-lg-3 col-md-2 col-sm-24 col-xs-10" id="someCart">
            <a href="<?= Yii::$app->urlManager->createUrl('/cart/cart/index')?>">
                <?= Siteimage::widget(['name'=>'cart']); ?>
                <?= Countcart::widget();?>
            </a>
        </div>
        <div class="col-lg-8 col-md-10 col-sm-20 col-xs-7 rightmenu">
            <?= Menutest::widget([
                'location'          =>  'HederMenuRight',
                'numberCollaps'     =>  1
            ]);
            /*?>

            <?= Menu::widget(['menu'=>'heder-menu-right','location'=>'header','numberCollaps'=>2]);*/ ?>
        </div>
    </div>
</div>
<?php 
if (isset($this->params['body-class'])){ ?>
    <?= Slider::widget() ?>
<?php } ?>
<?= Carusel::widget() ?>