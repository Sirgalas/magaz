<?php
if(Yii::$app->user->identity&&isset(Yii::$app->user->identity->discount)){
    if(Yii::$app->user->identity->percent==1){
        $prise=$price - ($price*(Yii::$app->user->identity->discount/100));
    }else{
        $prise=$price - Yii::$app->user->identity->discount;
    }
}else{
    $prise=$price;
}

if($action){ ?>
    <span class="old  col-ld-12 col-md-12 col-sm-12 col-xs-12"><span class="prises"><?= round($prise, 0, PHP_ROUND_HALF_UP) ?> грн.</span> <br/>
        <span class="none-line"> Скидка <?= ($percent)?round($percent,0).'%':''; ?></span>
    </span>
    <span class="new  col-ld-12 col-md-12 col-sm-12 col-xs-12"><?= $action ?> грн.
    
    </span>
<?php } else { ?>
    <span class="new  col-ld-12 col-md-12 col-sm-12 col-xs-12"><span id="prises"><?= round($prise, 0, PHP_ROUND_HALF_UP) ?></span> грн.</span>
<?php } ?>