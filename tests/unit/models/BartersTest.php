<?php
/**
 * Created by PhpStorm.
 * User: PC_Principal
 * Date: 17.12.2023
 * Time: 23:55
 */

namespace app\tests;

use app\models\Barters;
use app\tests\fixtures\BartersFixture;
use app\common\helpers\validators\StringValidator;
use UnitTester;

/**
 * Unit тесты для API страниц боссов
 *
 * Class BartersTest
 * @package models
 *
 * @see https://codeception.com/docs/UnitTests
 * @see https://www.yiiframework.com/doc/guide/2.0/ru/test-fixtures
 */
class BartersTest extends \Codeception\Test\Unit
{
    /** Объект класса для тестирования */
    protected UnitTester $tester;

    /** Метод выполняется перед каждым тестом */
    protected function _before()
    {
        /** Грузим фикстуры перед каждым тестом */
        $this->tester->haveFixtures([
            'barters' => [
                'class' => BartersFixture::class,
                'dataFile' => codecept_data_dir() . 'barters.php'
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
        $list = [Barters::ATTR_TITLE, Barters::ATTR_TRADER_GROUP, Barters::ATTR_SITE_TITLE];

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
        $list = [Barters::ATTR_ID, Barters::ATTR_ENABLED];

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
        $list_main = [Barters::ATTR_TITLE, Barters::ATTR_TRADER_GROUP, Barters::ATTR_SITE_TITLE];

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
        $item = new Barters();

        /** Валидируем все атрибуты AR объекта*/
        $this->_validateAttributes($item);

        /** Значения на сохранение нового объекта */
        $values = [
            Barters::ATTR_ID           => 4,
            Barters::ATTR_TITLE        => 'Барахольщик - 1 уровень',
            Barters::ATTR_CONTENT      => '<ul><li><span style="font-size:16px">Разнообразие <a href="https://wiki-tarkov.ru/loot/ammunition" target="_blank">патронов</a> для <a href="https://wiki-tarkov.ru/loot/weapons/pistols" target="_blank">пистолетов</a> и <a href="https://wiki-tarkov.ru/loot/weapons/submachine-guns" target="_blank">пистолетов-пулеметов</a>.</span></li><li><span style="font-size:16px"><a href="https://wiki-tarkov.ru/loot/marker.html" target="_blank">Маркер MS2000</a> -&nbsp;необходим для заданий, где нужно заложить маячок.</span></li><li><span style="font-size:16px">В продаже появляются <a href="https://wiki-tarkov.ru/loot/ammunition" target="_blank">патроны</a> <a href="https://wiki-tarkov.ru/loot/ammunition/5-45-39" target="_blank">5.45x39 мм</a>&nbsp;<a href="https://wiki-tarkov.ru/loot/5-45-39-ps.html" style="box-sizing: border-box; background-color: transparent; color: rgb(51, 122, 183); text-decoration-line: none;">ПС</a>&nbsp;при завершенном квесте &quot;<a href="https://wiki-tarkov.ru/quests-of-traders/prapor-quests#4" style="box-sizing: border-box; background-color: transparent; color: rgb(51, 122, 183); text-decoration-line: none;">Посылка из прошлого</a>&quot;.</span></li><li><span style="font-size:16px"><a href="https://wiki-tarkov.ru/loot/tactec-rig.html" target="_blank">Бронеразгрузка TacTec</a> в обмен на предметы.</span></li><li><span style="font-size:16px"><a href="https://wiki-tarkov.ru/loot/mosinka.html" target="_blank">Винтовка системы Мосина</a> за рубли и в обмен на предметы.</span></li></ul>',
            Barters::ATTR_ENABLED      => 1,
            Barters::ATTR_SITE_TITLE   => 'УЛ 1',
            Barters::ATTR_TRADER_GROUP => 'Барахольщик'
        ];

        /** Сетапим атрибуты AR объекту */
        $item->setAttributes($values);

        /** Валидируем атрибуты */
        $item->validate();

        /** Ожидаем что запись сохранилась */
        $this->assertTrue($item->save(), 'Ожидалось true - объект не сохранился.');

        /** Выбираем все записи */
        $list = Barters::find()->all();

        /** Ожидаем что всего будет 4 записи */
        $this->assertTrue(count($list) == 4);
    }

    /** Тестируем выборку записи на обновление */
    public function testEdit()
    {
        /** Выбираем одну из записей, представленных в фикстурах */
        $item = Barters::findOne([Barters::ATTR_ID => 3]);

        /** Проводит валидацию атрибутов данных, полученных из фикстуры */
        $this->_validateAttributes($item);
    }

    /** Тестируем получение всех записей (select) */
    public function testList()
    {
        /** Выбираем все записи */
        $list = Barters::find()->all();

        /** Ожидаем получить из фикстур - 3 записи */
        $this->assertTrue(count($list) == 3);
    }

    /** Тестируем выборку только активных записей */
    public function testSelectActiveRows()
    {
        /** Выбираем все записи только активные */
        $list = Barters::find()->where([Barters::ATTR_ENABLED => Barters::TRUE])->all();

        /** Ожидаем получить из фикстур - 2 записи */
        $this->assertTrue(count($list) == 2);
    }

    /** Тестируем выборку только активных записей */
    public function testSelectActiveRowsByTraderGroup()
    {
        /** Выбираем все записи только активные */
        $list = Barters::find()
            ->where([Barters::ATTR_TRADER_GROUP => 'Прапор'])
            ->where([Barters::ATTR_ENABLED => Barters::TRUE])
            ->all();

        /** Ожидаем получить из фикстур - 2 записи */
        $this->assertTrue(count($list) == 2);
    }

    /** Тестируем удаление объекта */
    public function testDelete()
    {
        /** Выбираем одну из записей, представленных в фикстурах */
        $item = Barters::findOne([Barters::ATTR_ID => 3]);

        /** Удаляем запись */
        $item->delete();

        /** Получаем список всех записей */
        $list = Barters::find()->all();

        /** Ожидаем получить из фикстур - 2 записи */
        $this->assertTrue(count($list) == 2);
    }
}