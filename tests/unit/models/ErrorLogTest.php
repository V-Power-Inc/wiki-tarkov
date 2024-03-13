<?php
/**
 * Created by PhpStorm.
 * User: PC_Principal
 * Date: 10.03.2024
 * Time: 23:50
 */

namespace app\tests;

use app\common\helpers\validators\StringValidator;
use app\models\ErrorLog;
use app\tests\fixtures\ErrorLogFixture;
use UnitTester;

/**
 * Unit тесты логирующей ошибки таблицы
 *
 * Class ErrorLogTest
 * @package app\tests
 *
 * @see https://codeception.com/docs/UnitTests
 * @see https://www.yiiframework.com/doc/guide/2.0/ru/test-fixtures
 */
class ErrorLogTest extends \Codeception\Test\Unit
{
    /** Объект класса для тестирования */
    protected UnitTester $tester;

    /** Метод выполняется перед каждым тестом */
    protected function _before()
    {
        /** Грузим фикстуры перед каждым тестом */
        $this->tester->haveFixtures([
            'tasks' => [
                'class' => ErrorLogFixture::class,
                'dataFile' => codecept_data_dir() . 'errors.php'
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
        $list = [ErrorLog::ATTR_URL];

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
        $list = [ErrorLog::ATTR_ID, ErrorLog::ATTR_ERROR_CODE];

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
        $list_hundred = [ErrorLog::ATTR_TYPE, ErrorLog::ATTR_DESCRIPTION];

        /** Список атрибутов на валидацию - длина 255 символов */
        $list_main = [ErrorLog::ATTR_URL];

        /** Переменная с пустой строкой */
        $too_long_string = '';

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

    /** Тестируем создание нового объекта */
    public function testCreation()
    {
        /** Создаем новый AR объект  */
        $error_log = new ErrorLog();

        /** Валидируем все атрибуты AR объекта*/
        $this->_validateAttributes($error_log);

        /** Значения на сохранение нового объекта */
        $values = [
            ErrorLog::ATTR_ID => 3,
            ErrorLog::ATTR_TYPE => 'Страница не найдена',
            ErrorLog::ATTR_URL => '/base-url',
            ErrorLog::ATTR_DESCRIPTION => 'Страница не была найдена, возможно удалена из БД',
            ErrorLog::ATTR_ERROR_CODE => 404
        ];

        /** Сетапим атрибуты AR объекту */
        $error_log->setAttributes($values);

        /** Валидируем атрибуты */
        $error_log->validate();

        /** Ожидаем что запись сохранилась */
        $this->assertTrue($error_log->save(), 'Ожидалось true - объект не сохранился.');

        /** Выбираем все записи */
        $list = ErrorLog::find()->all();

        /** Ожидаем что всего будет 3 записи */
        $this->assertTrue(count($list) == 3);
    }

    /** Тестируем выборку записи на обновление */
    public function testEdit()
    {
        /** Выбираем одну из записей, представленных в фикстурах */
        $error_log = ErrorLog::findOne([ErrorLog::ATTR_ID => 1]);

        /** Проводит валидацию атрибутов данных, полученных из фикстуры */
        $this->_validateAttributes($error_log);
    }

    /** Тестируем получение всех записей (select) */
    public function testList()
    {
        /** Выбираем все записи */
        $list = ErrorLog::find()->all();

        /** Ожидаем получить из фикстур - 2 записи */
        $this->assertTrue(count($list) == 2);
    }

    /** Тестируем удаление объекта */
    public function testDelete()
    {
        /** Выбираем одну из записей, представленных в фикстурах */
        $error_log = ErrorLog::findOne([ErrorLog::ATTR_ID => 2]);

        /** Удаляем запись */
        $error_log->delete();

        /** Получаем список всех записей */
        $list = ErrorLog::find()->all();

        /** Ожидаем получить из фикстур - 1 записи */
        $this->assertTrue(count($list) == 1);
    }
}