<?php
use yii\helpers\Html;
use frontend\widget\comments\Comments;
use frontend\widget\seo\Seo;

$this->params['breadcrumbs'][] =['label' => Yii::t('frontend','NEWS'), 'url' => '/post/post/category'];
$this->params['breadcrumbs'][] = $model->title;

?>
<?=Seo::widget(['addfeilds'=>$model->addfeilds,'model'=>$model,'category'=>false,'description'=>'description_post']);?>
<section class="container-fluid onegods">
    <div class="row">
        <h1 class="col-lg-16 col-md-16 col-sm-20 col-xs-20 col-lg-offset-4 col-mg-offset-4 col-sm-offset-2 col-xs-offset-2"><?= $model->title ?></h1>
        <div class="col-lg-16 col-md-16 col-sm-20 col-xs-20 col-lg-offset-4 col-mg-offset-4 col-sm-offset-2 col-xs-offset-2">
           <?php $img = array_filter($model->images, function($item) {
                return $item->forHome == 1;
            });
            if(isset($img)){
                foreach($img as $image){
                    echo Html::img(Yii::getAlias('@frontendWebroot/image/') . $image->path . 'news-' . $image->name, ['alt' => $model->title,'class'=>'left']);}
            }
            ?>
            <?= $model->description_post; ?>
        </div>
    </div>
</section>
<?= Comments::widget(['postId'=>$model->id]);?>
