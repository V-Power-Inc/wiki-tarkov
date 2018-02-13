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
use Yii;


class CategoryurlComponent implements UrlRuleInterface
{
/** Урл компонент для маршрутизации каткгорий справочника лута **/
    public function parseRequest($manager, $request)
    {
        $site = stristr(Yii::$app->request->url,'/site/'); // Проверка на контроллер site
        $admin = stristr(Yii::$app->request->url,'/admin/'); // Проверка на модуль админа
        $maps = stristr(Yii::$app->request->url,'/maps/'); // Проверка на интерактивные карты
        
        if(!$site && !$admin && !$maps) {
            if(strpos($request->pathInfo,'/') !== false){
                if(preg_match('%^([\w\-]+)([\/]{1})([\-\w\d]+)([\/]{1})([\-\w\d]+)$%',$request->pathInfo, $matches)) {
                    return ['loot/category',['name'=>$matches[5]]];
                }
                elseif(preg_match('%^([\w\-]+)([\/]{1})([\-\w\d]+)$%',$request->pathInfo, $matches)) {
                    return ['loot/category',['name'=>$matches[3]]];
                } elseif(preg_match('%^([\-\w\d]+)([\/]{1})([\-\w\d]+)([.html]+)$%',$request->pathInfo, $matches)) {
                    return ['item/detailloot', ['item' => $matches[3]]];
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