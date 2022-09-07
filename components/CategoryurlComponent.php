<?php
/**
 * Created by PhpStorm.
 * User: DIR300NRU-ADMIN
 * Date: 02.02.2018
 * Time: 16:40
 */

namespace app\components;

use app\models\Category;
use yii\web\UrlRuleInterface;
use Yii;

/**
 * Класс для маршрутизации категорий и предметов справочника лута
 *
 * Class CategoryurlComponent
 * @package app\components
 */
class CategoryurlComponent implements UrlRuleInterface
{
    /**
     * Урл компонент для маршрутизации каткгорий справочника лута
     *
     * @param \yii\web\UrlManager $manager
     * @param \yii\web\Request $request
     * @return array|bool
     */
    public function parseRequest($manager, $request)
    {
        $site = stristr(Yii::$app->request->url,'/site/'); // Проверка на контроллер site
        $admin = stristr(Yii::$app->request->url,'/admin/'); // Проверка на модуль админа
        $maps = stristr(Yii::$app->request->url,'/maps/'); // Проверка на интерактивные карты
        $elfinder = stristr(Yii::$app->request->url,'/elfinder/'); // Проверка на менеджер изображений
        
        if(!$site && !$admin && !$maps && !$elfinder) {
            if(strpos($request->pathInfo,'/') !== false){
                if(preg_match('%^([\w\-]+)([\/]{1})([\-\w\d]+)([\/]{1})([\-\w\d]+)$%',$request->pathInfo, $matches)) {
                    return ['loot/category',['name'=>$matches[5]]];
                } elseif(preg_match('%^([\w\-]+)([\/]{1})([\-\w\d]+)$%',$request->pathInfo, $matches)) {
                    return ['loot/category',['name'=>$matches[3]]];
                } elseif(preg_match('%^([\-\w\d]+)([\/]{1})([\-\w\d]+)([.html]+)$%',$request->pathInfo, $matches)) {
                    return ['item/detailloot', ['item' => $matches[3]]];
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
        if ($route === 'loot/category' && Category::find()->where(['url'=>$params['name']])->andWhere(['enabled' => 1])->andWhere(['parent_category' => null])->One()) {
            return 'loot/'.$params['name'];
        } elseif ($route === 'loot/category' && Category::find()->where(['url'=>$params['name']])->andWhere(['enabled' => 1])->andWhere(['not like', 'parent_category', 'null'])->One()) {
            $cat = Category::find()->where(['url'=>$params['name']])->One();
            $parentcat = Category::find()->where(['id'=>$cat->parent_category])->One();

            return 'loot/'.$parentcat->url.'/'.$params['name'];
        }
        return false;
    }
}