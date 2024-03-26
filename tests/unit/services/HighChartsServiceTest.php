<?php
/**
 * Created by PhpStorm.
 * User: PC_Principal
 * Date: 22.03.2024
 * Time: 9:31
 */

namespace app\tests;

use app\components\CookieComponent;
use app\common\services\HighChartsService;
use Codeception\Test\Unit;
use Yii;
use yii\base\InvalidConfigException;
use yii\web\Cookie;
use yii\web\CookieCollection;
use yii\web\Request;

/**
 * Тестируем сервис, что в зависимости от кукиса, меняет цветовую тему графиков и текста цен
 *
 * Class HighChartsServiceTest
 * @package app\tests\services
 */
class HighChartsServiceTest extends Unit
{
    /**
     * Действия выполняемые перед каждым тестом
     *
     * @return void
     * @throws InvalidConfigException
     */
    protected function _before()
    {
        /** Создаем заглушку для объекта $request */
        $this->request = $this->getMockBuilder(Request::class)
            ->getMock();

        /** Создаем заглушку коллекций кукисов */
        $cookieCollection = new CookieCollection([
            CookieComponent::NAME_DARK_THEME => new Cookie([
                'name' => CookieComponent::NAME_DARK_THEME,
                'value' => 1
            ])
        ]);

        /** Через магический метод указываем что должно вернуть свойство cookies */
        $this->request->method('__get')->willReturnMap([
            ['cookies', $cookieCollection]
        ]);

        /** Создаем заглушку для объекта Request */
        Yii::$app->set('request', $this->request);
    }

    /**
     * Тестируем работу метода бэкграунда, когда кукис засетаплен
     *
     * @return void
     */
    public function testGetBackgroundByThemeDarkThemeEnabled()
    {
        /** Дергаем метод */
        $backgroundColor = HighChartsService::getBackgroundByTheme();

        /** Проверяем эквивалентность результата */
        $this->assertEquals('#363535', $backgroundColor);
    }

    /**
     * Тестируем работу метода бэкграунда, когда кукис не засетаплен
     *
     * @return void
     */
    public function testGetBackgroundByThemeDarkThemeDisabled()
    {
        /** Удаляем кукис */
        unset(Yii::$app->request->cookies[CookieComponent::NAME_DARK_THEME]);

        /** Дергаем метод */
        $backgroundColor = HighChartsService::getBackgroundByTheme();

        /** Проверяем эквивалентность результата */
        $this->assertEquals('#fff', $backgroundColor);
    }

    /**
     * Тестируем работу метода увета текста, когда кукис засетаплен
     *
     * @return void
     */
    public function testGetTextByThemeDarkThemeEnabled()
    {
        /** Дергаем метод */
        $textColor = HighChartsService::getTextByTheme();

        /** Проверяем эквивалентность результата */
        $this->assertEquals('#c4c4c4', $textColor);
    }

    /**
     * Тестируем работу метода увета текста, когда кукис не засетаплен
     *
     * @return void
     */
    public function testGetTextByThemeDarkThemeDisabled()
    {
        /** Удаляем кукис */
        unset(Yii::$app->request->cookies[CookieComponent::NAME_DARK_THEME]);

        /** Дергаем метод */
        $textColor = HighChartsService::getTextByTheme();

        /** Проверяем эквивалентность результата */
        $this->assertEquals('#333333', $textColor);
    }
}