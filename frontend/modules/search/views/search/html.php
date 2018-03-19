<?php
use yii\widgets\ListView;
use frontend\widget\searchform\Searchform;
$this->params['breadcrumbs'][] = 'поиск по запросу '.$breadcrumbs.' в магазине "Милый дом"'; ?>
<section class="container-fluid">
    <div class="row">
        <div class="col-lg-offset-2 col-md-offset-0 col-lg-20 col-md-24 col-sm-24 col-xs-24">
            <aside class="col-lg-5 col-md-5 col-sm-3 col-xs-4">
                <a href="#" class="drop"><span class="fa fa-caret-down"></span> Скрыть фильтры </a>
                <?= Searchform::widget(['category'=>$category]); ?>
            </aside>
            <div class="col-lg-19 col-md-19 col-sm-18 col-xs-16">
                <div class="col-lg-24 col-md-24 col-sm-24 col-xs-24 lines">
                    <?= ListView::widget([
                        'dataProvider'  => $filterDataProvider,
                        'itemView'      => '_goods',
                        'emptyText' => 'Ничего не найдено.',
                        'summary' => 'Показано {count} из {totalCount}',
                        'pager' => [
                            'firstPageLabel' => 'Первая',
                            'lastPageLabel' => 'Последняя',
                            'prevPageLabel' => '<span class="fa fa-angle-left"></span>',
                            'nextPageLabel' => '<span class="fa fa-angle-right"></span>',
                        ],
                    ]) ?>
                </div>
            </div>
        </div>
    </div>
</section>
