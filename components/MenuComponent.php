<?php
/**
 * Created by PhpStorm.
 * User: comp
 * Date: 23.10.2017
 * Time: 21:11
 */

namespace app\components;

use app\components\menu\MenuUrlsComponent;
use app\controllers\FeedbackController;
use Yii;
use yii\base\InvalidConfigException;
use yii\helpers\Url;

/**
 * Класс горизонтального меню в верхней части сайта
 *
 * Class MenuComponent
 * @package app\components
 */
final class MenuComponent
{
    /** Атрибуты класса для сетапа активности вкладки при выбранном элементе меню */
    private static $keys = null;
    private static $detaikey = null;
    private static $newsdetail = null;
    private static $lootcat = null;
    private static $mainloot = null;
    private static $loot = null;
    private static $skillsdetail = null;
    private static $questloot = null;
    private static $bosses = null;
    private static $view = null;
    private static $item = null;
    private static $list = null;

    /** Атрибуты класса для сетапа активности по конкретным массивами урлов */
    private static $intermaps = null;
    private static $skills = null;
    private static $pagequests = null;
    private static $other = null;

    /**
     * Получаем основные пункты меню и возвращаем полностью готовое меню в виде строки
     *
     * @return string
     */
    public static function showMenu(): string
    {
        /** Проверяем состояние активности меню у табов первого порядка */
        self::getActiveNav();

        /** Проверяем состояние активности меню у табов, с помощью массивов url адресов */
        self::getActiveNavByUrlArray();

        /** HTML шаблон отрисовки меню */
        $menu = '<nav class="navbar navbar-default fixed-navigatsiya"> 
        
            <!-- Feedback Form -->
            ' . self::feedBackform() . ' 
        
            <!-- Changer of site theme -->
            ' . self::themeToggler() . '
        
            <div class="container adaptive-fix">
                <!-- Заголовок -->
                <div class="navbar-header">
                    <img class="mobile-small-logo" alt="Логотип EFT" src="/img/logo.png">
                    <a class="mobile-brand" href="/">База знаний EFT</a>
                    <button type="button" class="navbar-toggle collapsed" data-toggle="collapse" data-target="#navbar-main" title="Мобильное меню">
                        <span class="icon-bar"></span>
                        <span class="icon-bar"></span>
                        <span class="icon-bar"></span>
                    </button>
                </div>
                <!-- Основная часть меню (может содержать ссылки, формы и другие элементы) -->
                <div class="collapse navbar-collapse" id="navbar-main">
                    <!-- Содержимое основной части -->
                    <a class="navbar-brand relative" href='.$_ENV['DOMAIN_PROTOCOL'] . $_ENV['DOMAIN'].'><img class="logo-img" src="/img/logo-full.png" alt="Логотип '. $_ENV['DOMAIN'].'"></a>
    
                    <ul class="nav navbar-nav">
                        
                        <!-- dropdown list - skills -->
                        <li class="dropdown '.self::$skills.self::$skillsdetail.'">
                          <a href="#" class="dropdown-toggle '.self::$skills.self::$skillsdetail.'" data-toggle="dropdown" role="button" aria-haspopup="true" aria-expanded="false"><b>Умения</b><span class="caret"></span></a>
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
                         <li class="dropdown '.self::$pagequests.'">
                          <a href="#" class="dropdown-toggle '.self::$pagequests.'" data-toggle="dropdown" role="button" aria-haspopup="true" aria-expanded="false"><b>Торговцы</b><span class="caret"></span></a>
                          <ul class="dropdown-menu">
                            <li><a href="/traders/prapor">Прапор</a></li>
                            <li><a href="/traders/terapevt">Терапевт</a></li>
                            <li><a href="/traders/skupshik">Скупщик</a></li>
                            <li><a href="/traders/lyjnic">Лыжник</a></li>
                            <li><a href="/traders/mirotvorec">Миротворец</a></li>
                            <li><a href="/traders/mehanic">Механик</a></li>
                            <li><a href="/traders/baraholshik">Барахольщик</a></li>
                            <li><a href="/traders/eger">Егерь</a></li>
                            <li><a href="/quests-of-traders/seeker-quests">Квесты Смотрителя</a></li>
                            <li><a href="/quests-of-traders/ref-quests">Квесты Рефа</a></li>
                                <li role="separator" class="divider"></li>
                            <li><a href="/quests-of-traders">Смотреть всех торговцев</a></li>
                          </ul>
                        </li>
    
                        <!-- Other lists of menu selects -->                 
                        <li '.self::$lootcat.' '.self::$mainloot.' '.self::$loot.' '.self::$questloot.'><a href="/loot">Справочник лута</a></li>
                        <li '.self::$keys.' '.self::$detaikey.'><a href="/keys">Справочник ключей</a></li>
         
                        <!-- dropdown list map locations -->              
                         <li class="dropdown '.self::$intermaps.'">
                          <a href="#" class="dropdown-toggle '.self::$intermaps.'" data-toggle="dropdown" role="button" aria-haspopup="true" aria-expanded="false"><b>Карты локаций</b><span class="caret"></span></a>
                          <ul class="dropdown-menu">
                            <li><a href="/maps/zavod-location#3/68.97/-8.00">Завод</a></li>
                            <li><a href="/maps/tamojnya-location#4/80.40/-75.98">Таможня</a></li>
                            <li><a href="/maps/forest-location#3/72.50/-9.58">Лес</a></li>
                            <li><a href="/maps/bereg-location#3/60.93/-10.81">Берег</a></li>
                            <li><a href="/maps/razvyazka-location#3/75.32/-44.38">Развязка</a></li>
                            <li><a href="/maps/terragroup-laboratory-location#2/41.0/-1.2">Лаборатория Terra Group</a></li>   
                            <li><a href="/maps/rezerv-location#2/64.6/41.0">Резерв</a></li>
                            <li><a href="/maps/lighthouse-location#2/74.0/65.2">Маяк</a></li>
                            <li><a href="/maps/streets-of-tarkov-location#2/59.2/34.3">Улицы Таркова</a></li>
                            <li><a href="/maps/epicenter#2/48.7/-24.8">Эпицентр</a></li>
                                <li role="separator" class="divider"></li>
                            <li><a href="/maps">Смотреть список доступных карт</a></li>
                          </ul>
                        </li>
    
                         <!-- Other lists of menu selects -->   
                         <li class="dropdown information-nav-block '.self::$other.self::$newsdetail.'">
                          <a href="#" class="dropdown-toggle '.self::$other.self::$newsdetail.'" data-toggle="dropdown" role="button" aria-haspopup="true" aria-expanded="false"><b>Информация</b><span class="caret"></span></a>
                          <ul class="dropdown-menu">
                            <li><a href="/currencies">Курсы валют</a></li>
                            <li><a href="/articles">Полезная информация</a></li>
                            <li><a href="/news">Новости</a></li>
                            <li><a href="/questions">Частые вопросы</a></li>
                            <li><a href="/table-patrons">Таблица патронов</a></li>
                            <li><a href="/clans">Список кланов</a></li>
                            <li><a href="/feedback-form">Обратная связь</a></li>
                          </ul>
                        </li>
                        
                        <li '.self::$bosses.self::$view.'><a href="/bosses">Боссы на локациях</a></li>
                        <li '.self::$list.self::$item.'><a href="/items">Актуальный лут</a></li>
                         
                    </ul>
    
                </div>
            </div>    
        </nav>';

        return $menu;
    }

