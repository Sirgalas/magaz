<?php
use yii\widgets\ListView;
use frontend\widget\seo\Seo;

$this->params['breadcrumbs'][] =$category->name;
?>
<?=Seo::widget(['addfeilds'=>$category->addfeilds,'model'=>$category,'category'=>true,'description'=>'description_category']);?>

<section class="container-fluid">
    <div class="row">
        <div class="col-lg-offset-4 col-md-offset-0 col-lg-16 col-md-24 col-sm-24 col-xs-24 blog">
            <?= ListView::widget([
                'dataProvider'  => $postDataProvider,
                'itemView'      => '_post',
                'summary' => 'Показано {count} из {totalCount}',
            ]) ?>
        </div>
    </div>
</section>