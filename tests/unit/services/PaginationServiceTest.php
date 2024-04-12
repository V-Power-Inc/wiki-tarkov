<?php
/**
 * Created by PhpStorm.
 * User: PC_Principal
 * Date: 22.03.2024
 * Time: 20:11
 */

namespace app\tests;

use app\common\services\PaginationService;
use app\models\ApiLoot;
use app\models\Articles;
use app\models\Items;
use app\models\News;
use app\models\Questions;
use Codeception\Test\Unit;
use tests\_support\FixturesCollection;
use yii\data\Pagination;
use UnitTester;

/**
 * Тестируем сервис пагинации
 *
 * Class PaginationServiceTest
 * @package app\tests
 */
class PaginationServiceTest extends Unit
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
        $this->tester->haveFixtures(FixturesCollection::getCrudOnly());
    }

    /**
     * Тестируем конструктор сервиса пагинации - без кеша
     *
     * @return void
     */
    public function testConstructorWithoutCache()
    {
        /** Запрос для получения предметов из таблицы Items - 2 предмета */
        $queryItems = Items::find()->where([Items::ATTR_ACTIVE => Items::TRUE]);

        /** Инициализируем конструктор */
        $paginationService = new PaginationService($queryItems, 10, false);

        /** Проверки ожиданий по проверкам работы функционала */
        $this->assertInstanceOf(PaginationService::class, $paginationService);
        $this->assertInstanceOf(Pagination::class, $paginationService->paginator);
        $this->assertEquals(10, $paginationService->paginator->getPageSize());
        $this->assertCount(2, $paginationService->items);
    }

    /**
     * Тестируем конструктор сервиса пагинации - с кешированием
     *
     * @return void
     */
    public function testConstructorWithCache()
    {
        /** Запрос для получения статей */
        $queryArticles = Articles::find()->andWhere([Articles::ATTR_ENABLED => Articles::TRUE]);

        /** Инициализируем конструктор - с кешированием */
        $paginationService = new PaginationService($queryArticles, 10);

        /** Проверки ожиданий по проверкам работы функционала */
        $this->assertInstanceOf(PaginationService::class, $paginationService);
        $this->assertInstanceOf(Pagination::class, $paginationService->paginator);
        $this->assertEquals(10, $paginationService->paginator->getPageSize());
        $this->assertCount(2, $paginationService->items);
    }

    /**
     * Тестируем конструктор сервиса пагинации - с различными Query моделями
     *
     * @return void
     */
    public function testConstructorMultiClasses()
    {
        /** Примеры запросов различных моделей из приложения */
        $queries_collection = [
            ApiLoot::findActualItems(),
            News::find()->andWhere([News::ATTR_ENABLED => News::TRUE]),
            Questions::find()->where([Questions::ATTR_ENABLED => Questions::TRUE]),
            Items::takeItemsWithParentCat('main-category', 1)
        ];

        /** В цикле смотрим каждый запрос, чтобы убедиться что все работает корректно */
        foreach ($queries_collection as $query) {

            /** Инициализируем конструктор - только с параметром запроса */
            $paginationService = new PaginationService($query);

            /** Проверки ожиданий по проверкам работы функционала - кроме количества записей, у разных фикстур будут разные числа */
            $this->assertInstanceOf(PaginationService::class, $paginationService);
            $this->assertInstanceOf(Pagination::class, $paginationService->paginator);
            $this->assertEquals(20, $paginationService->paginator->getPageSize());
        }
    }
}