<?php
namespace backend\models;



use yii\base\Model;
use yii\console\Controller;
use common\models\FrontendSetup;
use common\models\Gods;
use yii\base\Exception;
use Yii;
use Intervention\Image\Exception\NotFoundException;
use yii\helpers\ArrayHelper;

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

    public function actionParser()
    {
        $url_xml = FrontendSetup::find()->select(['vaelye'])->where(['description' => 'url'])->all();
        $dateParse = date('z', time());
        $currency = ArrayHelper::map(FrontendSetup::find()->where(['description' => 'currency'])->asArray()->all(),
            'key_setup', 'vaelye');
        $have = [];
        $notHave = [];
        foreach ($url_xml as $xml) {
            $have = array_merge($have, $this->getXmlTrue($xml->vaelye, $currency));
            $notHave = array_merge($notHave);
        }

        try {
            $this->saveAll($have,$notHave,$dateParse);

            return var_dump('yes');
        } catch (\RuntimeException $ex) {

            return var_dump($ex->getMessage());
        }
    }

    public function getXmlTrue($files, $currency)
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
        $result = [];
        if (is_object($xml->offer)) {
            foreach ($xml->shop->offers->offer as $offer) {
                if ($offer->attributes()->available == true) {
                    $result[(string)$offer->url] = $offer->price * (int)$currency[(string)$offer->currencyId];
                }
            }
            return $result;
        } else {
            throw new \RuntimeException('не найденно xml');
        }
    }

    public function getXmlFalse($files)
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
        if (is_object($xml)) {
            $result = [];
            foreach ($xml->shop->offers->offer as $offer) {
                if ($offer->attributes()->available != true) {
                    $result[] = (string)$offer->url;
                }
            }
            return $result;
        } else {
            throw new \RuntimeException('не найденно xml');
        }
    }

    private function saveAll($have, $notHave, $date)
    {

        $allGoods = Gods::find()
            ->with('prise')
            ->andFilterWhere(['in', 'url', array_keys($have)])
            ->all();
        $model = new Gods();
        Gods::updateAll(['have'=>0],['in','url',array_keys($have)]);
        //throw new \RuntimeException(var_dump($model::updateAll(['have'=>0,'mouthParser'=>$date],['in','url',array_keys($have)])));
        if(!empty($model->find()->where(['in','url',array_keys($notHave)])->all())){
            if(!$model::updateAll(['have'=>1],['in','url',$notHave]))
                throw new \RuntimeException('изменние отсутствие не получилось');
        }
        foreach ($allGoods as $goods){
            $summ=$have[$goods->url]+ $goods->pluss;
            if($goods->prise->price1<$summ)
                $goods->prise->price1=$summ;
            if(!$goods->prise->save())
                throw new \RuntimeException('изменние цены id '.$goods->prise->id);
        }
    }
}

