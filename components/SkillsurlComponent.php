<?php
/**
 * Created by PhpStorm.
 * User: comp
 * Date: 24.02.2018
 * Time: 13:07
 */

namespace app\components;

use yii\web\UrlRuleInterface;
use Yii;

/**
 * Класс для маршрутизации категорий и умений для справочника умений
 *
 * Class SkillsurlComponent
 * @package app\components
 */
class SkillsurlComponent implements UrlRuleInterface
{
    /**
     * Урл компонент для маршрутизации категорий справочника умений
     *
     * @param \yii\web\UrlManager $manager
     * @param \yii\web\Request $request
     * @return array|bool
     */
    public function parseRequest($manager, $request)
    {
        // todo: Отрефакторить это, уверен без этого можно обойтись
        $site = stristr(Yii::$app->request->url,'/site/'); // Проверка на контроллер site
        $admin = stristr(Yii::$app->request->url,'/admin/'); // Проверка на модуль админа
        $maps = stristr(Yii::$app->request->url,'/maps/'); // Проверка на интерактивные карты
        $elfinder = stristr(Yii::$app->request->url,'/elfinder/'); // Проверка на менеджер изображений
        $loot = stristr(Yii::$app->request->url,'/loot'); // Проверка на лут страницы

        if(!$site && !$admin && !$maps && !$elfinder && !$loot) {
            if(strpos($request->pathInfo,'/') !== false){
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

    /**
     * @param \yii\web\UrlManager $manager
     * @param string $route
     * @param array $params
     * @return bool|string
     */
    public function createUrl($manager, $route, $params)
    {
        /** Возаращем false в этом методе */
        return false;
    }
}