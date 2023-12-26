<?php
/**
 * Created by PhpStorm.
 * User: PC_Principal
 * Date: 18.12.2023
 * Time: 22:29
 */

namespace app\tests;

use app\models\Skills;
use app\tests\fixtures\SkillsFixture;
use app\tests\fixtures\CatskillsFixture;
use app\common\helpers\validators\StringValidator;

/**
 * UNIT тестирование Active Record модели категорий для объекта справочника умений
 *
 * Class SkillsTest
 * @package models
 *
 * @see https://codeception.com/docs/UnitTests
 * @see https://www.yiiframework.com/doc/guide/2.0/ru/test-fixtures
 */
class SkillsTest extends \Codeception\Test\Unit
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
            'catskills' => [
                'class' => CatskillsFixture::class,
                'dataFile' => codecept_data_dir() . 'catskills.php'
            ],
            'skills' => [
                'class' => SkillsFixture::class,
                'dataFile' => codecept_data_dir() . 'skills.php'
            ],
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
        $list = [Skills::ATTR_ID, Skills::ATTR_CATEGORY, Skills::ATTR_ENABLED];

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
        $list_main = [Skills::ATTR_TITLE, Skills::ATTR_URL, Skills::ATTR_DESCRIPTION, Skills::ATTR_KEYWORDS, Skills::ATTR_PREVIEW];

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

    /** Тестируем создание основной категории */
    public function testCreation()
    {
        /** Создаем новый объект AR */
        $item = new Skills();

        /** Валидируем все атрибуты AR объекта*/
        $this->_validateAttributes($item);

        /** Значения на сохранение нового объекта */
        $values = [
            Skills::ATTR_ID => 4,
            Skills::ATTR_TITLE => 'Новое умениу',
            Skills::ATTR_URL => 'new-skill-on',
            Skills::ATTR_CATEGORY => 2,
            Skills::ATTR_PREVIEW => '/img/admin/resized/field-medicine280218082841.png',
            Skills::ATTR_CONTENT => '<p>Описание нового умения</p>',
            Skills::ATTR_DESCRIPTION => 'Seo описание новой основной категории',
            Skills::ATTR_KEYWORDS => 'Основная категория, лут, тесты',
            Skills::ATTR_ENABLED => 1
        ];

        /** Сетапим атрибуты AR объекту */
        $item->setAttributes($values);

        /** Валидируем атрибуты */
        $item->validate();

        /** Ожидаем что запись сохранилась */
        $this->assertTrue($item->save(), 'Ожидалось true - объект не сохранился.');

        /** Выбираем все записи */
        $list = Skills::find()->all();

        /** Ожидаем что всего будет 4 записи */
        $this->assertTrue(count($list) == 4);
    }

    /** Тестируем выборку записи на обновление */
    public function testEdit()
    {
        /** Выбираем одну из записей, представленных в фикстурах */
        $item = Skills::findOne([Skills::ATTR_ID => 3]);

        /** Проводит валидацию атрибутов данных, полученных из фикстуры */
        $this->_validateAttributes($item);
    }

    /** Тестируем получение всех записей (select) */
    public function testList()
    {
        /** Выбираем все записи */
        $list = Skills::find()->all();

        /** Ожидаем получить из фикстур - 3 записи */
        $this->assertTrue(count($list) == 3);
    }

    /** Тестируем выборку только активных записей */
    public function testSelectActiveRows()
    {
        /** Выбираем все записи - только среди активных */
        $list = Skills::find()->where([Skills::ATTR_ENABLED => Skills::TRUE])->all();

        /** Ожидаем получить из фикстур - 2 записи */
        $this->assertTrue(count($list) == 2);
    }

    /** Тестируем выборку только отключенных записей */
    public function testSelectDisabledRows()
    {
        /** Выбираем все записи - только среди активных */
        $list = Skills::find()->where([Skills::ATTR_ENABLED => Skills::FALSE])->all();

        /** Ожидаем получить из фикстур - 1 записи */
        $this->assertTrue(count($list) == 1);
    }

    /** Тестируем удаление объекта */
    public function testDelete()
    {
        /** Выбираем одну из записей, представленных в фикстурах */
        $item = Skills::findOne([Skills::ATTR_ID => 3]);

        /** Удаляем запись */
        $item->delete();

        /** Получаем список всех записей */
        $list = Skills::find()->all();

        /** Ожидаем получить из фикстур - 2 записи */
        $this->assertTrue(count($list) == 2);
    }
}