<?php
use yii\helpers\Html;
use frontend\widget\seo\Seo;

$this->params['breadcrumbs'][] =$models->title;?>

<?=Seo::widget(['addfeilds'=>$models->addfeilds,'model'=>$models,'category'=>false,'description'=>'description_page']);?>


<section class="container-fluid">
    <div class="row">
        <div class="col-lg-offset-4 col-md-offset-0 col-lg-16 col-md-24 col-sm-24 col-xs-24 blog">
            <h2 class="col-lg-24 col-md-24 col-sm-24 col-xs-24"><?= $models->title ?></h2>
            <p><?= $models->description_page; ?></p>
        </div>
    </div>
</section>



