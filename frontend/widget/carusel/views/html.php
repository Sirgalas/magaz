<?php
?>
<div class="container-fluid carusels" id="direction-waypoint">
    <div class="row">
        <div class="col-lg-offset-2 col-md-offset-0 col-lg-20 col-md-24">
            <a href="#" class="col-lg-1 col-md-1 col-sm-1 col-xs-0 owlprev noMobile arrows"><span class="fa fa-angle-left"></span> </a>
            <div class="col-lg-22 col-md-22 col-sm-22 col-xs-24 carusel owl-carousel owl-theme" id="owl-carusel">
                <?php foreach ($works as $work){
                    echo $work;
                } ?>
            </div>
            <a href="#" class="owlnext  col-lg-1 col-md-1 col-sm-1 col-xs-0 noMobile arrows"><span class="fa fa-angle-right"></span> </a>
        </div>
    </div>
</div>
