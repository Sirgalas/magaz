<?php
use kartik\rating\StarRating;

echo StarRating::widget([
    'name' => 'rating_21',
    'value' => $value,
    'pluginOptions' => [
        'readonly' => true,
        'showClear' => false,
        'showCaption' => false,
        'theme' => 'krajee-fa',
        'filledStar' => '<span class="fa fa-star"></span>',
        'emptyStar' => '<span class="fa fa-star-o"></span>'
    ],
]);