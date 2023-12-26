<?php
/**
 * Created by PhpStorm.
 * User: PC_Principal
 * Date: 16.12.2023
 * Time: 16:46
 */

namespace app\tests;

use app\models\News;
use app\common\helpers\validators\StringValidator;
use app\tests\fixtures\NewsFixture;

/**
 * Unit тесты новостей
 *
 * Class NewsTest
 * @package models
 *
 * @see https://codeception.com/docs/UnitTests
 * @see https://www.yiiframework.com/doc/guide/2.0/ru/test-fixtures
 */
class NewsTest extends \Codeception\Test\Unit
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
            'news' => [
                'class' => NewsFixture::class,
                'dataFile' => codecept_data_dir() . 'news.php'
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
        $list = [News::ATTR_TITLE, News::ATTR_DESCRIPTION, News::ATTR_SHORTDESC, News::ATTR_KEYWORDS];

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
        $list = [News::ATTR_ID, News::ATTR_ENABLED];

        /** Проходим в цикле список атрибутов */
        foreach ($list as $item) {

            /** Пробуем засетапить в числовой атрибут - строку */
            $this->_validateAttribute($model, $item, 'a');
        }
    }

    /** Метод для валидации строковых атрибутов */
    protected function _validateStringAttributes($model)
    {
        /** Список атрибутов на валидацию - длина 150 символов */
        $list_hundred_fifty = [News::ATTR_TITLE];

        /** Список атрибутов на валидацию - длина 200 символов */
        $list_two_hundred = [News::ATTR_PREVIEW];

        /** Список атрибутов на валидацию - длина 255 символов */
        $list = [News::ATTR_DESCRIPTION, News::ATTR_KEYWORDS, News::ATTR_URL];

        /** Переменная с пустой строкой */
        $too_long_string = '';

        /** В цикле увеличиваем длину строки, пока не станет 151 символов */
        for ($i = 0; $i < StringValidator::VARCHAR_LENGTH_HUNDRED_FIFTY + 1; $i++) {
            $too_long_string .= 'a';
        }

        /** Проходим в цикле список атрибутов - длина строки 151 символов */
        foreach ($list_hundred_fifty as $item) {

            /** Валидируем каждый из них */
            $this->_validateAttribute($model, $item, $too_long_string);
        }

        /** В цикле увеличиваем длину строки, пока не станет 201 символов */
        for ($i = 0; $i < StringValidator::VARCHAR_LENGTH_TWO_HUNDRED + 1; $i++) {
            $too_long_string .= 'a';
        }

        /** Проходим в цикле список атрибутов - длина строки 201 символов */
        foreach ($list_two_hundred as $item) {

            /** Валидируем каждый из них */
            $this->_validateAttribute($model, $item, $too_long_string);
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
        $task = new News();

        /** Валидируем все атрибуты AR объекта*/
        $this->_validateAttributes($task);

        /** Значения на сохранение нового объекта */
        $values = [
            News::ATTR_ID => 4,
            News::ATTR_TITLE => 'Тестовый материал',
            News::ATTR_URL => 'test-article-url',
            News::ATTR_PREVIEW => '/img/admin/resized/sanatoriy_bereg300118044100.png',
            News::ATTR_DESCRIPTION => 'Корпуса санатория "Лазурный берег". Как понять, где западный и восточный корпуса на локации Берег.',
            News::ATTR_KEYWORDS => 'санаторий на локации Берег, западное крыло санатория, восточное крыло санатория, западный корпус санатория, восточный корпус санатория.',
            News::ATTR_SHORTDESC => 'Как понять, какой из корпусов западаный, а какой восточный. Эта информация особенно необходима при прохождении квестов Миротворца.',
            News::ATTR_CONTENT => '<p><span style="font-size:16px">В Escape from Tarkov очень много элементов реалистичного шутера в связи с этим и очень большое количество горячих клавиш.</span></p><p><span style="font-size:16px">Все доступные горячие клавиши и примеры их использования в управлении персонажем&nbsp;можно узнать по <strong><a href="#" target="_blank">этой ссылке</a></strong>.</span></p>',
            News::ATTR_ENABLED => 1,
        ];

        /** Сетапим атрибуты AR объекту */
        $task->setAttributes($values);

        /** Валидируем атрибуты */
        $task->validate();

        /** Ожидаем что запись сохранилась */
        $this->assertTrue($task->save(), 'Ожидалось true - объект не сохранился.');

        /** Выбираем все записи */
        $list = News::find()->all();

        /** Ожидаем что всего будет 4 записи */
        $this->assertTrue(count($list) == 4);
    }

    /** Тестируем выборку записи на обновление */
    public function testEdit()
    {
        /** Выбираем одну из записей, представленных в фикстурах */
        $task = News::findOne([News::ATTR_ID => 3]);

        /** Проводит валидацию атрибутов данных, полученных из фикстуры */
        $this->_validateAttributes($task);
    }

    /** Тестируем получение всех записей (select) */
    public function testList()
    {
        /** Выбираем все записи */
        $list = News::find()->all();

        /** Ожидаем получить из фикстур - 3 записи */
        $this->assertTrue(count($list) == 3);
    }

    /** Тестируем получение всех активных записей (select) */
    public function testSelectActiveRows()
    {
        /** Выбираем все записи */
        $list = News::find()->where([News::ATTR_ENABLED => News::TRUE])->all();

        /** Ожидаем получить из фикстур - 2 записи */
        $this->assertTrue(count($list) == 2);
    }

    /** Тетсируем получение 1 активной статьи по URL адресу (select) */
    public function testSelectSingleActiveRowByUrl()
    {
        /** Выбираем все записи */
        $item = News::find()
            ->where([News::ATTR_URL => 'sanatoriy-korpusa'])
            ->andWhere([News::ATTR_ENABLED => News::TRUE])
            ->one();

        /** Ожидаем получить из фикстур - 1 запись */
        $this->assertTrue(!empty($item));
    }

    /** Тестируем получение всех неактивных записей (select) */
    public function testSelectDisabledRows()
    {
        /** Выбираем все записи */
        $list = News::find()->where([News::ATTR_ENABLED => News::FALSE])->all();

        /** Ожидаем получить из фикстур - 3 записи */
        $this->assertTrue(count($list) == 1);
    }

    /** Тестируем удаление объекта */
    public function testDelete()
    {
        /** Выбираем одну из записей, представленных в фикстурах */
        $task = News::findOne([News::ATTR_ID => 3]);

        /** Удаляем запись */
        $task->delete();

        /** Получаем список всех записей */
        $list = News::find()->all();

        /** Ожидаем получить из фикстур - 2 записи */
        $this->assertTrue(count($list) == 2);
    }
}