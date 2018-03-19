<?php
use yii\helpers\Html;
?>


<div class="container-fluid slider nomobile">
			<div class="row">
				<div class="col-lg-1 col-md-1 col-lg-offset-2 col-md-offset-0">
					<a href="#" class="prev"><span class="fa fa-angle-left fa-5x"></span></a>
				</div>
				<div class="col-lg-18 col-md-22 no-mobile owlslider  owl-carousel owl-theme">
                    <?php foreach ($slider as $elms) {?>
						<?php $elm=json_decode($elms->vaelye);
							$bacgroundSlider=isset($elm->background->path)?'style="background:url(\''.$elm->background->path.'\'"':'';
						echo '<div class="item"'.$bacgroundSlider.' >';
							foreach ($elm as $el){
								if(isset($el->name)){
									if($el->name=='text'){
									echo "<p>$el->text</p>";
									}
									if($el->name=='left'){
										echo Html::img($el->path,['class'=>'one']);
									}
									if($el->name=='center'){
										echo Html::img($el->path,['class'=>'two']);
									}
									if ($el->name=='right'){
										echo Html::img($el->path,['class'=>'three']);
									}
								}
							}
						echo '</div>';
                    } ?>
				</div>
				<div class="col-lg-1 col-md-1"><a href="#" class="next"><span class="fa fa-angle-right fa-5x"></span></a></div>
			</div>
		</div>