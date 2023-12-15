<?php

namespace models;

use app\common\helpers\validators\StringValidator;
use app\models\Zavod;
use app\tests\fixtures\ZavodFixture;

/**
 * Unit тесты интерактивных маркеров Завода
 *
 * Class ZavodTest
 * @package models
 *
 * @see https://codeception.com/docs/UnitTests
 * @see https://www.yiiframework.com/doc/guide/2.0/ru/test-fixtures
 */
class ZavodTest extends \Codeception\Test\Unit
{
    /**
     * @var \UnitTester
     */
    protected $tester;

    /**
     * Фикстуры для таблицы zavod
     * @return array
     */
    public function fixtures() {
        return [
            'zavod' => [
                'class' => ZavodFixture::class,
                'dataFile' => codecept_data_dir() . 'zavod.php'
            ]
        ];
    }

    /** Метод выполняется перед каждым тестом */
    protected function _before()
    {
//        $this->tester->haveFixtures([
//            'zavod' => [
//                'class' => ZavodFixture::class,
//                'dataFile' => codecept_data_dir() . 'zavod.php'
//            ]
//        ]);
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
        $list = [Zavod::ATTR_NAME];

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
        $list = [Zavod::ATTR_ID, Zavod::ATTR_COORDS_X, Zavod::ATTR_COORDS_Y, Zavod::ATTR_ENABLED, Zavod::ATTR_EXIT_ANYWAY];

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
        $list_fifty = [Zavod::ATTR_MARKER_GROUP];

        /** Список атрибутов на валидацию - длина 100 символов */
        $list_hundred = [Zavod::ATTR_NAME, Zavod::ATTR_EXITS_GROUP];

        /** Список атрибутов на валидацию - длина 255 символов */
        $list_main = [Zavod::ATTR_CUSTOMICON];

        /** Список атрибутов на валидацию - строка без ограничений (Обычно в бд филда text) */
        $list_string_test = [Zavod::ATTR_CONTENT];

        /** Переменная с пустой строкой */
        $too_long_string = '';

        /** В цикле увеличиваем длину строки, пока не станет 56 символов */
        for($i = 0; $i < StringValidator::VARCHAR_LENGTH_FIFTY + 1; $i++) {
            $too_long_string .= 'a';
        }

        /** Проходим в цикле список атрибутов - длина строки 56 символов */
        foreach ($list_fifty as $item) {

            /** Валидируем каждый из них */
            $this->_validateAttribute($model, $item, $too_long_string);
        }

        /** В цикле увеличиваем длину строки, пока не станет 101 символов */
        for($i = 0; $i < StringValidator::VARCHAR_LENGTH_HUNDRED + 1; $i++) {
            $too_long_string .= 'a';
        }

        /** Проходим в цикле список атрибутов - длина строки 101 символов */
        foreach ($list_hundred as $item) {

            /** Валидируем каждый из них */
            $this->_validateAttribute($model, $item, $too_long_string);
        }

        /** В цикле увеличиваем длину строки, пока не станет 256 символов */
        for($i = 0; $i < StringValidator::VARCHAR_LENGTH + 1; $i++) {
            $too_long_string .= 'a';
        }

        /** Проходим в цикле список атрибутов - длина строки 256 символов */
        foreach ($list_main as $item) {

            /** Валидируем каждый из них */
            $this->_validateAttribute($model, $item, $too_long_string);
        }

        /** В цикле увеличиваем длину строки, пока не станет 5001 символов */
        for($i = 0; $i < StringValidator::VARCHAR_LENGTH_TEXT_TYPE + StringValidator::VARCHAR_LENGTH_TEXT_TYPE; $i++) {
            $too_long_string .= 'a';
        }

        /** Проходим в цикле список атрибутов - длина строки 5001 символов */
        foreach ($list_string_test as $item) {

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
        $zavod = new Zavod();

        /** Валидируем все атрибуты AR объекта*/
        $this->_validateAttributes($zavod);

        /** Значения на сохранение нового объекта */
        $values = [
            // Zavod::ATTR_ID => 1,
            Zavod::ATTR_MARKER_GROUP => 'Ящик у выхода с локации',
            Zavod::ATTR_COORDS_X => 10,
            Zavod::ATTR_COORDS_Y => -135,
            Zavod::ATTR_CONTENT => '<p>Это основной выход с локации Завод, если у вас нет ключа от выхода с завода - это ваш единственный способ выйти с карты.</p><p><img alt="Основной выход с локации Завод. Через него выходит основная часть игроков." src="/img/upload/bereg_images/vihod-s-karty.png" style="width:100%" /></p>',
            Zavod::ATTR_ENABLED => 1,
            Zavod::ATTR_CUSTOMICON => '/img/admin/beregicons/vorota_3_d.png',
            Zavod::ATTR_EXITS_GROUP => 'Спавн на зеленой лампе',
            Zavod::ATTR_EXIT_ANYWAY => 1
        ];

        /** Сетапим атрибуты AR объекту */
        $zavod->setAttributes($values);

        /** Валидируем атрибуты */
        $zavod->validate();

        /** Ожидаем что запись сохранилась */
        $this->assertTrue($zavod->save(), 'Ожидалось true - объект не сохранился.');

        /** Выбираем все записи */
        $list = Zavod::find()->all();

        /** Ожидаем что всего будет 4 записи */
        $this->assertTrue(count($list) == 4);
    }

    /** Тестируем выборку маркера на обновление */
    public function testEdit()
    {
        /** Выбираем одну из записей, представленных в фикстурах */
        $zavod = Zavod::findOne([Zavod::ATTR_ID => 3]);

        /** Проводит валидацию атрибутов данных, полученных из фикстуры */
        $this->_validateAttributes($zavod);
    }

    /** Тестируем получение всех записей (select) */
    public function testList()
    {
        /** Выбираем все записи */
        $list = Zavod::find()->all();

        /** Ожидаем получить из фикстур - 3 записи */
        $this->assertTrue(count($list) == 3);
    }

    /** Тестируем удаление объекта */
    public function testDelete()
    {
        /** Выбираем одну из записей, представленных в фикстурах */
        $zavod = Zavod::findOne([Zavod::ATTR_ID => 3]);

        /** Удаляем запись */
        $zavod->delete();

        /** Получаем список всех записей */
        $list = Zavod::find()->all();

        /** Ожидаем получить из фикстур - 2 записи */
        $this->assertTrue(count($list) == 2);
    }
}