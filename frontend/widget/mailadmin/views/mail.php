<?php
use yii\helpers\Html;
use yii\helpers\Url;
use frontend\widget\siteimage\Siteimage;
?>
<table border="0" cellpadding="0" cellspacing="0" style="margin:0; padding:0;background:#ffffff;width:100%;">
    <tr>
        <td width='550'>
        <?= Html::a(Html::img(Yii::getAlias('@frontendWebroot/image/frontendImage/logo.jpg')),'http://http://miliydom.com.ua') ?>
        </td>
    </tr>
</table>
<table  style='background:#ffffff;width:100%;padding-bottom:10px'>
    <tr>
        <td>
            <br/>
            <p style='font-family:Arial;color:#000000;font-size:14px'><?= $text ?></p>

        </td>
    </tr>
</table>
<table  style='background:#ffffff;width:100%;padding-bottom:10px'>
    <tr>
        <table style="background:#FFFFFF;width:100%;">
            <tr>
                <td>
                    <p style="color:#000000; padding-top:5px;padding-bottom:5px;"><b><?= Yii::t('frontend','DetalOrder')?></b></p>
                </td>
            </tr>
        </table>
    </tr>
    <tr>
        <td>
            <p><b>№ заказа:</b> 123<?= $orders->id; ?></p>
            <p><b>Дата заказа:</b> <?= date('d:m:Y',$orders->datetime); ?></p>
            <p><b>E-Mail:</b> <?= $email ?></p>
        </td>
    </tr>
</table>
<table  border="0" cellpadding="0" cellspacing="0" style="margin:0; padding:0;background:#ffffff;width:100%;">
    <?php
    $final=array();
    $count=0;
    foreach ($orders->baskets as $order){
    $count=$count+1;
    ?>
        <tr>
            <td width="50"><?= $count; ?></td>
            <td width="200">
                <table  style="background:#ffffff;width:100%;">
                    <tr>
                        <td>
                            <p style='color:#000000'><b><?= Html::a($order->gods->title,'http://miliydom.com.ua/goods/'.$order->gods->slug_gods)?></b></p>
                        </td>
                    </tr>
                </table>
            </td>
            <td width="50">
                    <?php $img  = array_filter($order->gods->images, function($item) {
                        return $item->forHome == 1;
                    });
                    if(isset($img)){
                        foreach($img as $image){?>
                        <?= Html::a(Html::img(Yii::getAlias('@frontendWebroot/image/').$image->path.'avatar-'.$image->name),'http://miliydom.com.ua/goods/'.$order->gods->slug_gods); ?>
                    <?php }
                        } ?>
            </td>
            <td width="200">
                <p style='font-family:Arial;color:#000000;font-size:14px;padding-left:10px'>
                    <b style='font-family:Arial;color:#000000;font-size:16px; display:block;padding-bottom:7px'><br/>
                        <span style='font-family:Arial;color:#000000;font-size:16px;display:block;padding-bottom:7px;padding-left:20px'> <b><?= $order->quantity?></b> шт.</span>

                        <span style='font-family:Arial;color:#000000;font-size:16px;display:block;padding-bottom:7px;padding-left:20px'>х <b><?= $order->prises->price1; ?></b> грн</span>
                </p>
            </td>
        </tr>
    <?php
    $final[]=$order->prises->price1;
    } ?>
    <tr>
        <td></td>
        <td></td>
        <td></td>
        <td>
            <br/>
            <table style="background:#ffffff;float:padding-top:10px;">
                <tr>
                    <td>
                        <p style="color:#000000; padding-top:5px;padding-bottom:5px;">Итого <b><?= array_sum($final) ?></b> грн.</p>
                    </td>
                </tr>
            </table>
        </td>
    </tr>
</table>
<table  style='background:#ffffff;width:100%;padding-bottom:10px'>
    <tr>
        <table style="background:#ffffff;width:100%;">
            <tr>
                <td>
                    <p style="color:#000000; padding-top:5px;padding-bottom:5px;"><b>Адрес доставки</b></p>
                </td>
            </tr>
        </table>
    </tr>
    <tr>
        <td>
            <p><b>Получатель:</b> <?= $family ?><?= $name ?></p>
            <p><b>Телефон:</b> <?= $userTel; ?></p>
            <p><b>адрес получения:</b> <?= $adress; ?></p>
        </td>
    </tr>
</table>
<table  border="0" cellpadding="0" cellspacing="0" style="margin:0; padding:0;background:#ffffff;width:100%;">
    <tr>
        <td>
            <p>Интернет магазин <?= Html::a('"Милый дом"','http://miliydom.com.ua'); ?></p>
        </td>
    </tr>

</table>
<table>
    <tr>
        <td>Мы в соц сетях</td>
        <?php foreach ($socials as $social) { ?>
        <td>
           <?php  if($social->key_setup=='ok'){ ?>
            <?= Html::a(Html::img(Yii::getAlias('@frontendWebroot/').'image/frontendImage/ok.png',['width'=>30]),$social->vaelye); ?>
            <?php } ?>
        </td>
        <td>
            <?php  if($social->key_setup=='vk'){ ?>
                <?= Html::a(Html::img(Yii::getAlias('@frontendWebroot/').'image/frontendImage/vk.png',['width'=>30]),$social->vaelye); ?>
            <?php } ?>
        </td>
        <td>
            <?php  if($social->key_setup=='facebook'){ ?>
                <?= Html::a(Html::img(Yii::getAlias('@frontendWebroot/').'image/frontendImage/facebook.png',['width'=>30]),$social->vaelye); ?>
            <?php } ?>
        </td>
        <td>
            <?php  if($social->key_setup=='instagram'){ ?>
                <?= Html::a(Html::img(Yii::getAlias('@frontendWebroot/').'image/frontendImage/instagram.png',['width'=>30]),$social->vaelye); ?>
            <?php } ?>
        </td>
        <?php } ?>
    </tr>
</table>


