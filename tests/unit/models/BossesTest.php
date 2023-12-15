<?php
/**
 * Created by PhpStorm.
 * User: PC_Principal
 * Date: 29.11.2022
 * Time: 23:51
 */

namespace app\tests;

use app\models\Bosses;
use app\tests\fixtures\BossesFixture;
use app\common\helpers\validators\StringValidator;

/**
 * Unit тесты для API страниц боссов
 *
 * Class BossesTest
 * @package models
 */
class BossesTest extends \Codeception\Test\Unit
{
    /**
     * @var \UnitTester
     */
    protected $tester;

    /** Метод выполняется перед каждым тестом */
    protected function _before()
    {
        /** Грузим фикстуры перед каждым тестом */
        $this->tester->haveFixtures([
            'bosses' => [
                'class' => BossesFixture::class,
                'dataFile' => codecept_data_dir() . 'bosses.php'
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
        $list = [];

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
        $list = [Bosses::ATTR_ID, Bosses::ATTR_ACTIVE, Bosses::ATTR_OLD];

        /** Проходим в цикле список атрибутов */
        foreach ($list as $item) {

            /** Пробуем засетапить в числовой атрибут - строку */
            $this->_validateAttribute($model, $item, 'a');
        }
    }

    /** Метод для валидации строковых атрибутов */
    protected function _validateStringAttributes($model)
    {
        /** Список атрибутов на валидацию - длина 100 символов */
        $list_hundred = [Bosses::ATTR_MAP];

        /** Список атрибутов на валидацию - длина 255 символов */
        $list_main = [Bosses::ATTR_URL];

        /** Переменная с пустой строкой */
        $too_long_string = '';

        /** В цикле увеличиваем длину строки, пока не станет 101 символов */
        for ($i = 0; $i < StringValidator::VARCHAR_LENGTH_HUNDRED + 1; $i++) {
            $too_long_string .= 'a';
        }

        /** В цикле увеличиваем длину строки, пока не станет 101 символов */
        foreach ($list_hundred as $item) {

            /** Валидируем каждый из них */
            $this->_validateAttribute($model, $item, $too_long_string);
        }

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
        $item = new Bosses();

        /** Валидируем все атрибуты AR объекта*/
        $this->_validateAttributes($item);

        /** Значения на сохранение нового объекта */
        $values = [
            Bosses::ATTR_ID     => 10,
            Bosses::ATTR_MAP    => 'Новая локация',
            Bosses::ATTR_BOSSES => '[{"name":"Death Knight","spawnChance":0.16,"spawnTrigger":null,"spawnLocations":[{"name":"ScavBase"}],"escorts":[{"amount":[{"count":2}]},{"amount":[{"count":1}]},{"amount":[{"count":1}]}]},{"name":"Решала","spawnChance":0.1,"spawnTrigger":null,"spawnLocations":[{"name":"Dormitory"},{"name":"GasStation"}],"escorts":[{"amount":[{"count":4}]}]},{"name":"Сектант Жрец","spawnChance":0.02,"spawnTrigger":null,"spawnLocations":[{"name":"ScavBase"}],"escorts":[{"amount":[{"count":4}]}]}]',
            Bosses::ATTR_ACTIVE => 1,
            Bosses::ATTR_OLD    => 0,
            Bosses::ATTR_URL    => 'new_location'

        ];

        /** Сетапим атрибуты AR объекту */
        $item->setAttributes($values);

        /** Валидируем атрибуты */
        $item->validate();

        /** Ожидаем что запись сохранилась */
        $this->assertTrue($item->save(), 'Ожидалось true - объект не сохранился.');

        /** Выбираем все записи */
        $list = Bosses::find()->all();

        /** Ожидаем что всего будет 4 записи */
        $this->assertTrue(count($list) == 10);
    }

    /** Тестируем выборку маркера на обновление */
    public function testEdit()
    {
        /** Выбираем одну из записей, представленных в фикстурах */
        $item = Bosses::findOne([Bosses::ATTR_ID => 3]);

        /** Проводит валидацию атрибутов данных, полученных из фикстуры */
        $this->_validateAttributes($item);
    }

    /** Тестируем получение всех записей (select) */
    public function testList()
    {
        /** Выбираем все записи */
        $list = Bosses::find()->all();

        /** Ожидаем получить из фикстур - 3 записи */
        $this->assertTrue(count($list) == 9);
    }

    /** Тестируем удаление объекта */
    public function testDelete()
    {
        /** Выбираем одну из записей, представленных в фикстурах */
        $item = Bosses::findOne([Bosses::ATTR_ID => 3]);

        /** Удаляем запись */
        $item->delete();

        /** Получаем список всех записей */
        $list = Bosses::find()->all();

        /** Ожидаем получить из фикстур - 2 записи */
        $this->assertTrue(count($list) == 8);
    }
}