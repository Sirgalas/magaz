<?php
namespace frontend\widget\searchform;

use common\models\Category;
use common\models\FrontendSetup;

use common\models\Page;
use common\models\Prise;
use yii\base\Widget;
use frontend\modules\search\models\SearchModel;
class Searchform extends Widget{
    public $category;

    public function init(){
        parent::init();
    }
    public function run(){
        $model= new SearchModel();
        if(isset($this->category->parrent_category)&&$this->category->parrent_category!=0){
            $category= Category::findOne([$this->category->parrent_category]);
        }else{
            $category=$this->category;
        }
        if(empty($category->child)){
            $categoryAll=Category::find()->where('parrent_category!=0')->all();
        }else{
            $categoryAll=null;
        }
        $contacts=Page::findOne(['slug_page'=>'Kontakty']);
        $max=Prise::find()->max('price1');
        $min=Prise::find()->min('price1');
        $frontendSetup=FrontendSetup::find()->all();
        return $this->render('html',[
            'category'      =>  $category,
            'model'         =>  $model,
            'categoryAll'   =>  $categoryAll,
            'frontendSetup' =>  $frontendSetup,
            'min'           =>  $min,
            'max'           =>  $max,
            'contacts'      =>  $contacts
        ]);
    }
}