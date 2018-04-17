<?php

/* @var $this \yii\web\View */
/* @var $content string */

use yii\helpers\Html;
use yii\widgets\Breadcrumbs;
use frontend\assets\AppAsset;
use common\widgets\Alert;
//use frontend\widget\menu\Menu;


AppAsset::register($this);

$session = Yii::$app->session;
$theSID=$session->get('id');
if(!isset($theSID)){
    $hash = Yii::$app->getSecurity()->generatePasswordHash(time().''.Yii::$app->request->userIP);
    $session->set('id',$hash);
}
?>
<?php $this->beginPage() ?>
<!DOCTYPE html>
<html lang="<?= Yii::$app->language ?>">
<head>
    <meta charset="<?= Yii::$app->charset ?>">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <?= Html::csrfMetaTags() ?>
    <title><?= Html::encode($this->title) ?></title>
    <?php $this->head() ?>
    <script>
    var __pkPosition = "top";
    (function(i,s,o,g,r,a,m){i['PK']=r;i[r]=i[r]||function(){
    (i[r].q=i[r].q||[]).push(arguments)},i[r].l=1*new Date();a=s.createElement(o),
    m=s.getElementsByTagName(o)[0];a.async=1;a.charset="UTF-8";a.src=g;m.parentNode.insertBefore(a,m)})(window,document,'script','https://cdn1.pokupon.ua/partner.min.js','pk');
</script>

</head>
<body>
<?php $this->beginBody() ?>
<div id= "toTop" class="nomobile"><span class="fa fa-angle-up"></span></div>
<header>
        <?= $this->render('header'); ?>
</header>
<?= Breadcrumbs::widget([
    'homeLink'=>['label' => 'магазин "Милый дом"', 'url' => '/'],
    'links' => isset($this->params['breadcrumbs']) ? $this->params['breadcrumbs'] : [],
]) ?>
<?= Alert::widget() ?>
<?= $content ?>
<footer>
    <?php if($this->beginCache(['footer','duration'=>Yii::$app->params['duration']])): ?>
        <?= $this->render('footer'); ?>
    <?php $this->endCache(); endif ?>
</footer>
<!-- BEGIN JIVOSITE CODE {literal} -->
<script type='text/javascript'>
(function(){ var widget_id = 'lVVkqeWm0A';var d=document;var w=window;function l(){
var s = document.createElement('script'); s.type = 'text/javascript'; s.async = true; s.src = '//code.jivosite.com/script/widget/'+widget_id; var ss = document.getElementsByTagName('script')[0]; ss.parentNode.insertBefore(s, ss);}if(d.readyState=='complete'){l();}else{if(w.attachEvent){w.attachEvent('onload',l);}else{w.addEventListener('load',l,false);}}})();</script>
<!-- {/literal} END JIVOSITE CODE -->

<?php $this->endBody() ?>
</body>
</html>
<?php $this->endPage() ?>
