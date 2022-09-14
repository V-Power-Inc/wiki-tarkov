<?php
/**
 * Created by PhpStorm.
 * User: comp
 * Date: 06.01.2018
 * Time: 21:31
 */

namespace app\components;
use app\models\Doorkeys;
use app\models\News;
use app\models\Articles;
use app\models\Traders;
use yii\web\UrlRuleInterface;
use yii\base\BaseObject;

/**
 * Url компонент для маршрутизации на детальные страницы некоторых коллекций объектов
 * (Новости, Ключи, Полезные материалы, Детальные страницы торговцеы)
 *
 * Class UrlComponent
 * @package app\components
 */
class UrlComponent extends BaseObject implements UrlRuleInterface
{
    /**
     * @param \yii\web\UrlManager $manager
     * @param \yii\web\Request $request
     * @return array|bool
     * @throws \yii\base\InvalidConfigException
     */
    public function parseRequest($manager, $request)
    {
        $pathInfo = $request->getPathInfo();
        $ppp =explode('/',$pathInfo);
        if($ppp[0] == 'keys'){
            if (preg_match('%([\w\-]+)([\/])([\w\-]+)$%', $pathInfo, $matches)) {
                return ['site/doorkeysdetail',['id'=>$matches[3]]];
            }
        } elseif ($ppp[0] == 'news') {
            if (preg_match('%([\w\-]+)([\/])([\w\-]+)$%', $pathInfo, $matches)) {
                return ['site/newsdetail',['id'=>$matches[3]]];
            }
        } elseif ($ppp[0] == 'articles') {
            if (preg_match('%([\w\-]+)([\/])([\w\-]+)$%', $pathInfo, $matches)) {
                return ['site/articledetail',['id'=>$matches[3]]];
            }
        } elseif ($ppp[0] == 'traders') {
            if (preg_match('%([\w\-]+)([\/])([\w\-]+)$%', $pathInfo, $matches)) {
                return ['trader/tradersdetail',['id'=>$matches[3]]];
            }
        } elseif ($ppp[0] == 'skills') {
            if(preg_match('%^([\-\w\d]+)([\/]{1})([\-\w\d]+)([\/]{1})([\-\w\d]+)([.html]+)$%',$request->pathInfo, $matches)) {
                return ['skills/skillsdetail', ['url' => $matches[5]]];
            } elseif(preg_match('%^([\w\-]+)([\/]{1})([\-\w\d]+)$%',$request->pathInfo, $matches)) {
                return ['skills/skillscategory',['name'=>$matches[3]]];
            }
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
        if (Doorkeys::find()->where(['url'=> $route])->One()) {
            return 'keys/'.$route;
        } elseif (News::find()->where(['url'=> $route])->One()){
            return 'news/'.$route;
        } elseif(Articles::find()->where(['url'=> $route])->One()) {
            return 'articles/' . $route;
        } elseif(Traders::find()->where(['url'=> $route])->One()) {
            return 'traders/' . $route;
        }
        return false;
    }


}