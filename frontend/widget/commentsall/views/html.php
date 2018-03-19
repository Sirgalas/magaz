<?php
use yii\widgets\Pjax;
use yii\helpers\Html;
use frontend\widget\stars\Stars; ?>
<section class="container-fluid bottom">
    <div class="row">
        <div class="col-lg-offset-4 col-md-offset-0 col-lg-16 col-md-24 col-sm-24 col-xs-24">
            <div class="col-lg-24 col-md-24 col-sm-24 col-xs-24 message">
                <?php if (Yii::$app->user->isGuest) { ?>
                    <?= Yii::t('frontend','NOT_COMMENT'); ?>
                <?php }else{ ?>
                    <p class="col-lg-12 col-md-12 col-sm-12 col-xs-24"><?= Yii::t('frontend','REWIESGODS') ?></p>
                    <?= $this->render('_form',[
                        'commentmodel'=>$commentmodel
                    ]) ?>
                <?php } ?>
            </div>
        </div>
    </div>
</section>
<?php Pjax::begin(['id' => 'reloded']) ?>
<section class="container-fluid comentUser">
    <div class="row">
        <div class="col-lg-offset-4 col-md-offset-0 col-lg-16 col-md-24 col-sm-24 col-xs-24">
            <div class="col-lg-24 col-md-24 col-sm-24 col-xs-24 coments">
                <?php foreach ($comments as $comment){ ?>
                    <div class="col-lg-24 col-md-24 col-sm-24 col-xs-24 comment">
                        <div class="avatar col-lg-4 col-md-4 col-sm-6 col-xs-12">
                            <?php if(isset($comment->user->avatar)){ ?>
                                <?= Html::img(Yii::getAlias('@frontendWebroot').'/image/'.$comment->user->avatar,['class'=>'col-lg-24 col-md-24 col-sm-24 col-xs-24','alt'=>$comment->user->username.'-avatar','width'=>'105']); ?>
                            <?php }else{ ?>
                                <?= Html::img(Yii::getAlias('@frontendWebroot').'/image/frontendImage/noavatar.jpeg',['class'=>'col-lg-24 col-md-24 col-sm-24 col-xs-24','alt'=>$comment->user->username.'-noavatar','width'=>'105']); ?>
                            <?php } ?>
                            <h3 class="userNane col-lg-24 col-md-24 col-sm-24 col-xs-24"><?= $comment->user->username; ?></h3>
                        </div>
                        <div class="desccomment col-lg-20 col-md-20 col-sm-18 col-xs-12">
                            <p class="description"><?= $comment->text ?></p>
                            <p class="col-lg-12 col-md-12 col-sm-12 col-xs-24 date"><?= date('d.m.Y',$comment->created_at); ?></p>
                        </div>
                    </div>
                <?php } ?>
            </div>
        </div>
    </div>
</section>
<?php Pjax::end();?>
<?php
$this->registerJs(
    '$("document").ready(function(){
        $("#new_relode").on("pjax:end", function() {
            $.pjax.reload({container:"#reloded"});  //Reload GridView
        });
    });');
?>
