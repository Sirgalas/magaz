<?php
namespace frontend\widget\menutest;

use Yii;
use common\models\FrontendSetup;
use yii\base\Widget;
use yii\helpers\Html;
use yii\helpers\Url;
use sirgalas\menu\models\Menu;
class Menutest extends Widget{
    public $location;
    public $home;
    public $numberCollaps;
    public function init(){
        parent::init();
    }
    public function run(){
        $allMenu=FrontendSetup::find()->where(['description'=>'menus'])->all();
        $modelMenu= new Menu();
        $menu = FrontendSetup::find()->where(['key_setup'=>$this->location])->one();
        $models=$modelMenu->renderMenu($menu,'slug',$allMenu,'vaelye');
        $menuArr='';
        if(isset($this->home)){
            $menuArr.='<li class="listitem">'.Html::a(Yii::t('frontend','HomeURL'),Url::to(Yii::$app->homeUrl)).'</li>';
        }
        foreach ($models as $model) {
            //$menuArr[]=$model;
            
            if (isset($model['url']['slug'])) {
                $slug = Url::to([$model['url'][0], 'slug' => $model['url']['slug']]);
            }else if(isset($model['url'])){
                $slug=$model['url'];
            }else{
                $slug='#';
            }
            if(!empty($model['items'])) {
                $menuArr .= '<li class="dropdown">'.Html::a($model['label'],$slug,['class'=>"dropdown-toggleOne col-md-24 col-sm-16 col-xs-16 "]).'<a href="#" class="nodisplay dropdown-toggle col-sm-8 col-xs-8" data-toggle="dropdown"><span class="fa fa-caret-down fa-4"></span></span></a>';
                    $menuArr .= '<ul class="dropdown-menu">';
                        $menuArr .= $this->catParent($model['items']).'</ul>';
            }else{
                $menuArr.= '<li class="listitem">'.Html::a($model['label'],$slug,['class'=>"dropdown-toggleOne" ]).'</li>';
            }
        }
        return $this->render('html',[
            'model'=>$menuArr,
            'numberCollaps'=>$this->numberCollaps
        ]);
    }
    public function catParent($models){
        $result='';
        foreach ($models as $key =>$val){
            if(strpos($key,'extra') ===  0){
                foreach ($val as $menu){
                    $url=Url::to([$menu->path,'slug'=>$menu->alias]);
                    $img=Html::img($menu->imgPath.'/2-'.$menu->imgName,['alt'=>$menu->title]);
                    $result.="<li class='col-md-4'><ul><li><a href='$url' class='extra'>$img<span>".$menu->title."</span></a></li></ul></li>";

                }
            }else{
                $counter=0;
                $result.="<li class='col-ld-15 col-md-15 col-sm-24'><ul><li class='col-lg-4 col-md-4 col-sm-24'><ul>";
                foreach ($val as $menu){
                    $url=Url::to([$menu->path,'slug'=>$menu->alias]);
                    $result.="<li><a href='$url'>".$menu->title."</a></li>";
                    $counter++;
                    if($counter%(count($val)/4)==0){
                        $result.="</ul></li><li class='col-lg-5 col-md-5 col-sm-24'><ul>";
                    }
                }
                $result.="</ul></li></ul></li>";
            }
        }
        return $result;
    }
}