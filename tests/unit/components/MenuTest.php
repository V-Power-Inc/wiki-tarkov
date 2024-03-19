<?php
/**
 * Created by PhpStorm.
 * User: PC_Principal
 * Date: 19.03.2024
 * Time: 10:30
 */

namespace app\tests\components;

use app\components\CookieComponent;
use app\components\MenuComponent;
use app\controllers\MapsController;
use Codeception\Test\Unit;
use ReflectionException;
use ReflectionClass;
use yii\base\InvalidConfigException;
use Yii;
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
        /** Родительский конструктор */
        parent::_before();

        /** Создаем заглушку для объекта $cookies */
        $this->cookies = $this->getMockBuilder(CookieCollection::class)
            ->disableOriginalConstructor()
            ->getMock();

        /** Устанавливаем поведение заглушки */
        $this->cookies->expects($this->any())
            ->method('getValue')
            ->with([CookieComponent::NAME_DARK_THEME])
            ->willReturn(true);

        /** Создаем заглушку для объекта $request */
        $this->request = $this->getMockBuilder(Request::class)
            ->disableOriginalConstructor()
            ->getMock();

        /** Устанавливаем поведение заглушки */
        $this->request->expects($this->any())
            ->method('getCookies')
            ->willReturn($this->cookies);

        $this->request->expects($this->any())
            ->method('getUrl')
            ->willReturn('/maps'); // Устанавливаем значение URL

        /** Создаем заглушку для объекта Request */
        Yii::$app->set('request', $this->request);

        /** Создаем заглушку контроллера */
        $controllerMock = $this->getMockBuilder(MapsController::class)
            ->disableOriginalConstructor()
            ->getMock();

        /** Устанавливаем свойство экшена */
        $controllerMock->action = MapsController::ACTION_LOCATIONS;

        /** Сетапим финальный мок в переменную */
        $this->controller = $controllerMock;

        /** Устанавливаем мок контроллера в переменную APP приложения */
        Yii::$app->controller = $controllerMock;
    }

    /**
     * Публичный метод, который дергаем чтобы зарендерить меню
     *
     * @return void
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
        $reflection = new ReflectionClass(MenuComponent::class);
        $method = $reflection->getMethod('themeToggler');
        $method->setAccessible(true);
        $toggler = $method->invoke(null);

        /** Проверяем что с наличие кукиса вернет строку */
        $this->assertIsString($toggler);

        /** Устанавливаем поведение заглушки */
        $this->cookies->expects($this->any())
            ->method('getValue')
            ->with([])
            ->willReturn(true);

        /** Устанавливаем поведение заглушки */
        $this->request->expects($this->any())
            ->method('getCookies')
            ->willReturn($this->cookies);

        /** Создаем заглушку для объекта Request */
        Yii::$app->set('request', $this->request);

        /** Проверяем что с без наличия кукиса вернет строку */
        $this->assertIsString($toggler);
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