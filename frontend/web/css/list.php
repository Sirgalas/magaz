<?php
use yii\widgets\ListView;

$this->params['breadcrumbs'][] = 'Купить вещи '.$category->name.' в магазине "Милый дом"';
$this->title = 'купить '.$category->name.' в интернет магазине "Милый дом"';
if(isset($category->quote)){
$this->registerMetaTag([
    'name' => 'description',
    'content' => $category->quote
]);}
?>
<section class="container-fluid">
    <div class="row">
        <div class="col-lg-offset-2 col-md-offset-0 col-lg-20 col-md-24 col-sm-24 col-xs-24">
            <aside class="col-lg-5 col-md-5 col-sm-3 col-xs-4 nomobile">
                <a href="#" class="drop"><span class="fa fa-caret-down"></span> Скрыть фильтры </a>
                <form class="filters" action="#">
                    <div class="block">
                        <h4>Пол</h4>
                        <p><input type="checkbox" class="checkbox" name="sex" value="0">Он</p>
                        <p><input type="checkbox" class="checkbox" name="sex" value="1">Она</p>
                    </div>
                    <div class="block scroll">
                        <h4>Одежда</h4>
                        <p><input type="checkbox" class="checkbox" name="clothes" value="0">блузки и рубашки</p>
                        <p><input type="checkbox" class="checkbox" name="clothes" value="1">брюки и леггинсы</p>
                        <p><input type="checkbox" class="checkbox" name="clothes" value="2">джинсы</p>
                        <p><input type="checkbox" class="checkbox" name="clothes" value="3">комбинезоны</p>
                        <p><input type="checkbox" class="checkbox" name="clothes" value="4">кофты</p>
                        <p><input type="checkbox" class="checkbox" name="clothes" value="5">нижнее бельё</p>
                        <p><input type="checkbox" class="checkbox" name="clothes" value="6">платья туники</p>
                        <p><input type="checkbox" class="checkbox" name="clothes" value="0">блузки и рубашки</p>
                        <p><input type="checkbox" class="checkbox" name="clothes" value="1">брюки и леггинсы</p>
                        <p><input type="checkbox" class="checkbox" name="clothes" value="2">джинсы</p>
                        <p><input type="checkbox" class="checkbox" name="clothes" value="3">комбинезоны</p>
                        <p><input type="checkbox" class="checkbox" name="clothes" value="4">кофты</p>
                        <p><input type="checkbox" class="checkbox" name="clothes" value="5">нижнее бельё</p>
                        <p><input type="checkbox" class="checkbox" name="clothes" value="6">платья туники</p>
                    </div>
                    <div class="block scroll">
                        <h4>Размер</h4>
                        <p><input type="checkbox" class="checkbox" name="size" value="xxs">xxs</p>
                        <p><input type="checkbox" class="checkbox" name="size" value="xs">xs</p>
                        <p><input type="checkbox" class="checkbox" name="size" value="s">s</p>
                        <p><input type="checkbox" class="checkbox" name="size" value="m">m</p>
                        <p><input type="checkbox" class="checkbox" name="size" value="ml">m/l</p>
                        <p><input type="checkbox" class="checkbox" name="size" value="l">l</p>
                        <p><input type="checkbox" class="checkbox" name="size" value="xl">xl</p>
                        <p><input type="checkbox" class="checkbox" name="size" value="xxs">xxs</p>
                        <p><input type="checkbox" class="checkbox" name="size" value="xs">xs</p>
                        <p><input type="checkbox" class="checkbox" name="size" value="s">s</p>
                        <p><input type="checkbox" class="checkbox" name="size" value="m">m</p>
                        <p><input type="checkbox" class="checkbox" name="size" value="ml">m/l</p>
                        <p><input type="checkbox" class="checkbox" name="size" value="l">l</p>
                        <p><input type="checkbox" class="checkbox" name="size" value="xl">xl</p>
                    </div>
                    <div class="block scroll">
                        <h4>Цвет</h4>
                        <p><input type="checkbox" name="color" value="red" class="red checkbox">Красный</p>
                        <p><input type="checkbox" name="color" value="white" class="white checkbox">Белый</p>
                        <p><input type="checkbox" name="color" value="black" class="black checkbox">Черный</p>
                        <p><input type="checkbox" name="color" value="black" class="black checkbox">Оранжевый</p>
                        <p><input type="checkbox" name="color" value="green" class="green checkbox">Зеленный</p>
                        <p><input type="checkbox" name="color" value="green" class="green checkbox">Голубой</p>
                        <p><input type="checkbox" name="color" value="yellow" class="yellow checkbox">Желтый</p>

                    </div>
                    <div class="block sezon">
                        <h4>Цвет</h4>
                        <div class="group">
                            <p><input type="checkbox" class="checkbox" name="sezon" value="winter">Зима</p>
                            <p><input type="checkbox" class="checkbox" name="sezon" value="spring">Весна</p>
                            <p><input type="checkbox" class="checkbox" name="sezon" value="summer">Лето</p>
                            <p><input type="checkbox" class="checkbox" name="sezon" value="autumn">Осень</p>
                        </div>
                    </div>
                    <div class="block sezon">
                        <h4>Цена</h4>
                        <div id="slider-range"></div>
                        <p>
                            <input type="text" id="amountmin" class="rangerinput">
                            <input type="text" id="amountmax" class="rangerinput">
                        </p>


                    </div>
                    <button class="button">Искать</button>
                </form>
            </aside>
            <div class="col-lg-19 col-md-19 col-sm-18 col-xs-16">
                <div class="col-lg-24 col-md-24 col-sm-24 col-xs-24 lines">
                    <?= ListView::widget([
                        'dataProvider'  => $productsDataProvider,
                        'itemView'      => '_gods',
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