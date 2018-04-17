<?php
use yii\widgets\ListView;
use frontend\widget\searchform\Searchform;
use frontend\widget\seo\Seo;
use yii\helpers\Html;

if(isset($category->parentcat)){
    $this->params['breadcrumbs'][] = ['label' => $category->parentcat->name, 'url' =>['/gods/gods/category','slug'=>$category->parentcat->slug_category] ];
}
$this->params['breadcrumbs'][] = $category->name;
?>
<?=Seo::widget(['addfeilds'=>$category->addfeilds,'model'=>$category,'category'=>true,'description'=>'description_category']);?>
<section class="container-fluid">
    <div class="row">
        <div class="col-lg-offset-2 col-md-offset-0 col-lg-20 col-md-24 col-sm-24 col-xs-24">
            <aside class="col-lg-5 col-md-5 col-sm-3 col-xs-4 nomobile">
                <a href="#" class="drop"><span class="fa fa-caret-down"></span> Скрыть фильтры </a>

                <?= Searchform::widget(['category'=>$category])?>
            </aside>
            <div class="col-lg-19 col-md-19 col-sm-24 col-xs-24">
                <?php

                if($actionImage){ ?>
                    <div class="col-lg-24 col-md-24 col-sm-24 col-xs-24 text-center">

                    <?=Html::img(Yii::getAlias('@frontendWebroot/image/').$actionImage->image->path.$actionImage->image->name,['alt'=>'акции','style'=>'max-width:100%;']); ?>
                    </div>
                <?php } ?>
                <div class="col-lg-24 col-md-24 col-sm-24 col-xs-24 lines">
                    <?= ListView::widget([
                        'dataProvider'  => $productsDataProvider,
                        'itemView'      => '_gods',
                        'viewParams'    => [
                            'category'  =>  $category
                        ],
                        'summary' => 'Показано {count} из {totalCount}',
                        'pager' => [
                            'firstPageLabel' => 'Первая',
                            'lastPageLabel' => 'Последняя',
                            'prevPageLabel' => '<span class="fa fa-angle-left"></span>',
                            'nextPageLabel' => '<span class="fa fa-angle-right"></span>',
                        ],
                    ]) ?>
                </div>
                <div class="col-lg-24 col-md-24 col-sm-24 col-xs-24 description">
                    <h1><?= $category->name.' в интернет магазине "Милый дом"' ?></h1>
                    <p><?= $category->description_category ?></p>
                </div>
            </div>
        </div>
    </div>
</section>