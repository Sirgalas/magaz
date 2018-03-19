<?php
if(is_object($category)){
    if($category->size=='Одежда'){
        $sizesСlothes=array_filter($models->addfeilds,function($item){
            return $item->key_feild=='size1';
        });
        echo $this->render('category/_clothes',[
            'sizesСlothes'=>$sizesСlothes
        ]);

    }
    if($category->size=='Постельное'){
        echo $this->render('category/_beding',[
            'models'=>$models
        ]);
    }
    if($category->size=='Полуторное'){
        echo $this->render('category/_other',[
            'models'=>$models,
            'name'=>$category->name
        ]);
    }
}
?>