    /**
     * Получаем активность элементов меню, по совпадению id контроллера с урлом
     * Активность табов по массивам урлов проверяет другой метод
     *
     * @return void
     */
    private static function getActiveNav()
    {
        /** Получаем id (название) экшена, где сейчас находимся */
        $activeAction = Yii::$app->controller->action->id;

        /** В свиче смотрим - какой экшен, чтобы засетапить active класс активному элементу меню */
        switch ($activeAction) {
            case 'keys': self::$keys = 'class="active"'; break;
            case 'doorkeysdetail': self::$detaikey = 'class="active"'; break;
            case 'newsdetail': self::$newsdetail = "active"; break;
            case 'category': self::$lootcat = 'class="active"'; break;
            case 'detailloot': self::$mainloot = 'class="active"'; break;
            case 'mainloot': self::$loot = 'class="active"'; break;
            case 'skillsdetail': self::$skillsdetail = 'active'; break;
            case 'questloot': self::$questloot = 'class="active"'; break;
            case 'boss-list': self::$bosses = 'class="active"'; break;
            case 'view': self::$view = 'class="active"'; break;
            case 'item': self::$item = 'class="active"'; break;
            case 'list': self::$list = 'class="active"'; break;
        }
    }

    /**
     * Функция, которая возвращает иконку включения темной или светлой темы сайта, в зависимости
     * от наличия определенной куки
     *
     * @return string
     */
    private static function themeToggler(): string
    {
        /** Переменная с доступом до кукисов */
        $cookies = Yii::$app->request->cookies;

        /** Если есть кука - dark_theme */
        if (isset($cookies[CookieComponent::NAME_DARK_THEME])) {

            /** Отображаем иконку включить светлую тему сайта */
            return '<i class="fa fa-2x fa-sun-o js-change-site-style" title="Включить светлую тему сайта"></i>';
        }

        /** Если кука отсутствует - показываем иконку - включить темную тему сайта */
        return '<i class="fa fa-2x fa-moon-o js-change-site-style" title="Включить темную тему сайта"></i>';
    }

