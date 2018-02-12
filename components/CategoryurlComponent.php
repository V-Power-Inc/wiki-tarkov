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
use yii\web\HttpException;


class CategoryurlComponent implements UrlRuleInterface
{
/** Урл компонент для маршрутизации каткгорий справочника лута **/
    public function parseRequest($manager, $request)
    {

        $site = stristr($request->pathInfo,'site'); // Проверка на контроллер site
        $admin = stristr($request->pathInfo,'admin'); // Проверка на модуль админа
        $maps = stristr($request->pathInfo,'maps'); // Проверка на интерактивные карты
        
        if(!$site && !$admin && !$maps) {
            if(strpos($request->pathInfo,'/') !== false){
                if(preg_match('%^([\w\-]+)([\/]{1})([\-\w\d]+)([\/]{1})([\-\w\d]+)$%',$request->pathInfo, $matches)) {
                    return ['loot/category',['name'=>$matches[5]]];
                }
                elseif(preg_match('%^([\w\-]+)([\/]{1})([\-\w\d]+)$%',$request->pathInfo, $matches)) {
                    return ['loot/category',['name'=>$matches[3]]];
                }
            }
            return false;
        }
        return false;
    }

    public function createUrl($manager, $route, $params)
    {
//        $pathInfo = $route;
//        if (preg_match('%^(([\d]+)([\/]?)([\-\d\w]+))$%', $pathInfo, $matches)) {
//            $catigories = Category::find()->select('url')->where(['id'=>$matches[2]])->scalar();
//            return '/loot/' .$catigories.'/'.$matches[4];
//        }
        return false;  // данное правило не применимо
    }
}