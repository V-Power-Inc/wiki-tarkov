<?php
/**
 * Created by PhpStorm.
 * User: DIR300NRU-ADMIN
 * Date: 02.02.2018
 * Time: 16:40
 */

namespace app\components;

use yii\web\UrlRule;
use app\models\Category;
use yii\web\UrlRuleInterface;


class CategoryurlComponent implements UrlRuleInterface
{
/** Урл компонент для маршрутизации каткгорий справочника лута **/
    public function parseRequest($manager, $request)
    {

        $path = $rest = substr($request->pathInfo, 0, strpos($request->pathInfo,'.'));
        // если это простой url тоесть из вертикального меню
        if($request->pathInfo === ''){
            return ['loot/category',[]];
        }elseif(strpos($request->pathInfo,'/') !== false){
            if (preg_match('%^([\w\-]+)([\/]{1})([\-\w\d]+)$%', $path, $matches)){
                return ['articles/fulltext',['name'=>$matches[3]]];
            }
        }

        return false;
    }

    public function createUrl($manager, $route, $params)
    {
        $pathInfo = $route;
        if (preg_match('%^(([\d]+)([\/]?)([\-\d\w]+))$%', $pathInfo, $matches)) {
            $catigories = Category::find()->select('url')->where(['id'=>$matches[2]])->scalar();
            return '/loot' .$catigories.'/'.$matches[4];
        }
        return false;  // данное правило не применимо
    }
}