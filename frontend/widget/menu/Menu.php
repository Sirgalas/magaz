<?php
namespace frontend\widget\menu;

use common\models\Category;
use common\models\FrontendSetup;
use yii\base\Widget;
use common\models\Page;
class Menu extends Widget{
    public $menu;
    public $location;
    public $numberCollaps;
    public function init(){
        parent::init();
    }
    public function run(){
        $category=new Category();
        $menu=FrontendSetup::findOne(['key_setup'=>$this->menu]);
        if($this->location == 'header'){
            $cat= $category->catForMenu($menu->key_setup,$menu->vaelye);
        }
        if($this->location == 'footer'){
            $cat= $category->catFooterMenu($menu->key_setup,$menu->vaelye);
        }
        return $this->render('html',[
            'category'  =>  $cat,
            'location'  =>  $this->location,
            'numberCollaps' => $this->numberCollaps
        ]);
    }
}