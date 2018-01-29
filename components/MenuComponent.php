<?php
/**
 * Created by PhpStorm.
 * User: comp
 * Date: 23.10.2017
 * Time: 21:11
 */

namespace app\components;
use Yii;

class MenuComponent
{
    public static $index = null;
    public static $quests = null;
    public static $locations = null;
    public static $keys = null;
    public static $detaikey = null;
    public static $news = null;
    public static $newsdetail = null;
    public static $articles = null;
    public static $articlesdetail = null;
    public static $lootcat = null;
    public static $mainloot = null;

    public static function  Active(){
        $activeAction = \Yii::$app->controller->action->id;
        // case аналогично $activeAction == 'index'
        switch ($activeAction){
            case 'index': self::$index = 'class="active"'; break;
            case 'quests': self::$quests = 'class="active"'; break;
            case 'locations': self::$locations = 'class="active"'; break;
            case 'keys': self::$keys = 'class="active"'; break;
            case 'doorkeysdetail': self::$detaikey = 'class="active"'; break;
            case 'articles': self::$articles = 'class="active"'; break;
            case 'articledetail': self::$articlesdetail = 'class="active"'; break;
            case 'news': self::$news = 'class="active"'; break;
            case 'newsdetail': self::$newsdetail = 'class="active"'; break;
            case 'category': self::$lootcat = 'class="active"'; break;
            case 'mainloot': self::$mainloot = 'class="active"'; break;
        }
    }
    /**
     * получаем основные пункты меню
     * @return array|\yii\db\ActiveRecord[]
     */
    public static function showMenu(){
        $pagequests = "";
        
        $urlarray = ["/quests-of-traders/prapor-quests", 
                    "/quests-of-traders/terapevt-quests",
                    "/quests-of-traders/skypchik-quests",
                    "/quests-of-traders/lyjnic-quests",
                    "/quests-of-traders/mirotvorec-quests"];
        if (in_array(Yii::$app->request->url, $urlarray)) {
            $pagequests = 'class="active"';
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
                    <li '.self::$lootcat.' '.self::$mainloot.'><a href="/loot">Справочник лута</a></li>
                    <li '.self::$keys.' '.self::$detaikey.'><a href="/keys">Ключи от дверей</a></li>
                    <li '.self::$locations.'><a href="/maps">Карты локаций</a></li>
                    <li '.self::$articles.' '.self::$articlesdetail.'><a href="/articles">Полезная информация</a></li>
                    <li '.self::$news.' '.self::$newsdetail.'><a href="/news">Новости</a></li>
                </ul>

            </div>
        </div>
    </nav>';

        return $menu;
    }
}

?>