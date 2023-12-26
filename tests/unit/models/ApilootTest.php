<?php
/**
 * Created by PhpStorm.
 * User: PC_Principal
 * Date: 28.10.2023
 * Time: 23:59
 */

namespace app\tests;

use app\models\ApiLoot;
use app\tests\fixtures\ApilootFixture;
use app\common\helpers\validators\StringValidator;

/**
 * Unit тесты для API страниц актуального лута
 *
 * Class ApilootTest
 * @package models
 *
 * @see https://codeception.com/docs/UnitTests
 * @see https://www.yiiframework.com/doc/guide/2.0/ru/test-fixtures
 */
class ApilootTest extends \Codeception\Test\Unit
{
    /**
     * @var \UnitTester
     */
    protected $tester;

    /** Метод выполняется перед каждым тестом */
    public function _before()
    {
        /** Грузим фикстуры перед каждым тестом */
        $this->tester->haveFixtures([
            'api_loot' => [
                'class' => ApilootFixture::class,
                'dataFile' => codecept_data_dir() . 'api-loot.php'
            ]
        ]);
    }

    /** Метод выполняется после каждого теста */
    protected function _after()
    {}

    /**
     * Метод вызывающий валидации атрибутов различных типов
     */
    protected function _validateAttributes($model)
    {
        /** Валидация обязательных атрибутов */
        $this->_validateRequiredAttributes($model);

        /** Валидация строковых атрибутов */
        $this->_validateStringAttributes($model);

        /** Валидация числовых атрибутов */
        $this->_validateNumberAttributes($model);
    }

    /** Метод для валидации обязательных атрибутов */
    protected function _validateRequiredAttributes($model)
    {
        /** Список атрибутов на валидацию */
        $list = [ApiLoot::ATTR_URL, ApiLoot::ATTR_JSON, ApiLoot::ATTR_NAME];

        /** Проходим в цикле список атрибутов */
        foreach ($list as $item) {

            /** Пробуем оставить их как null */
            $this->_validateAttribute($model, $item, null);
        }
    }

    /** Метод для валидации числовых атрибутов */
    protected function _validateNumberAttributes($model)
    {
        /** Список атрибутов на валидацию */
        $list = [ApiLoot::ATTR_ID, ApiLoot::ATTR_ACTIVE];

        /** Проходим в цикле список атрибутов */
        foreach ($list as $item) {

            /** Пробуем засетапить в числовой атрибут - строку */
            $this->_validateAttribute($model, $item, 'a');
        }
    }

    /** Метод для валидации строковых атрибутов */
    protected function _validateStringAttributes($model)
    {
        /** Список атрибутов на валидацию - длина 255 символов */
        $list_main = [ApiLoot::ATTR_NAME, ApiLoot::ATTR_URL];

        /** Переменная с пустой строкой */
        $too_long_string = '';

        /** В цикле увеличиваем длину строки, пока не станет 256 символов */
        for ($i = 0; $i < StringValidator::VARCHAR_LENGTH + 1; $i++) {
            $too_long_string .= 'a';
        }

        /** Проходим в цикле список атрибутов - длина строки 256 символов */
        foreach ($list_main as $item) {

            /** Валидируем каждый из них */
            $this->_validateAttribute($model, $item, $too_long_string);
        }
    }

    /** Метод валидации атрибута, что сюда передается */
    protected function _validateAttribute($model, $attribute, $value)
    {
        /** Сетапим значение атрибута AR модели */
        $model->setAttribute($attribute, $value);

        /** Ожидаем что атрибут не пройдет валидацию */
        $this->assertFalse($model->validate($attribute), $attribute . ': ' . $value);
    }

