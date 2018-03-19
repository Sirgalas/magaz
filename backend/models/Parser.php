<?php
namespace backend\models;

use backend\modules\yandex\models\Category;
use common\models\Addlfeild;
use common\models\Catgodpost;
use common\models\FrontendSetup;
use common\models\Gods;
use common\models\Image;
use common\models\Prise;
use yii\base\Exception;
use Yii;
use yii\base\Model;
use dosamigos\transliterator\TransliteratorHelper;
use Intervention\Image\ImageManager;
use Intervention\Image\Exception\NotFoundException;
class Parser extends Model
{
    public $files;
    public $value;
    public function rules()
    {
        return [
           [['files'], 'file', 'skipOnEmpty' => true, 'extensions' => 'xml, yml']

        ];
    }

    public function upload($path, $years, $mounts, $files_to)
    {
        if (file_exists(Yii::getAlias('@frontend/web/') . $path . '/' . $years . '/' . $mounts . '/')) {
        } else {
            mkdir(Yii::getAlias('@frontend/web/') . $path . '/' . $years . '/' . $mounts . '/', 0775, true);
        }
        if($this->files->saveAs(Yii::getAlias('@frontend/web/') . $path . '/' . $years . '/' . $mounts . '/' . $files_to)){
        return true;}else{return false;}
    }
    public function XMLparses($files)
    {

        $offers = array();
        $thepicture = array();
        $xml = simplexml_load_file($files);


       $offerarr=array();
        foreach ($xml->shop->offers->offer as $foroffer){
            $offerarr[]=$foroffer;
        }
        foreach (array_reverse($offerarr) as $offer) {
            $gods= Gods::findOne(['title'=>$offer->name]);
            $strArr = array('/', '\\', ',', '<', '>', '"', "ь", "ъ",);
            $theSlug = explode('(', $offer->name);
            $slug = str_replace($strArr, '', $theSlug[0]);
            $slug = str_replace(' ', '-', $slug);
            $slugs = TransliteratorHelper::process($slug, '', 'en');
            if(isset($offer->price)){
                $price= Prise::findOne(['price1'=>$offer->price]);
                if(!isset($price)){
                    $modelPrice = new Prise([
                        'price1' => $offer->price,
                        'created_at' => time()
                    ]);
                    $modelPrice->save();
                }else{
                    $modelPrice=$price;
                }
            }
            if(!isset($gods)) {
                $modelgods = new Gods([
                    'title'             =>  strval($offer->name),
                    'slug_gods'         =>  $slugs,
                    'discription_gods'  =>  strval($offer->description),
                    'create_at'         =>  time(),
                    'id_prise'          =>  $modelPrice->id
                ]);
                    if($modelgods->save()){}else{
                        $thepicture[]=$modelgods->getErrors();
                    }
            }else{
                $modelgods=$gods;
                $modelgodsforif= Gods::findOne(['title'=>$offer->name,'slug_gods'=>$slugs,'discription_gods'=>$offer->description]);
                if(!isset($modelgodsforif)){
                    $modelgods->title=$offer->name;
                    $modelgods->slug_gods=$slugs;
                    $modelgods->discription_gods=$offer->description;
                    $modelgods->id_prise = $modelPrice->id;
                    if($modelgods->save()){}else{
                        $thepicture[]=$modelgods->getErrors();
                    }

                }

            }
                foreach ($xml->shop->categories->category as $cat){
                    $thepicture[]=strval($cat['id']);
                    if(strval($cat['id'])==$offer->categoryId) {

                        $catgoryId = Category::findOne(['name' => strval($cat)]);
                        $godstocat=Catgodpost::findOne(['id_cat'=>$catgoryId->id,'id_gods' => $modelgods->id]);
                        if(!isset($godstocat)) {
                            $cattogods = new Catgodpost([
                                'id_cat' => $catgoryId->id,
                                'id_gods' => $modelgods->id,
                            ]);
                            $cattogods->save();
                        }
                    }
                }

            if(isset($offer->param)){
                    foreach ($offer->param as $param){
                        $params=explode(',',$param);
                        foreach ($params as $parm){
                            $addFeild = new Addlfeild([
                                'id_gods'=>$modelgods->id,
                                'key_feild' => 'size',
                                'value'     =>  $parm
                            ]);
                            $addFeild->save();
                        }
                    }
                }
                if(isset($offer->keywords)){
                    $keywords= Addlfeild::findOne(['key_feild' => '	keywords','value' => $offer->keywords]);
                    if(!isset($keywords)){
                        $addFeild = new Addlfeild([
                            'id_gods'=>$modelgods->id,
                            'key_feild' => '	keywords',
                            'value'     =>  $offer->keywords
                        ]);
                        $addFeild->save();
                    }
                }
                if(isset($offer->picture)){
                    if(is_array($offer->picture)){
                        foreach ($offer->picture as $picture){
                            $arrImg= explode("/",$picture);
                            $files_to=array_pop($arrImg);
                            $imageModel= Image::findOne(['id_gods'=>$modelgods->id,"name"=>$files_to]);
                            if(!isset($imageModel)) {
                                $theModelImage= new Image();
                                $years = date('Y');
                                $mounts = date('m');
                                if (file_exists(Yii::getAlias('@frontend/web/image/gods/'). $years . '/' . $mounts . '/')) {
                                } else {
                                    mkdir(Yii::getAlias('@frontend/web/image/gods/'). $years . '/' . $mounts . '/', 0775, true);
                                }

                                $manager = new ImageManager(/*array('driver' => 'imagick')*/);
                                 try {
                                     $imag = $manager->make($picture);
                                     $imag->save(Yii::getAlias('@frontend') . '/web/image/gods/' . $years . '/' . $mounts . '/' . $files_to);



                                 }catch (\Intervention\Image\Exception\NotReadableException $e){
                                     $imag = $manager->make('http://miliydom.com.ua/logo/404.jpg');
                                     $imag->save(Yii::getAlias('@frontend') . '/web/image/gods/' . $years . '/' . $mounts . '/' . $files_to);

                                 }
                                $theModelImage->path='gods/'. $years . '/' . $mounts . '/';
                                 $theModelImage->name=$files_to;
                                 $theModelImage->id_gods=$modelgods->id;
                                 $theModelImage->save();
                                $imageresize = new Imageresize();
                                $uploadPath= '/web/image/gods/' . $years . '/' . $mounts . '/';
                                $imageresize->imagerisizegods($uploadPath,$files_to,$theModelImage);
                             }
                         }
                     }else {
                         $arrImg= explode("/",$offer->picture);
                         $files_to=array_pop($arrImg);
                         $imageModel= Image::findOne(['id_gods'=>$modelgods->id,"name"=>$files_to]);
                         if(!isset($imageModel)) {
                             $theModelImage= new Image();
                             $years = date('Y');
                             $mounts = date('m');
                             if (file_exists(Yii::getAlias('@frontend/web/image/gods/'). $years . '/' . $mounts . '/')) {
                             } else {
                                 mkdir(Yii::getAlias('@frontend/web/image/gods/') . $years . '/' . $mounts . '/', 0775, true);
                             }
                             $manager = new ImageManager(/*array('driver' => 'imagick')*/);
                             try {
                                 $imag = $manager->make($offer->picture);
                                 $imag->save(Yii::getAlias('@frontend') . '/web/image/gods/' . $years . '/' . $mounts . '/' . $files_to);
                             }catch (\Intervention\Image\Exception\NotReadableException $e){
                                 $imag = $manager->make('http://miliydom.com.ua/logo/404.jpg');
                                 $imag->save(Yii::getAlias('@frontend') . '/web/image/gods/' . $years . '/' . $mounts . '/' . $files_to);
                             }
                             $theModelImage->path='gods/'. $years . '/' . $mounts . '/';
                             $theModelImage->name=$files_to;
                             $theModelImage->id_gods=$modelgods->id;
                             $theModelImage->save();
                             $imageresize = new Imageresize();
                             $uploadPath= Yii::getAlias('@frontend') .'/web/image/gods/' . $years . '/' . $mounts . '/';
                             $imageresize->imagerisizegods($uploadPath,$files_to,$theModelImage);
                         }
                     }
                 }

        }
        return $thepicture;//$xml->shop->offers->offer->param->size[0];
    }
    public function xmlParcePrice($files,$manufacturer)
    {

    	libxml_use_internal_errors(true);
        if(!simplexml_load_file($files)){
        	$errors=array();
		    foreach (libxml_get_errors() as $error) {
		    	$er['error']=$error;
		    	$er['site']=$files;
		        $errors[]=$er;
		    }
		    libxml_clear_errors();
		}
            
            
        $xml = simplexml_load_file($files);
        if(is_object($xml->shop)){
	        foreach ($xml->shop->offers->offer as  $offer) {
                $currency = FrontendSetup::find()->where(['description' => 'currency', 'key_setup' => $offer->currencyId])->one();
	            $gods = Gods::find()->where(['url' => (string)$offer->url])/*->andFilterWhere(['!=','mouthParser',date('z',time())])*/->one();
	             if($gods) {
                     if ($offer->attributes()->available == true) {
                         $gods->have = 0;
                     } else {
                         $gods->have = 1;
                     }

                     if ($gods->prise->price1 <= (($offer->price * (int)$currency->vaelye) + $gods->pluss)) {
                         $price = Prise::findOne($gods->id_prise);
                         $price->price1 = (($offer->price * (int)$currency->vaelye) + $gods->pluss);
                         if (!$price->save()) {
                             throw new RuntimeException("don't save price" . $price->id . "in goods id" . $gods->id . "and goods name" . $gods->title);
                         }
                     }
                     $gods->mouthParser = date('z', time());
                     if (!$gods->save()) {
                         throw new RuntimeException("don't save  goods in id " . $gods->id . " and goods name " . $gods->title);
                     }

                 }
	        }
	    }else{

        }
    }
}

