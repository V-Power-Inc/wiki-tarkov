<?php
/**
 * Created by PhpStorm.
 * User: PC_Principal
 * Date: 21.03.2024
 * Time: 14:14
 */

namespace app\tests\services;

use app\common\services\ArrayService;
use Codeception\Test\Unit;
use yii\base\InvalidConfigException;
use yii\web\Request;
use Yii;

/**
 * Тестирование сервиса по работе с массивами
 *
 * Class ArrayServiceTest
 * @package app\tests\services
 */
class ArrayServiceTest extends Unit
{
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
        /** Создаем заглушку для объекта $request */
        $this->request = $this->getMockBuilder(Request::class)
            ->disableOriginalConstructor()
            ->getMock();

        $this->request->expects($this->any())
            ->method('getUrl')
            ->willReturn('/some_url_with_boss'); // Устанавливаем значение URL

        /** Создаем заглушку для объекта Request */
        Yii::$app->set('request', $this->request);
    }

    /**
     * Проверяем, корректно ли посчитает метод количество свиты у босса
     *
     * @return void
     * @throws InvalidConfigException
     */
    public function testGetAmountEscorts()
    {
        /** Подготавливаем входные данные для теста */
        $detachment = [
            [
                [['count' => 2]],
                [['count' => 3]]
            ],
            [
                [['count' => 4]],
                [['count' => 5]]
            ]
        ];

        /** Вызываем тестируемый метод */
        $result = ArrayService::getAmountEscorts($detachment);

        /** Проверяем ожидаемый результат - должно быть 14 */
        $this->assertEquals(14, $result);

        /** Прокидываем некорректный массив */
        $wrong_array = [
            [
                'test' => 4
            ],
            [
                'test2' => 5
            ]
        ];

        /** Вызываем тестируемый метод */
        $result = ArrayService::getAmountEscorts($wrong_array);

        /** Проверяем ожидаемый результат - при некорректном массиве должен быть 0 */
        $this->assertEquals(0, $result);

        /** Прокидываем еще некорректный массив */
        $wrong_array_second = ['id' => 333];

        /** Вызываем тестируемый метод */
        $result = ArrayService::getAmountEscorts($wrong_array_second);

        /** Проверяем ожидаемый результат - при некорректном массиве должен быть 0 */
        $this->assertEquals(0, $result);
    }

    /**
     * Массив с известными URL адресами карт локаций для боссов
     * Проверяем идентичность
     *
     * @return void
     */
    public function testExistingMapNames()
    {
        /** Вызываем тестируемый метод */
        $result = ArrayService::existingMapNames();

        /** Ожидаемый массив с известными URL адресами карт локаций для боссов */
        $expected = [
            'tamojnya',
            'zavod',
            'razvyazka',
            'lighthouse',
            'night-zavod',
            'rezerv',
            'bereg',
            'terragroup-laboratory',
            'forest',
            'streets-of-tarkov'
        ];

        /** Проверяем, что возвращенный массив совпадает с ожидаемым */
        $this->assertEquals($expected, $result);
    }
}