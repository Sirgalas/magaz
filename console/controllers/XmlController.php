<?php
namespace console\controllers;

use yii\console\Controller;
use common\models\FrontendSetup;
use common\models\Gods;
use common\models\Prise;
use yii\base\Exception;
use Yii;
use Intervention\Image\Exception\NotFoundException;

class XmlController extends Controller{

    public function actionParser(){
        $url_xml=FrontendSetup::find()->select(['vaelye'])->where(['description'=>'url'])->all();
        foreach ($url_xml as $xml){
            try{
                $xmlParse= $this->getXml($xml->vaelye,$xml->key_setup);
                return $xmlParse;
            }catch(RuntimeException $ex){
                return var_dump($ex->getMessage());
            }
        }
    }

    public function getXml($files,$manufacturer){
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
                return $offer;
                $currency = FrontendSetup::find()->where(['description' => 'currency', 'key_setup' => $offer->currencyId])->one();
                $gods = Gods::find()->where(['url' => (string)$offer->url])->one();
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