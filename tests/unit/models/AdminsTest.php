<?php
/**
 * Created by PhpStorm.
 * User: PC_Principal
 * Date: 25.12.2023
 * Time: 23:44
 */

namespace app\tests;

use app\models\Admins;
use app\tests\fixtures\AdminsFixture;
use app\common\helpers\validators\StringValidator;

/**
 * Unit тесты для таблицы с пользователями сайта (Админами)
 *
 * Class AdminsTest
 * @package models
 *
 * @see https://codeception.com/docs/UnitTests
 * @see https://www.yiiframework.com/doc/guide/2.0/ru/test-fixtures
 */
class AdminsTest extends \Codeception\Test\Unit
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
            'admins' => [
                'class' => AdminsFixture::class,
                'dataFile' => codecept_data_dir() . 'admins.php'
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
        $list = [Admins::ATTR_USER, Admins::ATTR_PASSWORD];

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
        $list = [Admins::ATTR_ID, Admins::ATTR_BANNED, Admins::ATTR_REMEMBER_ME];

        /** Проходим в цикле список атрибутов */
        foreach ($list as $item) {

            /** Пробуем засетапить в числовой атрибут - строку */
            $this->_validateAttribute($model, $item, 'a');
        }
    }

    /** Метод для валидации строковых атрибутов */
    protected function _validateStringAttributes($model)
    {
        /** Список атрибутов на валидацию - длина 45 символов */
        $list_fourty_five = [Admins::ATTR_USER, Admins::ATTR_PASSWORD];
        
        /** Список атрибутов на валидацию - длина 255 символов */
        $list_main = [Admins::ATTR_NAME, Admins::ATTR_CAPTCHA];

        /** Переменная с пустой строкой */
        $too_long_string = '';

        /** В цикле увеличиваем длину строки, пока не станет 46 символов */
        for ($i = 0; $i < StringValidator::VARCHAR_LENGTH_FORTY_FIVE + 1; $i++) {
            $too_long_string .= 'a';
        }

        /** Проходим в цикле список атрибутов - длина строки 46 символов */
        foreach ($list_fourty_five as $item) {

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
        $item = new Admins();

        /** Валидируем все атрибуты AR объекта*/
        $this->_validateAttributes($item);

        /** Значения на сохранение нового объекта */
        $values = [
            Admins::ATTR_ID          => 3,
            Admins::ATTR_USER        => 'Kondor',
            Admins::ATTR_NAME        => 'Test_user',
            Admins::ATTR_PASSWORD    => 'e99c98933c2dfd7cef57a6dedb38188e',
            Admins::ATTR_CAPTCHA     => 'test',
            Admins::ATTR_REMEMBER_ME => Admins::FALSE,
            Admins::ATTR_ROLE        => 'Модератор',
            Admins::ATTR_BANNED      => 0,
            Admins::ATTR_BANN_REASON => null,
            Admins::ATTR_DATE_END    => null
        ];

        /** Сетапим атрибуты AR объекту */
        $item->setAttributes($values);

        /** Валидируем атрибуты */
        $item->validate();

        /** Ожидаем что запись сохранилась */
        $this->assertTrue($item->save(), 'Ожидалось true - объект не сохранился.');

        /** Выбираем все записи */
        $list = Admins::find()->all();

        /** Ожидаем что всего будет 3 записи */
        $this->assertTrue(count($list) == 3);
    }

    /** Тестируем выборку записи на обновление */
    public function testEdit()
    {
        /** Выбираем одну из записей, представленных в фикстурах */
        $item = Admins::findOne([Admins::ATTR_ID => 2]);

        /** Проводит валидацию атрибутов данных, полученных из фикстуры */
        $this->_validateAttributes($item);
    }

    /** Тестируем получение всех записей (select) */
    public function testList()
    {
        /** Выбираем все записи */
        $list = Admins::find()->all();

        /** Ожидаем получить из фикстур - 2 записи */
        $this->assertTrue(count($list) == 2);
    }

    /** Тестируем удаление объекта */
    public function testDelete()
    {
        /** Выбираем одну из записей, представленных в фикстурах */
        $item = Admins::findOne([Admins::ATTR_ID => 2]);

        /** Удаляем запись */
        $item->delete();

        /** Получаем список всех записей */
        $list = Admins::find()->all();

        /** Ожидаем получить из фикстур - 1 записи */
        $this->assertTrue(count($list) == 1);
    }
}