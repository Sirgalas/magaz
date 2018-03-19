<?php
namespace frontend\components;

use common\models\Gods;
use common\models\Category;
use yii\web\UrlRuleInterface;
use yii\base\Object;
class GodsUrlRule extends Object implements UrlRuleInterface{
    public function createUrl($manager, $route, $params){
        if ($route === 'gods/gods/category') {
            if (isset($params['slug']) && isset($params['page']) && isset($params['per-page'])) {
                return 'goods/' . $params['slug'] . '?page=' . $params['page'] . '&per-page=' . $params['per-page'] . '/';
            } elseif (isset($params['slug'])) {
                return 'goods/'.$params['slug'].'/';
            }
        }elseif($route === 'gods/gods/onegods') {
            if (isset($params['slug'])) {
                return 'goods/' . $params['slug'] . '/';
            }
        }
        return false;
    }
    public function parseRequest($manager, $request){
        $pathInfo = $request->getPathInfo();
        if (preg_match('%^goods(/(\w+)([-](\w*))*)%', $pathInfo, $matchesg)) {
            $slug = str_replace('/', '', $matchesg[1]);
             $exists = Gods::find()->where(['slug_gods' => $slug])->exists();
            if ($exists) {
                    return ['gods/gods/onegods', ['slug' => $slug]];
            } else {
                return ['gods/gods/category', ['slug' => $slug]];
            }
        }elseif (preg_match('%^(\w+)(/(\w*))%', $pathInfo, $matches)) {
                $exists = Category::find()->where(['slug_category' => $matches[3]])->exists();
                if ($exists) {

                    return ['gods/gods/category', ['slug' => $matches[3]]];
                }
            }

        return false;
    }
}