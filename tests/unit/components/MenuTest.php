<?php
/**
 * Created by PhpStorm.
 * User: PC_Principal
 * Date: 19.03.2024
 * Time: 10:30
 */

namespace app\tests;

use app\components\CookieComponent;
use app\components\MenuComponent;
use app\controllers\MapsController;
use Codeception\Test\Unit;
use ReflectionException;
use ReflectionClass;
use yii\base\Action;
use yii\base\InvalidConfigException;
use Yii;
use yii\web\Controller;
use yii\web\Cookie;
use yii\web\CookieCollection;
use yii\web\Request;

/**
 * Тестирование компонента горизонтального меню
 *
 * Class MenuTest
 * @package app\tests\components
 */
class MenuTest extends Unit
{
    /** Мок с кукисами */
    protected $cookies;

    /** Мок класса Request */
    protected $request;

    /** Мок контроллера - MapsController */
    protected $controller;

    /**
     * Действия выполняемые перед каждым тестом
     *
     * @return void
     * @throws InvalidConfigException
     */
    protected function _before()
    {
        /** Настоящая коллекция кук (по умолчанию с кукой тёмной темы) - мокать простой контейнер незачем */
        $this->cookies = $this->makeCookies(true);

        /** Создаем заглушку для объекта $request */
        $this->request = $this->getMockBuilder(Request::class)
            // Только эти методы: магический __get() должен остаться настоящим, иначе ->cookies вернёт null
            ->onlyMethods(['getCookies', 'getUrl'])
            ->disableOriginalConstructor()
            ->getMock();

        /** Устанавливаем поведение заглушки */
        $this->request->expects($this->any())
            ->method('getCookies')
            ->willReturnCallback(fn() => $this->cookies); // Через колбэк, чтобы тест мог подменить коллекцию

        $this->request->expects($this->any())
            ->method('getUrl')
            ->willReturn('/maps'); // Устанавливаем значение URL

        /** Создаем заглушку для объекта Request */
        Yii::$app->set('request', $this->request);

        /** Создаем заглушку контроллера */
        $controllerMock = $this->getMockBuilder(Controller::class)
            ->disableOriginalConstructor()
            ->getMock();

        /** Устанавливаем свойство экшена */
        $controllerMock->action = new Action(MapsController::ACTION_LOCATIONS, $controllerMock);

        /** Сетапим финальный мок в переменную */
        $this->controller = $controllerMock;

        /** Устанавливаем мок контроллера в переменную APP приложения */
        Yii::$app->controller = $controllerMock;
    }

    /**
     * Публичный метод, который дергаем чтобы зарендерить меню
     *
     * @return void
     * @throws InvalidConfigException
     */
    public function testShowMenu()
    {
        $menu = MenuComponent::showMenu();
        $this->assertIsString($menu);
    }

    /**
     * Приватный метод, который определяет по наличию кукиса, какой HTML вернуть
     *
     * @return void
     * @throws ReflectionException
     */
    public function testThemeToggler()
    {
        $method = (new ReflectionClass(MenuComponent::class))->getMethod('themeToggler');
        $method->setAccessible(true);

        /** Кука тёмной темы есть - показываем иконку "включить светлую тему" */
        $this->cookies = $this->makeCookies(true);
        $this->assertStringContainsString('fa-sun-o', $method->invoke(null));

        /** Куки нет - показываем иконку "включить тёмную тему" */
        $this->cookies = $this->makeCookies(false);
        $this->assertStringContainsString('fa-moon-o', $method->invoke(null));
    }

    /**
     * Создаёт коллекцию кук с кукой тёмной темы или без неё
     *
     * @param bool $withDarkTheme
     * @return CookieCollection
     */
    private function makeCookies(bool $withDarkTheme): CookieCollection
    {
        $cookies = [];
        if ($withDarkTheme) {
            $cookies[CookieComponent::NAME_DARK_THEME] = new Cookie(['name' => CookieComponent::NAME_DARK_THEME, 'value' => 1]);
        }

        return new CookieCollection($cookies, ['readOnly' => true]);
    }

    /**
     * Приватный метод, рендерит иконку формы обратной связи
     *
     * @return void
     * @throws ReflectionException
     */
    public function testFeedBackform()
    {
        $reflection = new ReflectionClass(MenuComponent::class);
        $method = $reflection->getMethod('feedBackform');
        $method->setAccessible(true);
        $feedbackForm = $method->invoke(null);
        $this->assertIsString($feedbackForm);
    }

    /**
     * Приватный метод, определяет вернуть активность вкладки или нет
     *
     * @return void
     * @throws ReflectionException
     */
    public function testCheckActiveTabByUrlArray()
    {
        $menuComponent = new MenuComponent();

        /** Вызываем приватный метод checkActiveTabByUrlArray() и передаем ему массив
         * для проверки и убеждаемся, что он возвращает null
         */
        $result = $this->invokeMethod($menuComponent, 'checkActiveTabByUrlArray', [['url1', 'url2']]);
        $this->assertNull($result); // Проверяем, что метод возвращает null

        /** Передаем в метод URL, который совпадает с одним из элементов массива */
        $result = $this->invokeMethod($menuComponent, 'checkActiveTabByUrlArray', [['/maps']]);
        $this->assertIsString($result); // Проверяем, что метод возвращает строку, т.к. урл совпадает
    }

    /**
     * Метод дли вывозова приватных методов класса через рефлексию и последующую передачу параметров
     *
     * @param $object - Экземпляр класса
     * @param $methodName - Название методы
     * @param array $parameters - Параметры для передачи в метод
     * @return mixed
     * @throws ReflectionException
     */
    private function invokeMethod($object, $methodName, array $parameters = [])
    {
        $reflection = new ReflectionClass(get_class($object));
        $method = $reflection->getMethod($methodName);
        $method->setAccessible(true);
        return $method->invokeArgs($object, $parameters);
    }
}