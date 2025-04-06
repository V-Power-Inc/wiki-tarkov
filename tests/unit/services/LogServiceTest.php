<?php

namespace app\tests;

use app\common\interfaces\ResponseStatusInterface;
use app\common\services\LogService;
use app\models\ErrorLog;
use Codeception\Test\Unit;
use tests\_support\FixturesCollection;
use UnitTester;
use yii\db\Exception;

/**
 * Тестируем сервис по сохранению лога ошибок в БД
 *
 * Class LogServiceTest
 * @package app\tests
 */
class LogServiceTest extends Unit
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
        $this->tester->haveFixtures(FixturesCollection::getErrors());
    }

    /**
     * Тестирование метода по сохранению ошибок в БД
     *
     * @return void
     *
     * @throws Exception
     */
    public function testSaveErrorData()
    {
        /** Тестовые данные */
        $url = '/example-url';
        $type = 'test';
        $description = 'This is a test error description';
        $errorCode = ResponseStatusInterface::SERVER_ERROR_CODE;

        /** Дергаем тестируемый метод */
        $result = LogService::saveErrorData($url, $type, $description, $errorCode, false, false);

        /** Проверяем, что метод вернул true (т.е. данные успешно сохранены) */
        $this->assertTrue($result);

        /** Проверяем, что данные были сохранены в базу данных */
        $errorLog = ErrorLog::findOne(['url' => $_ENV['DOMAIN_PROTOCOL'] . $_ENV['DOMAIN'] . $url, 'type' => $type, 'description' => $description, 'error_code' => $errorCode]);

        /** Проверяем что результат не является null */
        $this->assertNotNull($errorLog);
    }
}