<?php
/**
 * Created by PhpStorm.
 * User: PC_Principal
 * Date: 23.12.2023
 * Time: 16:56
 */

namespace app\tests;

use app\common\helpers\validators\StringValidator;
use app\models\Maps;
use app\tests\fixtures\MapsFixture;

/**
 * Unit тесты маркеров локаций
 *
 * Class MapsTest
 * @package models
 *
 * @see https://codeception.com/docs/UnitTests
 * @see https://www.yiiframework.com/doc/guide/2.0/ru/test-fixtures
 */
class MapsTest extends \Codeception\Test\Unit
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
            'maps' => [
                'class' => MapsFixture::class,
                'dataFile' => codecept_data_dir() . 'maps.php'
            ]
        ]);
    }

    /** Метод выполняется после каждого теста */
    protected function _after()
    {
    }

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
        $list = [Maps::ATTR_NAME, Maps::ATTR_MAP];

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
        $list = [Maps::ATTR_ID, Maps::ATTR_COORDS_X, Maps::ATTR_COORDS_Y, Maps::ATTR_ENABLED, Maps::ATTR_EXIT_ANYWAY];

        /** Проходим в цикле список атрибутов */
        foreach ($list as $item) {

            /** Пробуем засетапить в числовой атрибут - строку */
            $this->_validateAttribute($model, $item, 'a');
        }
    }

    /** Метод для валидации строковых атрибутов */
    protected function _validateStringAttributes($model)
    {
        /** Список атрибутов на валидацию - длина 50 символов */
        $list_fifty = [Maps::ATTR_MARKER_GROUP];

        /** Список атрибутов на валидацию - длина 100 символов */
        $list_hundred = [Maps::ATTR_NAME, Maps::ATTR_EXITS_GROUP];

        /** Список атрибутов на валидацию - длина 255 символов */
        $list_main = [Maps::ATTR_CUSTOMICON, Maps::ATTR_MAP];

        /** Переменная с пустой строкой */
        $too_long_string = '';

        /** В цикле увеличиваем длину строки, пока не станет 56 символов */
        for ($i = 0; $i < StringValidator::VARCHAR_LENGTH_FIFTY + 1; $i++) {
            $too_long_string .= 'a';
        }

        /** Проходим в цикле список атрибутов - длина строки 56 символов */
        foreach ($list_fifty as $item) {

            /** Валидируем каждый из них */
            $this->_validateAttribute($model, $item, $too_long_string);
        }

        /** В цикле увеличиваем длину строки, пока не станет 101 символов */
        for ($i = 0; $i < StringValidator::VARCHAR_LENGTH_HUNDRED + 1; $i++) {
            $too_long_string .= 'a';
        }

        /** Проходим в цикле список атрибутов - длина строки 101 символов */
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
        /** Создаем новый объект класса маркеров */
        $marker = new Maps();

        /** Валидируем все атрибуты AR объекта*/
        $this->_validateAttributes($marker);

        /** Значения на сохранение нового объекта */
        $values = [
            Maps::ATTR_ID => 7,
            Maps::ATTR_NAME => 'Ящик у выхода с локации-testetssss',
            Maps::ATTR_MAP => 'Завод',
            Maps::ATTR_MARKER_GROUP => 'Военные ящики',
            Maps::ATTR_COORDS_X => 10,
            Maps::ATTR_COORDS_Y => -135,
            Maps::ATTR_CONTENT => '<p>Это основной выход с локации Завод, если у вас нет ключа от выхода с завода - это ваш единственный способ выйти с карты.</p><p><img alt="Основной выход с локации Завод. Через него выходит основная часть игроков." src="/img/upload/bereg_images/vihod-s-karty.png" style="width:100%" /></p>',
            Maps::ATTR_ENABLED => 1,
            Maps::ATTR_CUSTOMICON => '/img/admin/beregicons/vorota_3_d.png',
            Maps::ATTR_EXITS_GROUP => 'Спавн на зеленой лампе',
            Maps::ATTR_EXIT_ANYWAY => 1
        ];

        /** Сетапим атрибуты AR объекту */
        $marker->setAttributes($values);

        /** Валидируем атрибуты */
        $marker->validate();

        /** Ожидаем что запись сохранилась */
        $this->assertTrue($marker->save(), 'Ожидалось true - объект не сохранился.');

        /** Выбираем все записи */
        $list = Maps::find()->all();

        /** Ожидаем что всего будет 7 записи */
        $this->assertTrue(count($list) == 7);
    }

    /** Тестируем выборку записи на обновление */
    public function testEdit()
    {
        /** Выбираем одну из записей, представленных в фикстурах */
        $marker = Maps::findOne([Maps::ATTR_ID => 3]);

        /** Проводит валидацию атрибутов данных, полученных из фикстуры */
        $this->_validateAttributes($marker);
    }

    /** Тестируем получение всех записей (select) */
    public function testList()
    {
        /** Выбираем все записи */
        $list = Maps::find()->all();

        /** Ожидаем получить из фикстур - 6 записи */
        $this->assertTrue(count($list) == 6);
    }

    /** Тестируем получение всех записей - только активных (select) */
    public function testSelectActiveRows()
    {
        /** Выбираем все записи - только активные */
        $list = Maps::find()
            ->where([Maps::ATTR_ENABLED => 1])
            ->all();

        /** Ожидаем получить из фикстур - 5 записи */
        $this->assertTrue(count($list) == 5);
    }

    /** Тестируем получение всех записей (select) - маркеры Завода */
    public function testListZavodMarkers()
    {
        /** Выбираем все записи */
        $list = Maps::takeZavodMarkers();

        /** Ожидаем получить из фикстур - 1 записи */
        $this->assertTrue(count($list) == 1);
    }

    /** Тестируем получение всех записей (select) - маркеры Берега */
    public function testListBeregMarkers()
    {
        /** Выбираем все записи */
        $list = Maps::takeBeregMarkers();

        /** Ожидаем получить из фикстур - 1 записи */
        $this->assertTrue(count($list) == 1);
    }

    /** Тестируем получение всех записей (select) - маркеры Таможни */
    public function testListTamojnyaMarkers()
    {
        /** Выбираем все записи */
        $list = Maps::takeTamojnyaMarkers();

        /** Ожидаем получить из фикстур - 1 записи */
        $this->assertTrue(count($list) == 1);
    }

    /** Тестируем получение всех записей (select) - маркеры Леса */
    public function testListForestMarkers()
    {
        /** Выбираем все записи */
        $list = Maps::takeForestMarkers();

        /** Ожидаем получить из фикстур - 1 записи */
        $this->assertTrue(count($list) == 1);
    }

    /** Тестируем получение всех записей (select) - маркеры Развязки */
    public function testListRazvyazkaMarkers()
    {
        /** Выбираем все записи */
        $list = Maps::takeRazvyazkaMarkers();

        /** Ожидаем получить из фикстур - 1 записи */
        $this->assertTrue(count($list) == 1);
    }

    /** Тестируем получение всех записей - только активных (select) */
    public function testSelectDisabledRows()
    {
        /** Выбираем все записи - только активные */
        $list = Maps::find()
            ->where([Maps::ATTR_ENABLED => 0])
            ->all();

        /** Ожидаем получить из фикстур - 1 записи */
        $this->assertTrue(count($list) == 1);
    }

    /** Тестируем удаление объекта */
    public function testDelete()
    {
        /** Выбираем одну из записей, представленных в фикстурах */
        $marker = Maps::findOne([Maps::ATTR_ID => 3]);

        /** Удаляем запись */
        $marker->delete();

        /** Получаем список всех записей */
        $list = Maps::find()->all();

        /** Ожидаем получить из фикстур - 5 записи */
        $this->assertTrue(count($list) == 5);
    }
}