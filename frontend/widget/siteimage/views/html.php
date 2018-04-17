<?php
use yii\helpers\Html;
echo Html::img(Yii::getAlias('@frontendWebroot').'/image/'.$image->path.''.$image->name);