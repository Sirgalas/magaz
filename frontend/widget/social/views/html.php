<?php
foreach ($social as $soc){
    if($soc->key_setup=='facebook'){ ?>
            <a href="<?= $soc->vaelye ?>" class="facebook" target="_blank" ><span class="fa fa-facebook"></span> </a>
    <?php  }
    if($soc->key_setup=='vk'){ ?>
            <a href="<?= $soc->vaelye ?>" class="vk" target="_blank"><span class="fa fa fa-vk"></span> </a>
    <?php  }
    if($soc->key_setup=='ok'){ ?>
            <a href="<?= $soc->vaelye ?>" class="ok" target="_blank"><span class="fa fa-odnoklassniki"></span> </a>
    <?php  }
    if($soc->key_setup=='instagram'){ ?>
            <a href="<?= $soc->vaelye ?>" class="instagram" target="_blank"><span class="fa fa-instagram"></span> </a>
    <?php  }
 } ?>