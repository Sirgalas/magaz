<?php
/**
 * Created by PhpStorm.
 * User: root
 * Date: 23.06.17
 * Time: 18:15
 */

namespace frontend\modules\search\models;

use common\models\Addlfeild;
use common\models\Category;
use yii\base\Model;

class SearchModel extends  Model
{
    public $category;
    public $size;
    public $color;
    public $season;
    public $parent;
    public $priceMin;
    public $priceMax;
    public $sort;
    public function rules()
    {
        return [

            [['priceMin','priceMax','parent','season','color','size','category'],'string', 'max' => 510],
        ];
    }

    public function idgoods($arr,$categotyAll){
        $id=array();
        $idAddFeild=array();
        if(isset($categotyAll)){
            if(!empty($arr["color"])){
                $addFields=Addlfeild::find()->where(['value'=>$arr["color"]])->with('goods','goods.prise')->all();
                foreach ($addFields as $addField){
                    if($addField->goods->prise->price1 > $arr["priceMin"] && $addField->goods->prise->price1 < $arr["priceMax"])
                    $id[]=$addField->id_gods;
                }
            }
        }else {
            if (empty($arr['category'])) {
                $cats = Category::find()->where(['id' => $arr['parent']])->with('child', 'child.gods', 'child.gods.prise')->one();
                $cats->child;
                foreach ($cats->child as $child) {
                    foreach ($child->gods as $goods) {
                        if ($goods->prise["price1"] > $arr["priceMin"] && $goods->prise["price1"] < $arr["priceMax"]) {
                            $id[] = $goods->id;
                        }

                    }
                }
            } else {
                $child = Category::find()->where(['id' => $arr['category']])->with('gods', 'gods.prise')->one();
                foreach ($child->gods as $goods) {
                    if ($goods->prise->price1 > $arr["priceMin"] && $goods->prise->price1 < $arr["priceMax"]) {
                        $id[] = $goods->id;
                    }
                }
            }
            if(!empty($arr["size"])||!empty($arr["color"])||!empty($arr["season"])){
                $val=array();
                if(!empty($arr["size"])){
                    if($arr["size"]=='size1'||$arr["size"]=='size2'||$arr["size"]=='size3'||$arr["size"]=='size4'){
                        $sizeAddFeilds=Addlfeild::find()->where(['key_feild'=>$arr['size']])->all();
                        foreach ($sizeAddFeilds as $sizeAddFeild){
                            $idAddFeild[]=$sizeAddFeild->id_gods;
                        }
                    }else{
                        foreach ($arr["size"] as $size){
                            $val[]=$size;
                        }
                    }

                }
                if(!empty($arr["color"])){
                    foreach ($arr["color"] as $color){
                        $val[]=$color;
                    }
                }
                if(!empty($arr["season"])){
                    foreach ($arr["season"] as $season){
                        $val[]=$season;
                    }
                }
                $addFields=Addlfeild::find()->where(['value'=>$val])->all();
                foreach ($addFields as $addField){
                    $idAddFeild[]=$addField->id_gods;
                }
            }
        }

        if(!empty($idAddFeild))
            $result=array_intersect($id,$idAddFeild);
        else
            $result=$id;

        return $result;
    }

}