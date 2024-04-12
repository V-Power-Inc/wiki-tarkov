<?php
/**
 * Created by PhpStorm.
 * User: PC_Principal
 * Date: 09.04.2024
 * Time: 18:39
 */

namespace app\tests;

use app\common\interfaces\ApiQueryInterface;
use app\common\services\ApiQueries;
use app\common\services\ApiService;
use app\common\interfaces\ApiInterface;
use app\common\models\tasks\db\TaskModel;
use app\common\services\JsondataService;
use app\models\Bosses;
use Codeception\Test\Unit;
use tests\_support\FixturesCollection;
use yii\helpers\Json;
use UnitTester;
use ReflectionClass;

/**
 * Тестирование отработки методов API tarkov.dev
 *
 * Class ApiServiceTest
 * @package app\tests
 */
class ApiServiceTest extends Unit
{
    /** @var UnitTester - Объект класса для тестирования */
    protected $tester;

    /**
     * Действия выполняемые перед каждым тестом
     *
     * @return void
     */
    public function _before()
    {
        /** Грузим фикстуры перед каждым тестом */
        $this->tester->haveFixtures(FixturesCollection::getBosses());
    }

    /** Тестируем получение данных о боссах - с использованием параметра карты и без */
    public function testGetBosses()
    {
        /** Мокируем вызов Query запроса (Там обычно API но мы локально тестируем) */
        $apiQueryBuilderMock = $this->makeEmpty(ApiQueryInterface::class, [
            'setBossesQuery' => '{bosses{map name}}'
        ]);

        /** Передаем в объект сервиса ApiQuery */
        $apiService = new ApiService($apiQueryBuilderMock);

        /** Через reflection делаем приватный метод доступным */
        $reflection = new \ReflectionClass(ApiService::class);
        $method = $reflection->getMethod('getApiData');
        $method->setAccessible(true);

        /** Дергаем метод получения данных о боссах */
        $result = $apiService->getBosses();

        /** Ожидаем что без параметров он совпадет с результатов метода - из AR модели (У нас фикстуры) */
        $this->assertEquals(Bosses::getMapData(), $result);

        /** Дергаем метод получения данных о боссах с параметрами */
        $resultWithMap = $apiService->getBosses('Customs');

        /** Ожидаем что вернутся результат обработки из другого сервиса, с декодированием из Json */
        $this->assertEquals(JsondataService::getBossData('Customs'), $resultWithMap);
    }


    // TODO: Далее будет тестить этот метод - isOldBosses

}