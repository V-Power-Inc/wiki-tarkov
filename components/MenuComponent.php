<?php
/**
 * Created by PhpStorm.
 * User: comp
 * Date: 23.10.2017
 * Time: 21:11
 */

namespace app\components;

use app\models\Menu;
use yii\helpers\Url;
use Yii;
/** Бля - это конечно нихуя не дело, надо будет поправить */
class MenuComponent
{
    public static $index = null;
    public static $quests = null;
    public static $locations = null;
    public static $keys = null;

    public function init()
    {
        if ($this->name === null) {
            $this->name = __CLASS__;
        }
    }

    public static function  Active(){
        $activeAction = \Yii::$app->controller->action->id;
        switch ($activeAction){
            case 'index': self::$index = 'class="active"'; break;
            case 'quests': self::$quests = 'class="active"'; break;
            case 'locations': self::$locations = 'class="active"'; break;
        }
    }
    /**
     * получаем основные пункты меню
     * @return array|\yii\db\ActiveRecord[]
     */
    public static function showMenu(){

        if (Yii::$app->request->url == "/quests-of-traders/prapor-quests" || 
            Yii::$app->request->url == "/quests-of-traders/terapevt-quests" ||
            Yii::$app->request->url == "/quests-of-traders/skypchik-quests" ||
            Yii::$app->request->url == "/quests-of-traders/lyjnic-quests" ||
            Yii::$app->request->url == "/quests-of-traders/mirotvorec-quests") {
            $pagequests = 'class="active"';
        } else {
            $pagequests = "";
        }

        self::Active();
        $menu='    <nav class="navbar navbar-default fixed-navigatsiya">
        <div class="container">
            <!-- Заголовок -->
            <div class="navbar-header">
                <img class="mobile-small-logo" src="/img/logo.png">
                <a class="mobile-brand" href="/">База знаний Escape from Tarkov</a>
                <button type="button" class="navbar-toggle collapsed" data-toggle="collapse" data-target="#navbar-main">
                    <span class="icon-bar"></span>
                    <span class="icon-bar"></span>
                    <span class="icon-bar"></span>
                </button>
            </div>
            <!-- Основная часть меню (может содержать ссылки, формы и другие элементы) -->
            <div class="collapse navbar-collapse" id="navbar-main">
                <!-- Содержимое основной части -->
                <a class="navbar-brand relative" href="https://tarkov-wiki.ru"><img class="logo-img" src="/img/logo-full.png" alt="Логотип tarkov-wiki.ru"></a>

                <ul class="nav navbar-nav">
                    <li '.self::$index.'><a href="/">Главная</a></li>
                    <li '.self::$quests.' '.$pagequests.'><a href="/quests-of-traders">Справочник квестов</a></li>
                    <li '.self::$locations.'><a href="/maps">Карты локаций</a></li>
                </ul>

            </div>
        </div>
    </nav>';

        return $menu;
    }
}

?>