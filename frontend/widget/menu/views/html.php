<?php

use yii\helpers\Html;

if($location=='header'){
    $session = Yii::$app->session;
    $theSID=$session->get('id');
    if(!isset($theSID)){
        $hash = Yii::$app->getSecurity()->generatePasswordHash(time().''.Yii::$app->request->userIP);
        $session->set('id',$hash);
    }
?>
    <nav class="navbar navbar-default" role="navigation">
        <div class="container-fluid">
            <div class="navbar-header">
                <button type="button" class="navbar-toggle" data-toggle="collapse" data-target="#bs-example-navbar-collapse-<?=$numberCollaps; ?>"><span class="sr-only">Toggle navigation</span>
                    <span class="icon-bar"></span>
                    <span class="icon-bar"></span>
                    <span class="icon-bar"></span>
                </button>
            </div>
            <div class="collapse navbar-collapse" id="bs-example-navbar-collapse-<?=$numberCollaps; ?>">
                <ul class="nav navbar-nav">
                    <?= $category; ?>
                </ul>
            </div>
        </div>
    </nav>
<?php }
if($location=='footer'){ ?>
		<ul>
            <?= $category ?>
		</ul>
<?php } ?>