<?php
use yii\widgets\ListView;
use frontend\widget\searchform\Searchform;
if(isset($category->parentcat)){
    $this->params['breadcrumbs'][] = ['label' => $category->parentcat->name, 'url' =>['/gods/gods/category','slug'=>$category->parentcat->slug_category] ];
}
$this->params['breadcrumbs'][] = $category->name;
$addFields=$category->addfeilds;
$titles=array_filter($addFields,function ($item){
    return $item->key_feild == 'title';
});
if(isset($title)){
    foreach ($titles as $title)
    $this->title = $title->value;
}else{
    $this->title = 'купить '.$category->name.' в интернет магазине "Милый дом"';
}
$descriptions=array_filter($addFields,function ($item){
    return $item->key_feild == 'description';
});
$quote='';
if(isset($category->quote)){
    $quote=$category->quote;
}elseif (!empty($descriptions)){
    foreach ($descriptions as $description){
        $quote=$description->value;
    }
}
else{

    $descriptions = strip_tags($category->description_category);
    $descriptions = str_replace("&nbsp;",' ',$descriptions);
    $descriptions = substr($descriptions, 0, 250);
    $descriptions = substr($descriptions, 0, strrpos($descriptions, ' '));
    $quote=$descriptions;
}
$this->registerMetaTag(['description' =>$quote]);
if(isset($addfeilds)){
    $keys= array_filter($addfeilds,function($item){
        return $item->key_feild == 'keywords';
    });
    if(isset($keys)) {
        $keywords='';
        foreach ($keys as $key) {
            $keywords += $key->value;
        }
        $this->registerMetaTag(['keywords'=>$keywords]);
    }
}

?>
<section class="container-fluid">
    <div class="row">
        <div class="col-lg-offset-2 col-md-offset-0 col-lg-20 col-md-24 col-sm-24 col-xs-24">
            <aside class="col-lg-5 col-md-5 col-sm-3 col-xs-4 nomobile">
                <a href="#" class="drop"><span class="fa fa-caret-down"></span> Скрыть фильтры </a>
                <?= Searchform::widget(['category'=>$category])?>
            </aside>
            <div class="col-lg-19 col-md-19 col-sm-24 col-xs-24">
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