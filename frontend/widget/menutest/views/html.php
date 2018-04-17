<?php

use yii\helpers\Html;?>

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
                    <?= $model; ?>
                </ul>
            </div>
        </div>
</nav>