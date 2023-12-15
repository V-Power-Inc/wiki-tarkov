<?php
/**
 * Created by PhpStorm.
 * User: PC_Principal
 * Date: 03.01.2023
 * Time: 12:04
 * 
 * Unit тесты для таблицы Clans (Сделано через промежуточную модель из за рекапчи)
 */

namespace app\tests;

use app\models\ClansForUnit;
use app\tests\fixtures\ClansFixture;
use app\common\helpers\validators\StringValidator;

/**
 * Class ClansTest
 * @package models
 *
 * @see https://codeception.com/docs/UnitTests
 * @see https://www.yiiframework.com/doc/guide/2.0/ru/test-fixtures
 */
class ClansTest extends \Codeception\Test\Unit
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
            'clans' => [
                'class' => ClansFixture::class,
                'dataFile' => codecept_data_dir() . 'clans.php'
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
        $list = [ClansForUnit::ATTR_TITLE, ClansForUnit::ATTR_DESCRIPTION];

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
        $list = [ClansForUnit::ATTR_ID, ClansForUnit::ATTR_MODERATED];

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
        $list_hundred = [ClansForUnit::ATTR_TITLE];
        
        /** Список атрибутов на валидацию - длина 255 символов */
        $list_main = [ClansForUnit::ATTR_DESCRIPTION];
        
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
        $item = new ClansForUnit();

        /** Валидируем все атрибуты AR объекта*/
        $this->_validateAttributes($item);

        /** Значения на сохранение нового объекта */
        $values = [
            ClansForUnit::ATTR_ID            => 4,
            ClansForUnit::ATTR_DESCRIPTION   => 'Secondary desc of clan',
            ClansForUnit::ATTR_TITLE         => 'Second clan',
            ClansForUnit::ATTR_PREVIEW       => 'https://sometest.ru/image_prev.png',
            ClansForUnit::ATTR_LINK          => 'https://sometest.ru',
            ClansForUnit::ATTR_MODERATED     => 0
        ];

        /** Сетапим атрибуты AR объекту */
        $item->setAttributes($values);

        /** Валидируем атрибуты */
        $item->validate();

        /** Ожидаем что запись сохранилась */
        $this->assertTrue($item->save(), 'Ожидалось true - объект не сохранился.');

        /** Выбираем все записи */
        $list = ClansForUnit::find()->all();

        /** Ожидаем что всего будет 4 записи */
        $this->assertTrue(count($list) == 4);
    }

    /** Тестируем выборку записи на обновление */
    public function testEdit()
    {
        /** Выбираем одну из записей, представленных в фикстурах */
        $item = ClansForUnit::findOne([ClansForUnit::ATTR_ID => 3]);

        /** Проводит валидацию атрибутов данных, полученных из фикстуры */
        $this->_validateAttributes($item);
    }

    /** Тестируем получение всех записей (select) */
    public function testList()
    {
        /** Выбираем все записи */
        $list = ClansForUnit::find()->all();

        /** Ожидаем получить из фикстур - 3 записи */
        $this->assertTrue(count($list) == 3);
    }

    /** Тестируем получение всех записей - только промодерированных (select) */
    public function testSelectModeratedRows()
    {
        /** Выбираем все записи - только промодерированные */
        $list = ClansForUnit::find()
            ->where([ClansForUnit::ATTR_MODERATED => 1])
            ->all();

        /** Ожидаем получить из фикстур - 2 записи */
        $this->assertTrue(count($list) == 2);
    }

    /** Тестируем получение всех записей - только промодерированных и с описанием (select) */
    public function testSelectModeratedRowsWithDescription()
    {
        /** Выбираем все записи - только промодерированные и с урлом */
        $list = ClansForUnit::find()
            ->where([ClansForUnit::ATTR_MODERATED => 1])
            ->andWhere(['is not', ClansForUnit::ATTR_DESCRIPTION, null])
            ->all();

        /** Ожидаем получить из фикстур - 2 записи */
        $this->assertTrue(count($list) == 2);
    }

    /** Тестируем получение всех записей - только промодерированных и с линком (select) */
    public function testSelectModeratedRowsWithLink()
    {
        /** Выбираем все записи - только промодерированные и с урлом */
        $list = ClansForUnit::find()
            ->where([ClansForUnit::ATTR_MODERATED => 1])
            ->andWhere(['is not', ClansForUnit::ATTR_LINK, null])
            ->all();

        /** Ожидаем получить из фикстур - 1 запись */
        $this->assertTrue(count($list) == 1);
    }

    /** Тестируем получение всех записей - только промодерированных и с превью (select) */
    public function testSelectModeratedRowsWithPreview()
    {
        /** Выбираем все записи - только промодерированные и с урлом */
        $list = ClansForUnit::find()
            ->where([ClansForUnit::ATTR_MODERATED => 1])
            ->andWhere(['is not', ClansForUnit::ATTR_PREVIEW, null])
            ->all();

        /** Ожидаем получить из фикстур - 2 записи */
        $this->assertTrue(count($list) == 2);
    }

    /** Тестируем получение всех записей - только промодерированных и с превью и урлом (select) */
    public function testSelectModeratedRowsWithPreviewAndLink()
    {
        /** Выбираем все записи - только промодерированные и с урлом */
        $list = ClansForUnit::find()
            ->where([ClansForUnit::ATTR_MODERATED => 1])
            ->andWhere(['is not', ClansForUnit::ATTR_LINK, null])
            ->andWhere(['is not', ClansForUnit::ATTR_PREVIEW, null])
            ->all();

        /** Ожидаем получить из фикстур - 1 запись */
        $this->assertTrue(count($list) == 1);
    }

    /** Тестируем получение всех записей - только промодерированных и с превью, урлом и описанием (select) */
    public function testSelectModeratedRowsWithPreviewAndLinkAndDescription()
    {
        /** Выбираем все записи - только промодерированные и с урлом */
        $list = ClansForUnit::find()
            ->where([ClansForUnit::ATTR_MODERATED => 1])
            ->andWhere(['is not', ClansForUnit::ATTR_LINK, null])
            ->andWhere(['is not', ClansForUnit::ATTR_PREVIEW, null])
            ->andWhere(['is not', ClansForUnit::ATTR_DESCRIPTION, null])
            ->all();

        /** Ожидаем получить из фикстур - 1 запись */
        $this->assertTrue(count($list) == 1);
    }

    /** Тестируем получение всех записей - только отклоненных (select) */
    public function testSelectNotModeratedRows()
    {
        /** Выбираем все записи - только промодерированные */
        $list = ClansForUnit::find()
            ->where([ClansForUnit::ATTR_MODERATED => 0])
            ->all();

        /** Ожидаем получить из фикстур - 2 записи */
        $this->assertTrue(count($list) == 1);
    }

    /** Тестируем получение всех записей - только промодерированных и с описанием (select) */
    public function testSelectNotModeratedRowsWithDescription()
    {
        /** Выбираем все записи - только промодерированные и с урлом */
        $list = ClansForUnit::find()
            ->where([ClansForUnit::ATTR_MODERATED => 0])
            ->andWhere(['is not', ClansForUnit::ATTR_DESCRIPTION, null])
            ->all();

        /** Ожидаем получить из фикстур - 1 запись */
        $this->assertTrue(count($list) == 1);
    }

    /** Тестируем получение всех записей - только промодерированных и с линком (select) */
    public function testSelectNotModeratedRowsWithLink()
    {
        /** Выбираем все записи - только промодерированные и с урлом */
        $list = ClansForUnit::find()
            ->where([ClansForUnit::ATTR_MODERATED => 0])
            ->andWhere(['is not', ClansForUnit::ATTR_LINK, null])
            ->all();

        /** Ожидаем получить из фикстур - 1 запись */
        $this->assertTrue(count($list) == 1);
    }

    /** Тестируем получение всех записей - только промодерированных и с превью (select) */
    public function testSelectNotModeratedRowsWithPreview()
    {
        /** Выбираем все записи - только промодерированные и с урлом */
        $list = ClansForUnit::find()
            ->where([ClansForUnit::ATTR_MODERATED => 0])
            ->andWhere(['is not', ClansForUnit::ATTR_PREVIEW, null])
            ->all();

        /** Ожидаем получить из фикстур - 1 запись */
        $this->assertTrue(count($list) == 1);
    }

    /** Тестируем получение всех записей - только промодерированных и с превью и урлом (select) */
    public function testSelectNotModeratedRowsWithPreviewAndLink()
    {
        /** Выбираем все записи - только промодерированные и с урлом */
        $list = ClansForUnit::find()
            ->where([ClansForUnit::ATTR_MODERATED => 0])
            ->andWhere(['is not', ClansForUnit::ATTR_LINK, null])
            ->andWhere(['is not', ClansForUnit::ATTR_PREVIEW, null])
            ->all();

        /** Ожидаем получить из фикстур - 1 запись */
        $this->assertTrue(count($list) == 1);
    }

    /** Тестируем получение всех записей - только промодерированных и с превью, урлом и описанием (select) */
    public function testSelectNotModeratedRowsWithPreviewAndLinkAndDescription()
    {
        /** Выбираем все записи - только промодерированные и с урлом */
        $list = ClansForUnit::find()
            ->where([ClansForUnit::ATTR_MODERATED => 0])
            ->andWhere(['is not', ClansForUnit::ATTR_LINK, null])
            ->andWhere(['is not', ClansForUnit::ATTR_PREVIEW, null])
            ->andWhere(['is not', ClansForUnit::ATTR_DESCRIPTION, null])
            ->all();

        /** Ожидаем получить из фикстур - 1 запись */
        $this->assertTrue(count($list) == 1);
    }

    /** Тестируем удаление объекта */
    public function testDelete()
    {
        /** Выбираем одну из записей, представленных в фикстурах */
        $item = ClansForUnit::findOne([ClansForUnit::ATTR_ID => 3]);

        /** Удаляем запись */
        $item->delete();

        /** Получаем список всех записей */
        $list = ClansForUnit::find()->all();

        /** Ожидаем получить из фикстур - 2 записи */
        $this->assertTrue(count($list) == 2);
    }
}