    /** Тестируем создание нового маркера */
    public function testCreation()
    {
        /** Создаем новый объект AR */
        $item = new ApiLoot();

        /** Валидируем все атрибуты AR объекта*/
        $this->_validateAttributes($item);

        /** Значения на сохранение нового объекта */
        $values = [
            ApiLoot::ATTR_ID     => 22,
            ApiLoot::ATTR_NAME   => 'M4A1-Автомат',
            ApiLoot::ATTR_JSON   => '{"id":"5ae30e795acfc408fb139a0b","name":"Мушка-газблок для M4A1","normalizedName":"m4a1-front-sight-with-gas-block","width":1,"height":1,"weight":0.15,"description":"Штатная мушка для M4A1, производство Colt.","category":{"name":"Газовый блок"},"iconLink":"https://assets.tarkov.dev/5ae30e795acfc408fb139a0b-icon.webp","inspectImageLink":"https://assets.tarkov.dev/5ae30e795acfc408fb139a0b-image.webp","sellFor":[{"vendor":{"name":"Прапор"},"price":1285,"currency":"RUB","currencyItem":{"name":"Рубли"},"priceRUB":1285},{"vendor":{"name":"Скупщик"},"price":1028,"currency":"RUB","currencyItem":{"name":"Рубли"},"priceRUB":1028},{"vendor":{"name":"Лыжник"},"price":1259,"currency":"RUB","currencyItem":{"name":"Рубли"},"priceRUB":1259},{"vendor":{"name":"Миротворец"},"price":9,"currency":"USD","currencyItem":{"name":"Доллары"},"priceRUB":1156},{"vendor":{"name":"Механик"},"price":1439,"currency":"RUB","currencyItem":{"name":"Рубли"},"priceRUB":1439},{"vendor":{"name":"Барахолка"},"price":20000,"currency":"RUB","currencyItem":{"name":"Рубли"},"priceRUB":20000}],"buyFor":[{"vendor":{"name":"Миротворец"},"price":21,"currency":"USD","currencyItem":{"name":"Доллары"},"priceRUB":3125},{"vendor":{"name":"Барахолка"},"price":26255,"currency":"RUB","currencyItem":{"name":"Рубли"},"priceRUB":26255}],"bartersFor":[],"receivedFromTasks":[{"name":"Друг с Запада - Часть 1","trader":{"name":"Лыжник"}}]}',
            ApiLoot::ATTR_URL    => 'm4a1',
            ApiLoot::ATTR_ACTIVE => 1
        ];

        /** Сетапим атрибуты AR объекту */
        $item->setAttributes($values);

        /** Валидируем атрибуты */
        $item->validate();

        /** Ожидаем что запись сохранилась */
        $this->assertTrue($item->save(), 'Ожидалось true - объект не сохранился.');

        /** Выбираем все записи */
        $list = ApiLoot::find()->all();

        /** Ожидаем что всего будет 22 записи */
        $this->assertTrue(count($list) == 22);
    }

    /** Тестируем выборку записи на обновление */
    public function testEdit()
    {
        /** Выбираем одну из записей, представленных в фикстурах */
        $item = ApiLoot::findOne([ApiLoot::ATTR_ID => 3]);

        /** Проводит валидацию атрибутов данных, полученных из фикстуры */
        $this->_validateAttributes($item);
    }

    /** Тестируем получение всех записей (select) */
    public function testList()
    {
        /** Выбираем все записи */
        $list = ApiLoot::find()->all();

        /** Ожидаем получить из фикстур - 21 записи */
        $this->assertTrue(count($list) == 21);
    }

    /** Метод для получения только активных записей */
    public function testSelectActiveRows()
    {
        /** Выбираем все записи */
        $list = ApiLoot::find()
            ->where([ApiLoot::ATTR_ACTIVE => ApiLoot::TRUE])
            ->all();

        /** Ожидаем получить из фикстур - 21 записи */
        $this->assertTrue(count($list) == 20);
    }

    /** Метод для получения только активных записей с определенными филдами и сортировкой (как в контроллере) */
    public function testSelectActiveRowsWithSortAndOrder()
    {
        /** Выбираем все записи используя селект и сортировку (как в контроллере) */
        $list = ApiLoot::find()
            ->select([ApiLoot::ATTR_JSON, ApiLoot::ATTR_URL])
            ->where([ApiLoot::ATTR_ACTIVE => ApiLoot::TRUE])
            ->orderBy([ApiLoot::ATTR_DATE_CREATE => SORT_DESC])
            ->all();

        /** Ожидаем получить из фикстур - 20 записи */
        $this->assertTrue(count($list) == 20);
    }

    /** Метод для получения только одной активной записи по урлу */
    public function testSelectActiveByUrlSingleRow()
    {
        /** Выбираем все записи */
        $item = ApiLoot::find()
            ->where([ApiLoot::ATTR_URL => 'm4a1-front-sight-with-gas-block-one'])
            ->andWhere([ApiLoot::ATTR_ACTIVE => ApiLoot::TRUE])
            ->one();

        /** Ожидаем получить из фикстур - 1 запись */
        $this->assertTrue(!empty($item));
    }

    /** Тестируем удаление объекта */
    public function testDelete()
    {
        /** Выбираем одну из записей, представленных в фикстурах */
        $item = ApiLoot::findOne([ApiLoot::ATTR_ID => 3]);

        /** Удаляем запись */
        $item->delete();

        /** Получаем список всех записей */
        $list = ApiLoot::find()->all();

        /** Ожидаем получить из фикстур - 20 записи */
        $this->assertTrue(count($list) == 20);
    }
}