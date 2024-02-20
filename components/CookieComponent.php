<?php
/**
 * Created by PhpStorm.
 * User: PC_Principal
 * Date: 21.02.2024
 * Time: 0:26
 */

namespace app\components;

use Yii;
use yii\web\Cookie;

/**
 * Компонент для работы с кукисами
 *
 * Class CookieComponent
 * @package app\components
 */
class CookieComponent
{
    /** @var string - Название светлой темы сайта */
    const NAME_LIGHT_THEME = 'light-theme';

    /** @var string - Константа, название кукиса, который активирует темную тему на сайте */
    const NAME_DARK_THEME = 'dark_theme';

    /** @var string - Константа, название кукиса, который скрывает рекламный блок - оверлей */
    const NAME_OVERLAY = 'overlay';

    /** @var bool - Переменная для возвратов, в методах, что сетапят кукисы */
    const RESULT = true;

    /**
     * Метод сетапит кукис, который скрывает пользователю рекламный блок оверлей на 6 часов
     * time() + (60 * 60 * 24) - 1 день
     * time() + (60 * 60 * 6) - 6 часов
     *
     * @return bool
     */
    public static function setOverlay(): bool
    {
        /** Создаем кукис оверлея и задаем срок истечения 6 часов, в течении этого времени блок overlay будет скрыт у посетителя */
        Yii::$app->response->cookies->add(new Cookie([
            'name' => 'overlay',
            'value' => 1,
            'expire' => time() + (60 * 60 * 6),
        ]));

        /** Возвращаем bool результат - true */
        return static::RESULT;
    }

    /**
     * Сетапим кукис темной темы на сайте
     * time() + 3600 * 24 * 365 - 1 год, срок жизни куки
     *
     * @return bool
     */
    public static function setDarkTheme(): bool
    {
        /** Сетапим кукис на 1 год */
        Yii::$app->response->cookies->add(new Cookie([
            'name' => 'dark_theme',
            'value' => 1,
            'expire' => time() + 3600 * 24 * 365
        ]));

        /** Возвращаем bool результат - true */
        return static::RESULT;
    }
}