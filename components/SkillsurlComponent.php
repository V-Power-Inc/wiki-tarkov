<?php
/**
 * Created by PhpStorm.
 * User: comp
 * Date: 24.02.2018
 * Time: 13:07
 */

namespace app\components;

use app\models\Catskills;
use yii\web\UrlRuleInterface;
use Yii;


class SkillsurlComponent implements UrlRuleInterface
{
    /** Урл компонент для маршрутизации каткгорий справочника лута **/
    public function parseRequest($manager, $request)
    {
        $site = stristr(Yii::$app->request->url,'/site/'); // Проверка на контроллер site
        $admin = stristr(Yii::$app->request->url,'/admin/'); // Проверка на модуль админа
        $maps = stristr(Yii::$app->request->url,'/maps/'); // Проверка на интерактивные карты
        $elfinder = stristr(Yii::$app->request->url,'/elfinder/'); // Проверка на менеджер изображений
        $loot = stristr(Yii::$app->request->url,'/loot'); // Проверка на лут страницы

        if(!$site && !$admin && !$maps && !$elfinder && !$loot) {
            if(strpos($request->pathInfo,'/') !== false){
//                echo '<pre>';
//                echo print_r($request->pathInfo);
//                exit;
//                echo '</pre>';
                if(preg_match('%^([\-\w\d]+)([\/]{1})([\-\w\d]+)([\/]{1})([\-\w\d]+)([.html]+)$%',$request->pathInfo, $matches)) {
                    return ['skills/skillsdetail', ['url' => $matches[5]]];
                } elseif(preg_match('%^([\w\-]+)([\/]{1})([\-\w\d]+)$%',$request->pathInfo, $matches)) {
                    return ['skills/skillscategory',['name'=>$matches[3]]];
                } 
            }
            return false;
        }
        return false;
    }

    public function createUrl($manager, $route, $params)
    {
        return false; // Данное правило неприменимо
    }
}