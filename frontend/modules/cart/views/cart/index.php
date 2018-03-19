<?php
use yii\helpers\Html;
use yii\widgets\ActiveForm;
use yii\helpers\Url;
?>
<section class="container-fluid">
    <div class="row">
        <div class="col-lg-offset-4 col-md-offset-0 col-lg-16 col-md-24 col-sm-24 col-xs-24 carttab">
            <div class="col-lg-24 col-md-24 col-sm-24 col-xs-24">
                <div class="col-lg-24 col-md-24 col-sm-24 col-xs-24">
                    <table class="table table-striped">
                        <thead>
                        <tr>
                            <th><?= Yii::t('frontend','FOTO') ?></th>
                            <th><?= Yii::t('frontend','NAME')?></th>
                            <th><?= Yii::t('frontend','QUANTITY')?></th>
                            <th><?=Yii::t('frontend','PRISE'); ?></th>
                            <th><?= Yii::t('frontend','COLOR')?></th>
                            <th><?= Yii::t('frontend','SIZE') ?></th>
                            <th><?= Yii::t('frontend','LINK') ?></th>
                        </tr>
                        </thead>
                        <tbody class='yesterday'>
                        <?php
                        if (!empty($sesGoods)) {
                            $bascet='';
                            $counter=0;
                            foreach ($sesGoods as $sGoods) {
                                $prise=$order->wathPrice($sGoods->prises,$sGoods->sizes->key_feild,$sGoods->gods);
                                ?>
                            <tr>
                                <td>
                                    <?php $img  = array_filter($sGoods->gods->images, function($item) {
                                        return $item->forHome == 1;
                                    });
                                    if(isset($img)){
                                        foreach($img as $image){
                                            echo Html::img(Yii::getAlias('@frontendWebroot/image/') . $image->path . 'avatar-' . $image->name, ['alt' => $sGoods->gods->title,'width'=>50]);}
                                    }
                                    ?>
                                <td><p class="id" data-id="<?=$sGoods->id ?>"><?= Html::a($sGoods->gods->title,Url::to(['/gods/gods/onegods','slug'=>$sGoods->gods->slug_gods])); ?></p></td>
                                <td><p><a href="#" class="plus"><span class="fa fa-plus"></span></a><input type="text" class="quantity" value="<?= $sGoods->quantity ?>"> <a href="#" class="minus"><span class="fa fa-minus"></span></a></p></td>
                                <td><p class="prise" data-prise="<?= $prise ?>"><?= $prise ; ?> грн.</p></td>
                                <td><p>
                                        <?php
                                        if(is_object($sGoods->colors))
                                            echo "<span class='fa fa-square' style='color:".$sGoods->colors->value."'></span>";
                                        else
                                            echo"Цвет не выбран";
                                        ?>
                                    </p></td>
                                <td><p>
                                        <?php
                                        if(is_object($sGoods->sizes)){
                                            echo $sGoods->sizes->value;
                                        }else{
                                            echo"Размер не выбран";
                                        }
                                        ?>
                                    </p></td>
                                <td><p><a href="#" class="del" ><span class="fa fa-times"></span></a></p></td>
                            </tr>
                            <?php }
                        }else{
                            echo "<tr><td colspan='7'>на сегодня заказов нет </td></tr>";
                            } ?>
                        </tbody>
                    </table>
                    <?php $form=ActiveForm::begin();
                    ?>

                    <?php if(isset($bascet)){
                        echo Html::hiddenInput('id',$bascet,['id'=>'orders-bascet_id']);

                    }else{
                        echo Html::hiddenInput('id','',['id'=>'orders-bascet_id']);

                    } ?>
                    <p class="finaliprice col-lg-offset-20 col-md-offset-20 col-sm-offset-16 col-xs-offset-16 col-lg-4 col-md-4 col-sm-8 col-xs-8" ><strong>Итого :</strong> <span id="finality"></span> грн.</p>
                    <button class="button col-lg-offset-20 col-md-offset-20 col-sm-offset-16 col-xs-offset-16 col-lg-4 col-md-4 col-sm-8 col-xs-8">Заказать</button>
                    <?php
                    $this->registerJs('jQuery("button.button").on("click", function() {var itemsCounter = jQuery("#itemsCounter");itemsCounter.text(parseInt(itemsCounter.text()) + 1);});');
                    ActiveForm::end(); ?>
                    <table  class="table table-striped">
                        <?php
                        if (!empty($userGoods)) {
                            echo "<thead><tr><th colspan='7'>товары выбраные но не заказаные ранее </th></tr></thead>";
                            echo "<tbody>";
                            foreach ($userGoods as $uGoods) {
                                $prise='';
                                if(!isset($uGoods->sizes)||$uGoods->sizes->key_feild=='size1'||$uGoods->sizes->id==7){
                                    $prise= $uGoods->prises->price1;
                                }elseif($uGoods->sizes->key_feild=='size2'){
                                    $prise= $uGoods->prises->price2;
                                }elseif($uGoods->sizes->key_feild=='size3'){
                                    $prise= $uGoods->prises->priceEvro;
                                }elseif($uGoods->sizes->key_feild=='size4'){
                                    $prise= $uGoods->prises->priceSem;
                                }elseif($uGoods->sizes->key_feild=='size5'){
                                    $prise= $uGoods->prises->wholesale;
                                }elseif($uGoods->sizes->key_feild=='size6'){
                                    $prise= $uGoods->prises->addtional;
                                }
                                ?>
                                <tr>
                                    <td>
                                        <?php $img  = array_filter($uGoods->gods->images, function($item) {
                                            return $item->forHome == 1;
                                        });
                                        if(isset($img)){
                                            foreach($img as $image){
                                                echo Html::img(Yii::getAlias('@frontendWebroot/image/') . $image->path . 'gods-' . $image->name, ['alt' => $uGoods->gods->title,'width'=>50]);}
                                            }
                                        ?>
                                    <td id="id"><p class="id" data-id="<?=$uGoods->id ?>"><?= $uGoods->gods->title ?></p></td>
                                    <td><p><a href="#" class="plus"><span class="fa fa-plus"></span></a> <input type="text" class="quantity" value="<?= $uGoods->quantity ?>"><a href="#" class="minus"><span class="fa fa-minus"></span></a></p></td>
                                    <td><p class="prise" data-prise="<?= $prise ?>"><?= $prise ?> грн.</p></td>
                                    <td><p>
                                            <?php
                                                if(is_object($uGoods->colors))
                                                    echo "<span class='fa fa-square' style='color:".$uGoods->colors->value."'></span>";
                                                else
                                                    echo"Цвет не выбран";
                                            ?>
                                        </p></td>
                                    <td><p>
                                            <?php
                                            if(isset($uGoods->sizes)||$uGoods->sizes->value!=0){
                                                echo $uGoods->sizes->value;
                                            }else{
                                                echo"Размер не выбран";
                                            }
                                            ?>

                                        </p></td>
                                    <td class="replase" ><?= Yii::t('frontend','DATECUSTOMER') ?> <?= date('d.m.Y',$uGoods->datetime )?> <a href="#" class="addorder" ><?= Yii::t('frontend','THECUSTOMER') ?></a></td>
                                    <td id="delete" > <a href="#" class="delete" ><span class="fa fa-times fa-2"></span></a></td>
                                </tr>
                            <?php }
                        } ?>
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
</section>
