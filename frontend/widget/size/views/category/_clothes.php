<?php
$forCount=1;
$oneClothes="";
foreach ($sizesСlothes as $sizeСlothes){
    if($forCount==count($sizesСlothes))
        $oneClothes.=$sizeСlothes->value;
    else
        $oneClothes.="$sizeСlothes->value, ";
    $forCount++;
}
echo Yii::t('backend','SIZE').' '.$oneClothes; ?>