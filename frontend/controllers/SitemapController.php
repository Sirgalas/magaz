<?php
namespace frontend\controllers;

use common\models\Gods;
use Yii;
use common\models\Post;
use common\models\Page;
use common\models\Category;
use yii\web\Controller;

/**
 * Site controller
 */
class SitemapController extends Controller
{


    /**
     * Displays homepage.
     *
     * @return mixed
     */
    public function actionIndex()
    {
       // { if (!$xml_sitemap = Yii::$app->cache->get('sitemap')) {
            $urls = array();
            $categories= Category::find()->all();
            $gods= Gods::find()->all();
            foreach ($categories as $category) {
                $urls[] = array( Yii::$app->urlManager->createUrl(['/goods/' . $category->slug_category]), 'daily');  }
            foreach ($gods as $goods) {
                $urls[] = array( Yii::$app->urlManager->createUrl(['/goods/' . $goods->slug_gods]),'weekly' ); }
            $xml_sitemap = $this->renderPartial('index', array(
                'host' => Yii::$app->request->hostInfo,
                'urls' => $urls, ));
            /*Yii::$app->cache->set('sitemap', $xml_sitemap, 3600*12);
            }
            */Yii::$app->response->format = \yii\web\Response::FORMAT_XML;
            echo $xml_sitemap;
       // }

    }
}