    /**
     * Строка с иконкой и ссылкой на форму обратной связи в верхней части страницы
     *
     * @return string
     */
    private static function feedBackform(): string
    {
        /** Возвращаем строку со ссылкой на форму обратной связи на рендер */
        return '<a href="' . Url::to(FeedbackController::getUrlRoute(FeedbackController::ACTION_INDEX)) . '"><i class="fa fa-2x fa-envelope js-feedback-form" title="Форма обратной связи"></i></a>';
    }

    /**
     * Если текущий урл совпадает с одним из тех, что прилетают в массиве в виде параметра
     * Тогда вернет строку active, иначе - null
     *
     * @param array $url_array - массив URL адресов для проверки
     *
     * @return string|null
     * @throws InvalidConfigException
     */
    private static function checkActiveTabByUrlArray(array $url_array)
    {
        /** Переменная для return'a */
        $result = null;

        /** Проверяем текущий урл на вхождение в список урлов, что пришли в виде параметра */
        if (in_array(Yii::$app->request->getUrl(), $url_array)) {

            /** Сетапим результирующую строку - active */
            $result = 'active';
        }

        /** Возвращаем результат в виде строки или null */
        return $result;
    }

    /**
     * Метод сетапит активность табов, если url совпадает с одним из методов вложенных урлов
     * Такие формируются с помощью массивов урлов
     *
     * @return void
     * @throws InvalidConfigException
     */
    private static function getActiveNavByUrlArray()
    {
        /** Получаем активность меню для раздела - интерактивные карты локаций */
        self::$intermaps = self::checkActiveTabByUrlArray(MenuUrlsComponent::getMapsUrlArray());

        /** Получаем активность меню для раздела - умения персонажа */
        self::$skills = self::checkActiveTabByUrlArray(MenuUrlsComponent::getSkillsUrlArray());

        /** Получаем активность меню для раздела - торговцы и квесты */
        self::$pagequests = self::checkActiveTabByUrlArray(MenuUrlsComponent::getTradersUrlArray());

        /** Получаем активность меню для раздела - прочее */
        self::$other = self::checkActiveTabByUrlArray(MenuUrlsComponent::getOtherUlrArray());
    }
}