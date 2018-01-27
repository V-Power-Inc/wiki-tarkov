<?php
/**
 * Created by PhpStorm.
 * User: comp
 * Date: 28.01.2018
 * Time: 0:37
 */

namespace app\components;
use app\models\Category;
use yii\web\UrlRuleInterface;
use yii\base\Object;

class UrlcategorieComponent extends Object implements UrlRuleInterface
{

    public function createUrl($manager, $route, $params)
    {
        if (Category::find()->where(['url'=> $route])->One()) {
            return 'loot/'.$route;
        } 
        return false;
    }

    public function parseRequest($manager, $request)
    {
        $pathInfo = $request->getPathInfo();
        $ppp =explode('/',$pathInfo);
        if($ppp[0] == 'loot'){
            if (preg_match('%([\w\-]+)([\/])([\w\-]+)$%', $pathInfo, $matches)) {
                return ['loot/category',['id'=>$matches[3]]];
            }
        }
        return false;
    }
}