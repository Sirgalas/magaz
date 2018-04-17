<?php
use yii\widgets\ActiveForm;
use yii\widgets\Pjax;
use yii\helpers\Html;
use kartik\checkbox\CheckboxX;

 Pjax::begin(['id' => 'cart']); ?>

  <?php  $form = ActiveForm::begin(['options' => ['data-pjax' => true]]);
  ?>
  <?php if($models->categorys->id==41){ ?>

    <div class="form-group">
        <label class="cbx-label" for="kv-adv-8">
            <?= CheckboxX::widget([
                'name' => 'Basket[elastic]',
                'initInputType' => CheckboxX::INPUT_CHECKBOX,
                'options'=>['id'=>'kv-adv-8'],
                'pluginOptions' => [
                    'threeState'=>false,
                    'theme' => 'krajee-flatblue',
                    'enclosedLabel' => true
                ],
                'pluginEvents' => [
                    'change'=>'function(e) { 
                      if(e.currentTarget.value==1){
                          var price=$("form .field-basket-price #basket-price").val();
                          var summ=parseInt(price)+60;
                          $("form .field-basket-price #basket-price").val(summ);
                      } 
                      if(e.currentTarget.value==0){
                         var price=$("form .field-basket-price #basket-price").val();
                          var summ=parseInt(price)-60;
                          $("form .field-basket-price #basket-price").val(summ);
                          
                      } 
                  }',]
            ]); ?>
            <?= Yii::t('frontend','AN_ELASTIC'); ?>
        </label>
    </div>
<?php }?>
    <?php if(isset(Yii::$app->user->id)){?>
    <?= $form->field($model,'user_id')->hiddenInput(['value'=> Yii::$app->user->id])->label(false); ?>
<?php }else{}?>
    <?= $form->field($model,'goodsid')->hiddenInput(['value'=>$godsId])->label(false); ?>
    <?= $form->field($model,'quantity')->hiddenInput(['value'=>1])->label(false); ?>
    <?= $form->field($model,'size')->hiddenInput(['value'=>0])->label(false); ?>
    <?= $form->field($model,'color')->hiddenInput(['value'=>0])->label(false); ?>
    <?= $form->field($model,'price')->hiddenInput(['value'=>$prise])->label(false); ?>
    <?= $form->field($model,'datetime')->hiddenInput(['value'=>time()])->label(false); ?>
    <?= Html::submitButton('В корзину',[ 'class'=>"sels"]); ?>
<?php ActiveForm::end(); ?>
<?php Pjax::end();