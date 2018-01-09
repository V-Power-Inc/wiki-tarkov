<?php
/**
 * Created by PhpStorm.
 * User: comp
 * Date: 06.01.2018
 * Time: 21:31
 */

namespace app\components;
use app\models\Doorkeys;
use yii\web\UrlRuleInterface;
use yii\base\Object;

class UrlComponent extends Object implements UrlRuleInterface
{

    public function createUrl($manager, $route, $params)
    {
        if (Doorkeys::find()->where(['url'=> $route])->One()) {
            return 'keys/'.$route;
        }
        return false;
    }

    public function parseRequest($manager, $request)
    {
        $pathInfo = $request->getPathInfo();
        $ppp =explode('/',$pathInfo);
        if($ppp[0] == 'keys'){
            if (preg_match('%([\w\-]+)([\/])([\w\-]+)$%', $pathInfo, $matches)) {
                return ['site/doorkeysdetail',['id'=>$matches[3]]];
            }
        }

        return false; 
    }
}