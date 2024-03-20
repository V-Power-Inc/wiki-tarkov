<?php
/**
 * Created by PhpStorm.
 * User: PC_Principal
 * Date: 20.03.2024
 * Time: 13:03
 */

namespace app\tests\components;

use app\components\CookieComponent;
use app\components\LeftmenuWidget;
use app\models\Category;
use Codeception\Test\Unit;
use tests\_support\FixturesCollection;
use UnitTester;
use yii\base\InvalidConfigException;
use yii\web\CookieCollection;
use yii\web\Request;
use yii\web\Cookie;
use ReflectionMethod;
use Yii;

/**
 * Тестирование виджета для вывода левого меню сайта
 *
 * Class LeftMenuTest
 * @package app\tests\components
 */
class LeftMenuTest extends Unit
{
    /** @var UnitTester - Объект класса для тестирования */
    protected UnitTester $tester;

    /** Мок класса Request */
    protected $request;

    /**
     * Действия выполняемые перед каждым тестом
     *
     * @return void
     * @throws InvalidConfigException
     */
    protected function _before()
    {
        /** Грузим фикстуры перед каждым тестом */
        $this->tester->haveFixtures(FixturesCollection::getCategory());

        /** Создаем заглушку для объекта $request */
        $this->request = $this->getMockBuilder(Request::class)
            ->getMock();

        /** Подставляем правильный URL */
        $this->request->expects($this->any())
            ->method('getUrl')
            ->willReturn('/loot');

        /** Создаем заглушку коллекций кукисов */
        $cookieCollection = new CookieCollection([
            new Cookie([
                'name' => CookieComponent::NAME_OVERLAY,
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
     * Тестируем сетап поведения виджета
     *
     * @return void
     */
    public function testBehaviors()
    {
        $widget = new LeftmenuWidget();
        $behaviors = $widget->behaviors();

        /** Проверяем что конфиг поведения является массивом и настроен должным образом */
        $this->assertIsArray($behaviors);
        $this->assertArrayHasKey('class', $behaviors[0]);
        $this->assertArrayHasKey('duration', $behaviors[0]);
        $this->assertArrayHasKey('dependency', $behaviors[0]);
        $this->assertArrayHasKey('variations', $behaviors[0]);
    }

    /**
     * Тестируем инициализацию виджета
     *
     * @return void
     */
    public function testInit()
    {
        /** Инициализируем метод и ожидаем что его свойство будет равно определенной строке (Имя файла шаблона) */
        $widget = new LeftmenuWidget();
        $widget->init();
        $this->assertEquals('leftmenu.php', $widget->tpl);
    }

    /**
     * Тестируем запуск виджета, как во вьюхе
     *
     * @return void
     */
    public function testRun()
    {
        /** Создаем виджет */
        $widget = new LeftmenuWidget();

        /** Вызываем метод run() */
        $result = $widget->run();

        /** Проверяем, что результат не пустой */
        $this->assertNotEmpty($result);

        /** Ожидаем увидеть строку */
        $this->assertIsString($result);

        /** Проверяем что PHP файл шаблона вернулся в виде строки */
        $this->assertStringContainsString('<!-- 1 level -->', $result);
    }

    /**
     * Тестирование метода getTree()
     */
    public function testGetTree()
    {
        /** Создаем виджет */
        $widget = new LeftmenuWidget();

        /** Устанавливаем виртуальные данные для виджета */
        $widget->data = Category::find()->asArray()->all();

        /** Создаем объект ReflectionMethod для приватного метода getTree(), делаем метод доступным */
        $reflectionMethod = new ReflectionMethod(LeftmenuWidget::class, 'getTree');
        $reflectionMethod->setAccessible(true);

        /** Вызываем метод getTree() */
        $result = $reflectionMethod->invoke($widget);

        /** Проверяем, что результат не пустой */
        $this->assertNotEmpty($result);

        /** Ожидаем что это массив */
        $this->assertIsArray($result);
    }

    /**
     * Тестирование метода getMenuHtml()
     */
    public function testGetMenuHtml()
    {
        /** Создаем виджет */
        $widget = new LeftmenuWidget();

        /** Устанавливаем виртуальные данные для виджета */
        $widget->data = Category::find()
            ->where([Category::ATTR_ENABLED => Category::TRUE])
            ->indexBy(Category::ATTR_ID)
            ->orderby([Category::ATTR_SORTIR => SORT_ASC])
            ->asArray()
            ->all();

        /** Создаем объект ReflectionMethod для приватного метода и делаем метод доступным */
        $reflectionMethod = new ReflectionMethod(LeftmenuWidget::class, 'getMenuHtml');
        $reflectionMethod->setAccessible(true);

        /** Создаем тестовое дерево категорий */
        $tree = Category::find()->asArray()->all();

        /** Вызываем приватный метод */
        $result = $reflectionMethod->invoke($widget, $tree);

        /** Проверяем, что результат не пустой */
        $this->assertNotEmpty($result);
        // Здесь также можно добавить другие проверки на ожидаемую структуру HTML
    }

    /**
     * Тестирование метода catToTemplate()
     */
    public function testCatToTemplate()
    {
        /** Создаем виджет */
        $widget = new LeftmenuWidget();

        /** Создаем объект ReflectionMethod для приватного метода и делаем метод доступным*/
        $reflectionMethod = new ReflectionMethod(LeftmenuWidget::class, 'catToTemplate');
        $reflectionMethod->setAccessible(true);

        /** Дергаем метод инициализации - чтобы просетапить название файла с менюшкой */
        $widget->init();

        /** Дергаем метод, передавая ему в качестве примера массив категории (Единичной) */
        $result = $reflectionMethod->invoke($widget, [
            'id' => 1,
            'title' => 'Основная категория',
            'parent_category' => null,
            'url' => 'main-category',
            'content' => '<p>Описание новой основной категории</p>',
            'description' => 'Seo описание новой основной категории',
            'keywords' => 'Основная категория, лут, тесты',
            'enabled' => 1,
            'sortir' => 1
        ]);

        /** Проверяем, что результат не пустой */
        $this->assertNotEmpty($result);

        /** Ожидаем увидеть строку */
        $this->assertIsString($result);

        /** Проверяем что PHP файл шаблона вернулся в виде строки */
        $this->assertStringContainsString('<!-- 1 level -->', $result);
    }
}