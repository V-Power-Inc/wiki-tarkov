<?php
/**
 * Created by PhpStorm.
 * User: PC_Principal
 * Date: 18.08.2022
 * Time: 21:12
 */

namespace app\tests;

use app\models\Forest;
use app\tests\fixtures\ForestFixture;
use app\common\helpers\validators\StringValidator;

/**
 * Unit тесты интерактивных маркеров Леса
 *
 * Class ForestTest
 * @package models
 */
class ForestTest extends \Codeception\Test\Unit
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
            'forest' => [
                'class' => ForestFixture::class,
                'dataFile' => codecept_data_dir() . 'forest.php'
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
        $list = [Forest::ATTR_NAME];

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
        $list = [Forest::ATTR_ID, Forest::ATTR_COORDS_X, Forest::ATTR_COORDS_Y, Forest::ATTR_ENABLED, Forest::ATTR_EXIT_ANYWAY];

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
        $list_fifty = [Forest::ATTR_MARKER_GROUP];

        /** Список атрибутов на валидацию - длина 100 символов */
        $list_hundred = [Forest::ATTR_NAME, Forest::ATTR_EXITS_GROUP];

        /** Список атрибутов на валидацию - длина 255 символов */
        $list_main = [Forest::ATTR_CUSTOMICON];

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
        $marker = new Forest();

        /** Валидируем все атрибуты AR объекта*/
        $this->_validateAttributes($marker);

        /** Значения на сохранение нового объекта */
        $values = [
            Forest::ATTR_ID => 4,
            Forest::ATTR_NAME => 'Ящик у выхода с локации',
            Forest::ATTR_MARKER_GROUP => 'Военные ящики',
            Forest::ATTR_COORDS_X => 10,
            Forest::ATTR_COORDS_Y => -135,
            Forest::ATTR_CONTENT => '<p>Это основной выход с локации Завод, если у вас нет ключа от выхода с завода - это ваш единственный способ выйти с карты.</p><p><img alt="Основной выход с локации Завод. Через него выходит основная часть игроков." src="/img/upload/bereg_images/vihod-s-karty.png" style="width:100%" /></p>',
            Forest::ATTR_ENABLED => 1,
            Forest::ATTR_CUSTOMICON => '/img/admin/beregicons/vorota_3_d.png',
            Forest::ATTR_EXITS_GROUP => 'Спавн на зеленой лампе',
            Forest::ATTR_EXIT_ANYWAY => 1
        ];

        /** Сетапим атрибуты AR объекту */
        $marker->setAttributes($values);

        /** Валидируем атрибуты */
        $marker->validate();

        /** Ожидаем что запись сохранилась */
        $this->assertTrue($marker->save(), 'Ожидалось true - объект не сохранился.');

        /** Выбираем все записи */
        $list = Forest::find()->all();

        /** Ожидаем что всего будет 4 записи */
        $this->assertTrue(count($list) == 4);
    }

    /** Тестируем выборку записи на обновление */
    public function testEdit()
    {
        /** Выбираем одну из записей, представленных в фикстурах */
        $marker = Forest::findOne([Forest::ATTR_ID => 3]);

        /** Проводит валидацию атрибутов данных, полученных из фикстуры */
        $this->_validateAttributes($marker);
    }

    /** Тестируем получение всех записей (select) */
    public function testList()
    {
        /** Выбираем все записи */
        $list = Forest::find()->all();

        /** Ожидаем получить из фикстур - 3 записи */
        $this->assertTrue(count($list) == 3);
    }

    /** Тестируем удаление объекта */
    public function testDelete()
    {
        /** Выбираем одну из записей, представленных в фикстурах */
        $marker = Forest::findOne([Forest::ATTR_ID => 3]);

        /** Удаляем запись */
        $marker->delete();

        /** Получаем список всех записей */
        $list = Forest::find()->all();

        /** Ожидаем получить из фикстур - 2 записи */
        $this->assertTrue(count($list) == 2);
    }
}