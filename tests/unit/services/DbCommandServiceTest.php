<?php
/**
 * Created by PhpStorm.
 * User: PC_Principal
 * Date: 21.03.2024
 * Time: 15:21
 */

namespace app\tests;

use app\common\services\DbCommandService;
use yii\db\Query;
use yii\db\Command;
use Codeception\Test\Unit;
use yii\db\Exception as DbException;

/**
 * Тест сервиса по DB командам
 *
 * Class DbCommandServiceTest
 * @package app\common\services
 */
class DbCommandServiceTest extends Unit
{
    /**
     * Тестируем метод сервиса для генерации SQL комманд через createCommand Yii
     *
     * @return void
     * @throws DbException
     */
    public function testCreateCommandQueryAll()
    {
        /** Подготавливаем мок объекта Query */
        $query = $this->getMockBuilder(Query::class)
            ->setMethods(['createCommand'])
            ->getMock();

        /** Подготавливаем мок объекта Command */
        $command = $this->getMockBuilder(Command::class)
            ->setMethods(['queryAll'])
            ->disableOriginalConstructor()
            ->getMock();

        /** Устанавливаем ожидаемое значение для метода queryAll */
        $expectedResult = [['id' => 1, 'name' => 'John'], ['id' => 2, 'name' => 'Jane']];
        $command->method('queryAll')->willReturn($expectedResult);

        /** Устанавливаем ожидаемое значение для метода createCommand */
        $query->expects($this->once())
            ->method('createCommand')
            ->willReturn($command);

        /** Вызываем тестируемый метод */
        $result = DbCommandService::createCommandQueryAll($query);

        /** Проверяем, что возвращенный результат соответствует ожидаемому */
        $this->assertEquals($expectedResult, $result);
    }
}