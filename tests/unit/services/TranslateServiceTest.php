<?php
/**
 * Created by PhpStorm.
 * User: PC_Principal
 * Date: 21.03.2024
 * Time: 21:29
 */

namespace app\common\services;

use Codeception\Test\Unit;
use yii\base\InvalidConfigException;
use yii\web\Request;
use Yii;

/**
 * Тестирование сервиса по переводу различных атрибутов
 *
 * Class TranslateServiceTest
 * @package app\common\services
 */
class TranslateServiceTest extends Unit
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
     * Проверка методя для формирования URL'a для локации
     *
     * @return void
     * @throws InvalidConfigException
     */
    public function testMapUrlCreator()
    {
        /** Урл для теста */
        $map = 'Таможня';

        /** Переменная с результатом */
        $result = TranslateService::mapUrlCreator($map);

        /** Должен вернуться урл соответствующий ключу */
        $this->assertEquals('tamojnya', $result);

        /** Переменная с результатом не из массива */
        $wrong_map = 'some_wrong';

        /** Переменная с результатом */
        $result = TranslateService::mapUrlCreator($wrong_map);

        /** Должна вернуться пустая строка */
        $this->assertEquals('', $result);
    }

    /**
     * Тестируем метод определения фракции по названию босса
     *
     * @return void
     */
    public function testBossesFactions()
    {
        /** Перменная для теста */
        $bossName = 'Зрячий';

        /** Дергаем метод проверки проверки фракции боссов */
        $result = TranslateService::bossesFactions($bossName);

        /** В данном случае должен вернуть такой результат */
        $this->assertEquals('Сектанты', $result);

        /** Рандомное значение не из массива */
        $wrong_boss = 'Undefined';

        /** Дергаем метод проверки проверки фракции боссов */
        $result = TranslateService::bossesFactions($wrong_boss);

        /** Если ключ не из массива, должен вернуть такую строку */
        $this->assertEquals('Дикие', $result);
    }

    /**
     * Тестируем метод, что может вернуть расширенное описание в случаях с некоторыми боссами
     *
     * @return void
     */
    public function testBossesAlertInfo()
    {
        /** Босс из проверки свич */
        $bossName = 'Death Knight';

        /** Дергаем метод */
        $result = TranslateService::bossesAlertInfo($bossName);

        /** Ожидаем получить строку */
        $this->assertIsString($result);

        /** Рандомная строка */
        $wrong_boss = 'Undefined';

        /** Дергаем метод */
        $result = TranslateService::bossesAlertInfo($wrong_boss);

        /** Ожидаем получить строку */
        $this->assertIsString($result);
    }

    /**
     * Тестируем метод, что должен возвращать описание торговцев из EFT
     *
     * @return void
     */
    public function testGetTraderQuestDesc()
    {
        /** Торговец из массива */
        $trader = 'Егерь';

        /** Дергаем метод */
        $result = TranslateService::getTraderQuestDesc($trader);

        /** Ожидаем получить строку */
        $this->assertIsString($result);

        /** Переменная с рандомной строкой */
        $WrongTrader = 'RandomString';

        /** Дергаем метод */
        $result = TranslateService::getTraderQuestDesc($WrongTrader);

        /** Ожидаем получить строку */
        $this->assertIsString($result);
    }

    /**
     * Тестируем метод, что по ключу - вернет перевод фракции
     *
     * @return void
     * @throws InvalidConfigException
     */
    public function testGetQuestFaction()
    {
        /** Переменная с названием фракции */
        $faction = 'BEAR';

        /** Результат перевода */
        $result = TranslateService::getQuestFaction($faction);

        /** Проверяем эквивалентность результата */
        $this->assertEquals('Bear', $result);

        /** Переменная с названием фракции не из списка */
        $factionWrong = 'NewFaction';

        /** Результат перевода */
        $result = TranslateService::getQuestFaction($factionWrong);

        /** Проверяем эквивалентность результата - должна вернуться запись в необработанном виде */
        $this->assertEquals($factionWrong, $result);
    }

    /**
     * Тестируем метод что по ключу вернет необходимое состояние квеста
     *
     * @return void
     * @throws InvalidConfigException
     */
    public function testGetTaskStatus()
    {
        /** Сетапим существующий статус */
        $status = 'active';

        /** Вызываем метод */
        $result = TranslateService::getTaskStatus($status);

        /** Проверяем результат */
        $this->assertEquals('в процессе выполнения', $result);

        /** Некорректный статус */
        $wrongStatus = 'SomeStatus';

        /** Вызываем метод */
        $result = TranslateService::getTaskStatus($wrongStatus);

        /** Проверяем результат - должен вернуться необработанным */
        $this->assertEquals($wrongStatus, $result);
    }
}