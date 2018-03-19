<?php
if(!empty($addFields)){
    $titles=array_filter($addFields,function ($item){
        return $item->key_feild == 'title';
    });
    $descriptions=array_filter($addFields,function ($item){
        return $item->key_feild == 'description';
    });
    $keys= array_filter($addFields,function($item){
        return $item->key_feild == 'keywords';
    });
}
if(empty($titles)){
    if(isset($templates)){
        $title=str_replace('%title%',$model->$title,$templates);
    } else {
        $title= $model->$title;
    }

}else{
    $title=array_shift($titles)->value;
}
$this->title=$title;
if(isset($models->quote)){
    $quote=$models->quote;
}elseif (!empty($descriptions)){
    $quote=array_shift($descriptions)->value;
}
else{
    $descriptions = strip_tags($model->$description);
    $descArr=array("&nbsp;",'&quot;');
    $descriptions = str_replace($descArr,' ',$descriptions);
    $descriptions = substr($descriptions, 0, 500);
    $descriptions = substr($descriptions, 0, strrpos($descriptions, ' '));
    $quote=$descriptions;
}
$this->registerMetaTag(['description' =>$quote]);
if(isset($keys)) {
    $keywords='';
    foreach ($keys as $key) {
        $keywords .= $key->value;
    }
    $this->registerMetaTag(['keywords'=>$keywords]);
}
