<?php

use yii\helpers\Html;
use kartik\grid\GridView;
use yii\helpers\Url;

/* @var $this yii\web\View */
/* @var $searchModel backend\models\AddlfeildSearch */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = Yii::t('backend','ADDFEILDS');
$this->params['breadcrumbs'][] = $this->title;
if($class=="id_gods") {
    $gridColums=[
        [
            'class'=>'kartik\grid\EditableColumn',
            'attribute'=>'key_feild',
            'value'    => function($model){
                return $model->canViewsKeyFeild($model);
            },
            'editableOptions'=> function ($model, $key, $index) {
                return [
                    'header'=>Yii::t('backend','KEY_FEILD'),
                    'size'=>'md',
                    'inputType'=>\kartik\editable\Editable::INPUT_DROPDOWN_LIST,
                    'data'=>['article' => 'Артикул','site'=>'сайт поставщика','size1'=>'Размер','size2'=>'двойной размер','size3'=>'евро размер','size4'=>'семейный размер','size5'=>'первый дополнительный размер','size6'=>'второй дополнительный размер','color'=>'Цвет','code_provider'=>'код поставщика','link_site'=>'ссылка на сайт','name_provider'=>'Имя поставщика','contact_provider'=>'контакты поставщика','keywords'=>'keywords','delivery'=>'Доставка','country'=>'Страна производитель','composition'=>'Состав','winter'=>'Зима','spring'=>'Весна','summer'=>'Лето','fall'=>'Осень'],
                ];
            }
        ],
        [
            'class'=>'kartik\grid\EditableColumn',
            'attribute'=>'value',
            'value'    => function($model){
                return $model->canViewsValue($model);
            },
            'editableOptions'=> function ($model, $key, $index) {
                return [
                    'header'=>Yii::t('backend','VALUE'),
                    'size'=>'md',
                    'inputType'=>\kartik\editable\Editable::INPUT_TEXT,
                ];
            }
        ],
        ['class' => 'yii\grid\ActionColumn'],
    ];
}else{
    $gridColums=[
        [
            'class'=>'kartik\grid\EditableColumn',
            'attribute'=>'key_feild',
            'value'    => function($model){
                return $model->canViewsKeyFeild($model);
            },
            'editableOptions'=> function ($model, $key, $index) {
                return [
                    'header'=>Yii::t('backend','KEY_FEILD'),
                    'size'=>'md',
                    'inputType'=>\kartik\editable\Editable::INPUT_TEXT,
                ];
            }
        ],
        [
            'class'=>'kartik\grid\EditableColumn',
            'attribute'=>'value',
            'value'    => function($model){
                return $model->canViewsValue($model);
            },
            'editableOptions'=> function ($model, $key, $index) {
                return [
                    'header'=>Yii::t('backend','VALUE'),
                    'size'=>'md',
                    'inputType'=>\kartik\editable\Editable::INPUT_TEXT,
                ];
            }
        ],
        ['class' => 'yii\grid\ActionColumn'],
    ];
}
?>
<div class="addlfeild-index">

    <h1><?= Html::encode($this->title) ?></h1>
    <h2><?php if($cat){ ?>
            <h2><?=Html::a($goods->name,Url::to(['/gods/index','GodsSearch[title]'=>$goods->name])); ?></h2>
        <?php } else { ?>
            <h2><?=Html::a($goods->title,Url::to(['/gods/index','GodsSearch[title]'=>$goods->title])); ?></h2>
        <?php } ?>
    </h2>

    <p>
        <?= Html::a(Yii::t('backend','CREATEFEILDS'), Url::to(['/addlfeild/create','id'=>$id,'feild'=>$class]), ['class' => 'btn btn-success']) ?>
        <?php if($class=="id_gods") { ?>
            <?= Html::a(Yii::t('backend','CREATEFEILDSREQARE'), Url::to(['/addlfeild/required','id'=>$id,'feild'=>$class]), ['class' => 'btn btn-success']) ?>
            <?= Html::a(Yii::t('backend','CREATEOUTHER'), Url::to(['/addlfeild/outher','id'=>$id,'feild'=>$class]), ['class' => 'btn btn-success']) ?>
        <?php } ?>
    </p>
    <?= GridView::widget([
        'dataProvider' => $dataProvider,
        'filterModel' => $searchModel,
        'columns' => $gridColums
    ]); ?>
</div>
