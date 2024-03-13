<?php
/**
 * Created by PhpStorm.
 * User: PC_Principal
 * Date: 29.02.2024
 * Time: 20:17
 */

namespace app\tests;

use app\models\ApiSearchLogs;
use app\common\helpers\validators\StringValidator;
use app\tests\fixtures\ApiSearchLogsFixture;
use UnitTester;

/**
 * Unit тесты логов API
 *
 * Class ApiSearchLogsTest
 * @package models
 *
 * @see https://codeception.com/docs/UnitTests
 * @see https://www.yiiframework.com/doc/guide/2.0/ru/test-fixtures
 */
class ApiSearchLogsTest extends \Codeception\Test\Unit
{
    /** Объект класса для тестирования */
    protected UnitTester $tester;

    /** Метод выполняется перед каждым тестом */
    protected function _before()
    {
        /** Грузим фикстуры перед каждым тестом */
        $this->tester->haveFixtures([
            'api_search_logs' => [
                'class' => ApiSearchLogsFixture::class,
                'dataFile' => codecept_data_dir() . 'api_search_logs.php'
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
        /** Валидация строковых атрибутов */
        $this->_validateStringAttributes($model);

        /** Валидация числовых атрибутов */
        $this->_validateNumberAttributes($model);
    }

    /** Метод для валидации числовых атрибутов */
    protected function _validateNumberAttributes($model)
    {
        /** Список атрибутов на валидацию */
        $list = [ApiSearchLogs::ATTR_ID];

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
        $list = [ApiSearchLogs::ATTR_WORDS];

        /** Переменная с пустой строкой */
        $too_long_string = '';

        /** В цикле увеличиваем длину строки, пока не станет 101 символов */
        for ($i = 0; $i < StringValidator::VARCHAR_LENGTH_HUNDRED + 1; $i++) {
            $too_long_string .= 'a';
        }

        /** В цикле увеличиваем длину строки, пока не станет 256 символов */
        for ($i = 0; $i < StringValidator::VARCHAR_LENGTH + 1; $i++) {
            $too_long_string .= 'a';
        }

        /** Проходим в цикле список атрибутов - длина строки 256 символов */
        foreach ($list as $item) {

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
        $log_row = new ApiSearchLogs();

        /** Валидируем все атрибуты AR объекта*/
        $this->_validateAttributes($log_row);

        /** Значения на сохранение нового объекта */
        $values = [
            ApiSearchLogs::ATTR_ID => 4,
            ApiSearchLogs::ATTR_WORDS => 'Тестовый запрос',
            ApiSearchLogs::ATTR_INFO=> '03AKH6MRH73SroD7nOnYUtr7HpfphlxnfsEFUJHz7QVxYQBlWHA71DjjD1SdPSkh13ueeHTYA1Oajz-fDnZKmXjBCsAsaBsUcepx-OG9pOPUJEvhLsACUlgrzm_n9MWcpX99VdX0sYAXFT8dkFWiFx448JITI8zI83NOBePGNJF0CzHwsIsZEUyzwyakXI8OTYidffhPBVwYFFsjS0wBbQKrMgTz6Yw5Hw3gnXUhWZnWcUsQJ6Ff898HKu_Bt8jjXp3eZ2mlO6lEub7jAzjEKi3irAEX16naOUHDbJtJULkKpsKn2C7T8Godq7gT70BQpzNPj7cAz2Ok-OC6ZI_t4_x68rsKgtnBTsNYmLsvHOCrEsJ7vpeXuPor7mxql2HGO_bhRYC5MVKCCJ88OqAyeCQ1zFpI0z2ZXttFlalVdHJkM37AS7mSKWimu5_jcMa9gWUAUpm-5WffsRWKQeeow8r0z99ph0dKtP-NUCvBxb31tHyFH0tUPviNbOAahbeGDxSAk10p_xeI5THBheFtDTd9Kn_HO96pGZXA',
            ApiSearchLogs::ATTR_FLAG => 1
        ];

        /** Сетапим атрибуты AR объекту */
        $log_row->setAttributes($values);

        /** Валидируем атрибуты */
        $log_row->validate();

        /** Ожидаем что запись сохранилась */
        $this->assertTrue($log_row->save(), 'Ожидалось true - объект не сохранился.');

        /** Выбираем все записи */
        $list = ApiSearchLogs::find()->all();

        /** Ожидаем что всего будет 4 записи */
        $this->assertTrue(count($list) == 4);
    }

    /** Тестируем выборку записи на обновление */
    public function testEdit()
    {
        /** Выбираем одну из записей, представленных в фикстурах */
        $log_row = ApiSearchLogs::findOne([ApiSearchLogs::ATTR_ID => 3]);

        /** Проводит валидацию атрибутов данных, полученных из фикстуры */
        $this->_validateAttributes($log_row);
    }

    /** Тестируем получение всех записей (select) */
    public function testList()
    {
        /** Выбираем все записи */
        $list = ApiSearchLogs::find()->all();

        /** Ожидаем получить из фикстур - 3 записи */
        $this->assertTrue(count($list) == 3);
    }

    /** Тестируем удаление объекта */
    public function testDelete()
    {
        /** Выбираем одну из записей, представленных в фикстурах */
        $log_row = ApiSearchLogs::findOne([ApiSearchLogs::ATTR_ID => 3]);

        /** Удаляем запись */
        $log_row->delete();

        /** Получаем список всех записей */
        $list = ApiSearchLogs::find()->all();

        /** Ожидаем получить из фикстур - 2 записи */
        $this->assertTrue(count($list) == 2);
    }
}