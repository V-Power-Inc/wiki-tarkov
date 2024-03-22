<?php
/**
 * Created by PhpStorm.
 * User: PC_Principal
 * Date: 22.03.2024
 * Time: 8:55
 */

namespace app\tests\services;

use Codeception\Test\Unit;
use tests\_support\FixturesCollection;
use UnitTester;

/**
 * Тестируем сервис по работе с маркерами интерактивных карт
 *
 * Class MarkersServiceTest
 * @package app\common\services
 */
class MarkersServiceTest extends Unit
{
    /** @var UnitTester - Объект класса для тестирования */
    protected UnitTester $tester;

    /**
     * Действия выполняемые перед каждым тестом
     *
     * @return void
     */
    public function _before()
    {
        /** Грузим фикстуры перед каждым тестом */
        $this->tester->haveFixtures(FixturesCollection::getMaps());
    }

    /**
     * Тестируем метод по получению маркеров локаций
     *
     * @return void
     */
    public function testTakeMarkers()
    {
        /** Переменная для передачи в метод */
        $map_title = 'Завод';

        /** Дергаем переменную */
        $markers = MarkersService::takeMarkers($map_title);

        /** Ожидаем увидеть строку */
        $this->assertIsString($markers);

        /** Название локации не из свича */
        $wrong_title = 'SomeMap';

        /** Дергаем переменную */
        $markers = MarkersService::takeMarkers($wrong_title);

        /** Ожидаем увидеть строку */
        $this->assertIsString($markers);

        /** Строка эквивалентна синтаксису пустого массива */
        $this->assertEquals('[]' ,$markers);
    }
}