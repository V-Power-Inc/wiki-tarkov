<?php
/**
 * Created by PhpStorm
 * User: PC_Principal
 * Date: 30.08.2022
 * Time: 12:41
 */

namespace app\tests;

use app\models\Items;
use app\tests\fixtures\CategoryFixture;
use app\common\helpers\validators\StringValidator;
use app\tests\fixtures\ItemsFixture;

/**
 * UNIT тестирование модели справочника лута
 *
 * // TODO: Доделать методы (Можно выбирать активные записи, старые записи и так далее - тут есть что пилить)
 *
 * Class ItemsTest
 * @package models
 */
class ItemsTest extends \Codeception\Test\Unit
{
    /**
     * @var \UnitTester
     */
    protected $tester;

    /** Метод выполняется перед каждым тестом */
    public function _before()
    {
        /** Грузим фикстуры перед каждым тестом (Фикстура категории и лута) */
        $this->tester->haveFixtures([
            'category' => [
                'class' => CategoryFixture::class,
                'dataFile' => codecept_data_dir() . 'category.php'
            ],
            'items' => [
                'class' => ItemsFixture::class,
                'dataFile' => codecept_data_dir() . 'items.php'
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
        $list = [Items::ATTR_TITLE, Items::ATTR_SHORTDESC, Items::ATTR_URL, Items::ATTR_DESCRIPTION, Items::ATTR_CREATOR];

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
        $list = [Items::ATTR_ID, Items::ATTR_ACTIVE, Items::ATTR_PARENTCAT_ID];

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
        $list_main = [Items::ATTR_TITLE, Items::ATTR_CREATOR, Items::ATTR_PREVIEW];

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

    /** Тестируем создание нового маркера */
    public function testCreation()
    {
        /** Создаем новый объект AR */
        $item = new Items();

        /** Валидируем все атрибуты AR объекта*/
        $this->_validateAttributes($item);

        /** Значения на сохранение нового объекта */
        $values = [
            Items::ATTR_ID            => 4,
            Items::ATTR_TITLE         => 'Тестовый предмет справочника лута',
            Items::ATTR_PREVIEW       => '/item/preview.png',
            Items::ATTR_SHORTDESC     => 'Короткое описание предмета справочника в списке категорий',
            Items::ATTR_CONTENT       => '<p>Детальное содержание объекта лута - тут выводится все содержимое</p>',
            Items::ATTR_URL           => 'testoviy-loot',
            Items::ATTR_DESCRIPTION   => 'Seo описание карточки лута',
            Items::ATTR_KEYWORDS      => 'Seo ключевые слова лута',
            Items::ATTR_PARENTCAT_ID  => 2, // Категория из фикстуры
            Items::ATTR_ACTIVE        => 1,
            Items::ATTR_QUEST_ITEM    => 0,
            Items::ATTR_TRADER_GROUP  => null,
            Items::ATTR_SEARCH_WORDS  => 'Тест, синоним, оригинал',
            Items::ATTR_MODULE_WEAPON => null,
            Items::ATTR_CREATOR       => 'PC_Principal'
        ];

        /** Сетапим атрибуты AR объекту */
        $item->setAttributes($values);

        /** Валидируем атрибуты */
        $item->validate();

        /** Ожидаем что запись сохранилась */
        $this->assertTrue($item->save(), 'Ожидалось true - объект не сохранился.');

        /** Выбираем все записи */
        $list = Items::find()->all();

        /** Ожидаем что всего будет 4 записи */
        $this->assertTrue(count($list) == 4);
    }
    
    /** Тестируем выборку маркера на обновление */
    public function testEdit()
    {
        /** Выбираем одну из записей, представленных в фикстурах */
        $item = Items::findOne([Items::ATTR_ID => 3]);

        /** Проводит валидацию атрибутов данных, полученных из фикстуры */
        $this->_validateAttributes($item);
    }

    /** Тестируем получение всех записей (select) */
    public function testList()
    {
        /** Выбираем все записи */
        $list = Items::find()->all();

        /** Ожидаем получить из фикстур - 3 записи */
        $this->assertTrue(count($list) == 3);
    }

    /** Тестируем удаление объекта */
    public function testDelete()
    {
        /** Выбираем одну из записей, представленных в фикстурах */
        $item = Items::findOne([Items::ATTR_ID => 3]);

        /** Удаляем запись */
        $item->delete();

        /** Получаем список всех записей */
        $list = Items::find()->all();

        /** Ожидаем получить из фикстур - 2 записи */
        $this->assertTrue(count($list) == 2);
    }
}