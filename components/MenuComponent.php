<?php
/**
 * Created by PhpStorm.
 * User: comp
 * Date: 23.10.2017
 * Time: 21:11
 */

namespace app\components;
use Yii;
use app\components\AlertComponent;

class MenuComponent
{
    public static $keys = null;
    public static $detaikey = null;
    public static $news = null;
    public static $newsdetail = null;
    public static $articles = null;
    public static $articlesdetail = null;
    public static $lootcat = null;
    public static $mainloot = null;
    public static $loot = null;
    public static $skillsdetail = null;
    public static $questloot = null;
    public static $questions = null;
    

    public static function  Active(){
        $activeAction = \Yii::$app->controller->action->id;
        // case аналогично $activeAction == 'index'
        switch ($activeAction){
            case 'keys': self::$keys = 'class="active"'; break;
            case 'doorkeysdetail': self::$detaikey = 'class="active"'; break;
            case 'articles': self::$articles = 'class="active"'; break;
            case 'articledetail': self::$articlesdetail = 'class="active"'; break;
            case 'news': self::$news = 'class="active"'; break;
            case 'newsdetail': self::$newsdetail = 'class="active"'; break;
            case 'category': self::$lootcat = 'class="active"'; break;
            case 'detailloot': self::$mainloot = 'class="active"'; break;
            case 'mainloot': self::$loot = 'class="active"'; break;
            case 'skillsdetail':self::$skillsdetail = 'active'; break;
            case 'questloot':self::$questloot = 'class="active"'; break;
            case 'questions':self::$questions = 'class="active"'; break;
        }
    }
    /**
     * получаем основные пункты меню
     * @return array|\yii\db\ActiveRecord[]
     */
    public static function showMenu(){

        /*** Разбивка для страниц карт локаций ***/
        $intermaps = "";

        $mapsurls = [
            "/maps",
            "/maps/zavod-location",
            "/maps/bereg-location",
            "/maps/forest-location",
            "/maps/tamojnya-location",
        ];

        if (in_array(Yii::$app->request->url, $mapsurls)) {
            $intermaps = 'active';
        }

       /*** Разбивка для страниц торговцев и их квестов ***/
        $pagequests = "";
        
        $urlarray = ["/quests-of-traders",
                    "/quests-of-traders/prapor-quests", 
                    "/quests-of-traders/terapevt-quests",
                    "/quests-of-traders/skypchik-quests",
                    "/quests-of-traders/lyjnic-quests",
                    "/quests-of-traders/mirotvorec-quests",
                    "/traders/prapor",
                    "/traders/terapevt",
                    "/traders/lyjnic",
                    "/traders/mirotvorec",
                    "/traders/mehanic",
                    "/traders/skupshik",
        ];
        if (in_array(Yii::$app->request->url, $urlarray)) {
            $pagequests = 'active';
        }
        
        
        /*** Разбивка для активных умений ***/
        $skills = '';
        
        $skillsarray = [
            "/skills",
            "/skills/physical",
            "/skills/mental",
            "/skills/practical",
            "/skills/combat",
            "/skills/special",
        ];
            
        if (in_array(Yii::$app->request->url,$skillsarray)) {
            $skills = 'active';
        }

        /*** Далее пошел габлон отрисовки меню ***/

        self::Active();
        $menu='    <nav class="navbar navbar-default fixed-navigatsiya">
        <div class="container adaptive-fix">
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
                    
                    <!-- dropdown list - skills -->
                    <li class="dropdown '.$skills.self::$skillsdetail.'">
                      <a href="#" class="dropdown-toggle '.$skills.self::$skillsdetail.'" data-toggle="dropdown" role="button" aria-haspopup="true" aria-expanded="false"><b>Умения</b><span class="caret"></span></a>
                      <ul class="dropdown-menu">
                        <li><a href="/skills/physical">Физические умения</a></li>
                        <li><a href="/skills/mental">Ментальные умения</a></li>
                        <li><a href="/skills/practical">Практические умения</a></li>
                        <li><a href="/skills/combat">Боевые умения</a></li>
                        <li><a href="/skills/special">Особые умения</a></li>
                            <li role="separator" class="divider"></li>
                        <li><a href="/skills">Смотреть все умения</a></li>
                      </ul>
                    </li>
                    
                     <!-- dropdown list - traders -->
                     <li class="dropdown '.$pagequests.'">
                      <a href="#" class="dropdown-toggle '.$pagequests.'" data-toggle="dropdown" role="button" aria-haspopup="true" aria-expanded="false"><b>Торговцы</b><span class="caret"></span></a>
                      <ul class="dropdown-menu">
                        <li><a href="/traders/prapor">Прапор</a></li>
                        <li><a href="/traders/terapevt">Терапевт</a></li>
                        <li><a href="/traders/skupshik">Скупщик</a></li>
                        <li><a href="/traders/lyjnic">Лыжник</a></li>
                        <li><a href="/traders/mirotvorec">Миротворец</a></li>
                        <li><a href="/traders/mehanic">Механик</a></li>
                            <li role="separator" class="divider"></li>
                        <li><a href="/quests-of-traders">Смотреть всех торговцев</a></li>
                      </ul>
                    </li>

                
                    <!-- Other lists of menu selects -->                 
                    <li '.self::$lootcat.' '.self::$mainloot.' '.self::$loot.' '.self::$questloot.'><a href="/loot">Справочник лута</a></li>
                    <li '.self::$keys.' '.self::$detaikey.'><a href="/keys">Справочник ключей</a></li>
                    
                    
                    <!-- dropdown list map locations -->
                                         
                     <li class="dropdown '.$intermaps.'">
                      <a href="#" class="dropdown-toggle '.$intermaps.'" data-toggle="dropdown" role="button" aria-haspopup="true" aria-expanded="false"><b>Карты локаций</b><span class="caret"></span></a>
                      <ul class="dropdown-menu">
                        <li><a href="/maps/zavod-location#3/68.97/-8.00">Завод</a></li>
                        <li><a href="/maps/tamojnya-location#4/80.40/-75.98">Таможня</a></li>
                        <li><a href="/maps/forest-location#3/72.50/-9.58">Лес</a></li>
                        <li><a href="/maps/bereg-location#3/60.93/-10.81">Берег</a></li>
                        <li><a href="/maps/razvyazka-location">Развязка</a></li>
                            <li role="separator" class="divider"></li>
                        <li><a href="/maps">Смотреть список доступных карт</a></li>
                      </ul>
                    </li>

                     <!-- Other lists of menu selects -->    
                    <li '.self::$articles.' '.self::$articlesdetail.'><a href="/articles">Полезная информация</a></li>
                    <li '.self::$news.' '.self::$newsdetail.'><a href="/news">Новости</a></li>
                    <li '.self::$questions.'><a href="/questions">Частые вопросы</a></li>
                </ul>

            </div>
        </div>    
    </nav>';

        return $menu;
    }
}

?>