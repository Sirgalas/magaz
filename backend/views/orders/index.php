<?php

use yii\helpers\Html;
use kartik\grid\GridView;

/* @var $this yii\web\View */
/* @var $searchModel backend\models\OrdersSearch */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = Yii::t('backend','ORDERS');
$this->params['breadcrumbs'][] = $this->title;
//$this->params['body-class'] = ' goods';
?>
<div class="orders-index">

    <h1><?= Html::encode($this->title) ?></h1>
    <?php // echo $this->render('_search', ['model' => $searchModel]); ?>

    <?= GridView::widget([
        'dataProvider' => $dataProvider,
        'filterModel' => $searchModel,
        'columns' => [
            ['class' => 'yii\grid\SerialColumn'],
            ['class' => 'yii\grid\ActionColumn'],

            [
                'attribute'=>'id',
                'format'=>'raw',
                'label'=>  Yii::t('backend','dataGoods'),
                'value'=> function($model,$key){
                    return $model->getFullRowOrder($key);
                }
            ],
            [
                'attribute'   =>   'article',
                'format'      =>    'raw',
                'header'      =>    Yii::t('backend','ARTICLE'),
                'value'       =>    function($model){
                    return $model->theGetValue($model->id,'article');},
                'filterType'=>GridView::FILTER_SELECT2,
                'filter'=> $articleDatas,
                'filterWidgetOptions'=>[
                    'pluginOptions'=>['allowClear'=>true],
                ],
                'filterInputOptions'=>['placeholder'=>Yii::t('backend','SELECT_ARTICLE')]
            ],
            [
                'attribute'=>'user_id',
                'format'=>'raw',
                'label'=>  Yii::t('backend','USERREGISTER'),
                'value'=> function($model,$key){
                    return $model->getUser($model->user_id);
                }
            ],
            [
                'attribute'=>'anonim_id',
                'format'=>'raw',
                'label'=>  Yii::t('backend','USERNOTREGISTER'),
                'value'=> function($model,$key){
                    return $model->getAnonimUser($model->anonim_id);
                }
            ],
            [
                'attribute'=>'received_sell',
                'format'=>'raw',
                'label'=>  Yii::t('backend','DATAORDERS'),
                'value'=> function($model,$key){
                    return $model->getReceivedSell($model->received_sell);
                },
                'filterType'=>GridView::FILTER_SELECT2,
                'filter'=> ['0'=>'Новый заказ','1'=>'Принятый','2'=>'Выполненый','3'=>'Отказ','4'=>'Отменен','5'=>'Показать все'],
                'filterInputOptions'=>['placeholder'=>Yii::t('backend','SELECT_received_sell')]
            ],
            [
                'attribute'  =>  'admin_id',
                'format'    =>  'raw',
                'label'     =>  Yii::t('backend','USERORDERS'),
                'value'     =>  function($model){
                    return $model->getAdmin($model->admin_id);
                }

            ],
            [
                'attribute'  => 'comment',
                'label'     =>  Yii::t('backend','Comment'),
            ],
            
            'datetime:datetime',
        ],
    ]); ?>
</div>
