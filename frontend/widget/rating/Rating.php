<?php
namespace frontend\widget\menu;

use common\models\Category;
use common\models\FrontendSetup;
use yii\base\Widget;
use common\models\Page;
class Menu extends Widget{
    public $menu;
    public $location;
    public function init(){
        parent::init();
    }
    public function run(){}
}
?>