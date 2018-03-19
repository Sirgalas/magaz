<?php

use yii\helpers\Html;
use yii\helpers\Url;
?>
<div id="dialog" title="Спасибо за покупку">
    <span class="fa fa-times fa-4 close" id="close"></span>
  <p>
      Товар добавлен в корзину.</br/>
      <?= Html::a('Продолжить покупки',Url::to(Yii::$app->homeUrl)); ?><br/>
      <?= Html::a('Оформить заказ',Url::to('/cart/cart/index'));?>
  </p>
</div>
<?php

echo $this->render('_form',[
    'models'=>$models,
    'model'=>$model,
    'godsId'=>$godsId,
    'prise'=>$prise,
]);

$this->registerJs(
'$("document").ready(function(){
    $.fx.speeds._default = 1000;
    $( "#dialog" ).dialog({
        modal:true,
        autoOpen: false,
        show: "blind",
        hide: "explode",

    });
    $("#close").click(function(){
    $( "#dialog" ).dialog( "close" );
    })
    $("#cart").on("pjax:end", function() {
        var qunt= $("#someCart a span").html();
        var summ= parseInt(qunt)+1;
        $("#someCart a span").html(summ);
        $( "#dialog" ).dialog( "open" );
    });
});');
?>
