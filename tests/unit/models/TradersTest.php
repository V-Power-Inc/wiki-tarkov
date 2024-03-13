<?php
/**
 * Created by PhpStorm.
 * User: PC_Principal
 * Date: 16.12.2023
 * Time: 17:28
 */

namespace app\tests;

use app\models\Traders;
use app\tests\fixtures\TradersFixture;
use app\common\helpers\validators\StringValidator;
use UnitTester;

/**
 * Class TradersTest
 * @package models
 *
 * @see https://codeception.com/docs/UnitTests
 * @see https://www.yiiframework.com/doc/guide/2.0/ru/test-fixtures
 */
class TradersTest extends \Codeception\Test\Unit
{
    /** Объект класса для тестирования */
    protected UnitTester $tester;

    /** Метод выполняется перед каждым тестом */
    public function _before()
    {
        /** Грузим фикстуры перед каждым тестом */
        $this->tester->haveFixtures([
            'traders' => [
                'class' => TradersFixture::class,
                'dataFile' => codecept_data_dir() . 'traders.php'
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
        $list = [Traders::ATTR_TITLE, Traders::ATTR_SORTIR];

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
        $list = [Traders::ATTR_ID, Traders::ATTR_SORTIR, Traders::ATTR_ENABLED];

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
        $list = [
            Traders::ATTR_TITLE,
            Traders::ATTR_PREVIEW,
            Traders::ATTR_URLTOQUETS,
            Traders::ATTR_BUTTON_QUESTS,
            Traders::ATTR_BUTTON_DETAIL,
            Traders::ATTR_DESCRIPTION,
            Traders::ATTR_KEYWORDS,
            Traders::ATTR_URL
        ];

        /** Переменная с пустой строкой */
        $too_long_string = '';

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

    /** Тестируем создание нового маркера */
    public function testCreation()
    {
        /** Создаем новый объект AR */
        $item = new Traders();

        /** Валидируем все атрибуты AR объекта*/
        $this->_validateAttributes($item);

        /** Значения на сохранение нового объекта */
        $values = [
            Traders::ATTR_ID            => 8,
            Traders::ATTR_TITLE         => 'Новый торгаш',
            Traders::ATTR_DESCRIPTION   => 'Custom Desc',
            Traders::ATTR_KEYWORDS      => 'Ключевые слова',
            Traders::ATTR_URL           => 'new-trader',
            Traders::ATTR_URLTOQUETS    => '/quests-of-traders/newtarder-quests',
            Traders::ATTR_BUTTON_QUESTS => 'Перейти в раздел квестов нового торгаша',
            Traders::ATTR_BUTTON_DETAIL => 'Перейти в раздел нового торгаша',
            Traders::ATTR_CONTENT       => '<p><span style="font-size:16px">Этот торговец торгует предметами экипировки, головными уборами и аксессуарами. У Барахольщика также можно приобрести начиная со второго уровня репутации, шлемы, боьшие рюкзаки и разгрузки. Также он продает наушники, как стандартные так и более усовершенствованные.</span></p><p><span style="font-size:16px">На 4 уровне лояльности&nbsp;(корона) вам станут доступны все виды наушников, разгурзок и шлемов. Прокачака репутации стоит в приоритете с этим торговцем, т.к. теперь он продает большую часть серьезной экипировки в игре. Также на 4 уровне репутации у него будут доступны к обмену бронежилет 6Б43 6А (Он же ФОРТ)</span><span style="font-size:16px">, а также можно будет купить.&nbsp;</span></p>',
            Traders::ATTR_PREVIEW       => 'https://sometest.ru/image_prev.png',
            Traders::ATTR_URLTOQUETS    => 'https://sometest.ru',
            Traders::ATTR_SORTIR        => 8,
            Traders::ATTR_FULLCONTENT   => '<p><span style="font-size:16px">С самого зарождения конфликта Скупщик&nbsp;уже начинал действовать, организуя анонимные точки приёма и сбыта товара. Оставаясь инкогнито, смог организовать отлаженную сеть контрабандистов по всей Норвинской области.</span></p><p>&nbsp;</p><p>&nbsp;</p><p>&nbsp;</p><p><span style="font-size:16px">Пара скриншотов того, что можно найти у Скупщика.</span></p><p><span style="font-size:16px"><img alt="" class="image-link" src="/img/upload/traders/skupshik/skupshik.png" style="float:left; margin:5px 15px; width:20%" /><img alt="" class="image-link" src="/img/upload/traders/skupshik/skupshik_2.png" style="float:left; margin:5px 15px; width:20%" /></span></p><p>&nbsp;</p><p>&nbsp;</p><p>&nbsp;</p><p>&nbsp;</p><p>&nbsp;</p><p>&nbsp;</p><p>&nbsp;</p><p>&nbsp;</p><p>&nbsp;</p><p>&nbsp;</p><p>&nbsp;</p><h2><span style="font-size:18px"><strong>Что покупает Скупщик.</strong></span></h2><p><span style="font-size:16px">Скупщик <strong>покупает всё</strong>. Нюанс заключается в том, что <strong>цена</strong>, за которую вы можете продать что-то Скупщику, будет <strong>в 2-3 раза ниже</strong>, чем у других торговцев.​</span></p><h2><span style="font-size:18px"><strong>Что стоит продавать Скупщику.</strong></span></h2><p><span style="font-size:16px">В основном&nbsp;это будут те предметы, которые у вас не купят другие торговцы из-за низкого технического состояния предмета.</span></p><h2><span style="font-size:18px"><strong>Что продаёт Скупщик.</strong></span></h2><p><span style="font-size:16px">В продаже у Скупщика может появиться всё, что угодно. Это может быть ключница, граната Ф-1, шоколад, R11 RSASS, броня 6б43 и т.д. Эти предметы могут появиться в любом техническом состоянии и от этого будет зависеть цена на предмет. <strong>Цена</strong> покупки на все предметы может быть <strong>выше на 15-30%</strong>.</span></p>',
            Traders::ATTR_ENABLED       => Traders::TRUE
        ];

        /** Сетапим атрибуты AR объекту */
        $item->setAttributes($values);

        /** Валидируем атрибуты */
        $item->validate();

        /** Ожидаем что запись сохранилась */
        $this->assertTrue($item->save(), 'Ожидалось true - объект не сохранился.');

        /** Выбираем все записи */
        $list = Traders::find()->all();

        /** Ожидаем что всего будет 8 записи */
        $this->assertTrue(count($list) == 8);
    }

    /** Тестируем выборку записи на обновление */
    public function testEdit()
    {
        /** Выбираем одну из записей, представленных в фикстурах */
        $item = Traders::findOne([Traders::ATTR_ID => 3]);

        /** Проводит валидацию атрибутов данных, полученных из фикстуры */
        $this->_validateAttributes($item);
    }

    /** Тестируем получение всех записей (select) */
    public function testList()
    {
        /** Выбираем все записи */
        $list = Traders::find()->all();

        /** Ожидаем получить из фикстур - 7 записи */
        $this->assertTrue(count($list) == 7);
    }

    /** Тестируем получение всех активных записей (select) */
    public function testSelectActiveRows()
    {
        /** Выбираем все записи */
        $list = Traders::find()->where([Traders::ATTR_ENABLED => Traders::TRUE])->all();

        /** Ожидаем получить из фикстур - 6 записи */
        $this->assertTrue(count($list) == 6);
    }

    /** Тестируем получение одной активной записи по урлу (select) */
    public function testSelectSingleActiveRowByUrl()
    {
        /** Выбираем все записи */
        $item = Traders::find()
            ->where([Traders::ATTR_URL => 'skupshik'])
            ->andWhere([Traders::ATTR_ENABLED => Traders::TRUE])
            ->all();

        /** Ожидаем получить из фикстур - 1 записи */
        $this->assertTrue(!empty($item));
    }

    /** Тестируем удаление объекта */
    public function testDelete()
    {
        /** Выбираем одну из записей, представленных в фикстурах */
        $item = Traders::findOne([Traders::ATTR_ID => 3]);

        /** Удаляем запись */
        $item->delete();

        /** Получаем список всех записей */
        $list = Traders::find()->all();

        /** Ожидаем получить из фикстур - 6 записи */
        $this->assertTrue(count($list) == 6);
    }
}