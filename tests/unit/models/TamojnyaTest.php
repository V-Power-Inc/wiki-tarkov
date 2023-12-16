<?php

namespace app\tests;

use app\models\Tamojnya;
use app\tests\fixtures\TamojnyaFixture;
use app\common\helpers\validators\StringValidator;

/**
 * Unit тесты интерактивных маркеров Таможни
 *
 * Class TamojnyaTest
 * @package models
 *
 * @see https://codeception.com/docs/UnitTests
 * @see https://www.yiiframework.com/doc/guide/2.0/ru/test-fixtures
 */
class TamojnyaTest extends \Codeception\Test\Unit
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
            'tamojnya' => [
                'class' => TamojnyaFixture::class,
                'dataFile' => codecept_data_dir() . 'tamojnya.php'
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
        $list = [Tamojnya::ATTR_NAME];

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
        $list = [Tamojnya::ATTR_ID, Tamojnya::ATTR_COORDS_X, Tamojnya::ATTR_COORDS_Y, Tamojnya::ATTR_ENABLED, Tamojnya::ATTR_EXIT_ANYWAY];

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
        $list_fifty = [Tamojnya::ATTR_MARKER_GROUP];

        /** Список атрибутов на валидацию - длина 100 символов */
        $list_hundred = [Tamojnya::ATTR_NAME, Tamojnya::ATTR_EXITS_GROUP];

        /** Список атрибутов на валидацию - длина 255 символов */
        $list_main = [Tamojnya::ATTR_CUSTOMICON];

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
        $marker = new Tamojnya();

        /** Валидируем все атрибуты AR объекта*/
        $this->_validateAttributes($marker);

        /** Значения на сохранение нового объекта */
        $values = [
            Tamojnya::ATTR_ID => 4,
            Tamojnya::ATTR_NAME => 'Ящик у выхода с локации',
            Tamojnya::ATTR_MARKER_GROUP => 'Военные ящики',
            Tamojnya::ATTR_COORDS_X => 10,
            Tamojnya::ATTR_COORDS_Y => -135,
            Tamojnya::ATTR_CONTENT => '<p>Это основной выход с локации Завод, если у вас нет ключа от выхода с завода - это ваш единственный способ выйти с карты.</p><p><img alt="Основной выход с локации Завод. Через него выходит основная часть игроков." src="/img/upload/bereg_images/vihod-s-karty.png" style="width:100%" /></p>',
            Tamojnya::ATTR_ENABLED => 1,
            Tamojnya::ATTR_CUSTOMICON => '/img/admin/beregicons/vorota_3_d.png',
            Tamojnya::ATTR_EXITS_GROUP => 'Спавн на зеленой лампе',
            Tamojnya::ATTR_EXIT_ANYWAY => 1
        ];

        /** Сетапим атрибуты AR объекту */
        $marker->setAttributes($values);

        /** Валидируем атрибуты */
        $marker->validate();

        /** Ожидаем что запись сохранилась */
        $this->assertTrue($marker->save(), 'Ожидалось true - объект не сохранился.');

        /** Выбираем все записи */
        $list = Tamojnya::find()->all();

        /** Ожидаем что всего будет 4 записи */
        $this->assertTrue(count($list) == 4);
    }

    /** Тестируем выборку записи на обновление */
    public function testEdit()
    {
        /** Выбираем одну из записей, представленных в фикстурах */
        $marker = Tamojnya::findOne([Tamojnya::ATTR_ID => 3]);

        /** Проводит валидацию атрибутов данных, полученных из фикстуры */
        $this->_validateAttributes($marker);
    }

    /** Тестируем получение всех записей (select) */
    public function testList()
    {
        /** Выбираем все записи */
        $list = Tamojnya::find()->all();

        /** Ожидаем получить из фикстур - 3 записи */
        $this->assertTrue(count($list) == 3);
    }

    /** Тестируем получение всех записей - только активных (select) */
    public function testSelectActiveRows()
    {
        /** Выбираем все записи - только активные */
        $list = Tamojnya::find()
            ->where([Tamojnya::ATTR_ENABLED => 1])
            ->all();

        /** Ожидаем получить из фикстур - 2 записи */
        $this->assertTrue(count($list) == 2);
    }

    /** Тестируем получение всех записей - только активных и спавнов ЧВК (select) */
    public function testSelectActiveChvkExitsRows()
    {
        /** Выбираем все записи - только активные */
        $list = Tamojnya::find()
            ->where([Tamojnya::ATTR_ENABLED => 1])
            ->andWhere([Tamojnya::ATTR_EXITS_GROUP => 'ЧВК зона'])
            ->all();

        /** Ожидаем получить из фикстур - 1 запись */
        $this->assertTrue(count($list) == 1);
    }

    /** Тестируем получение всех записей - только активных и спавнов Диких (select) */
    public function testSelectActiveDikieExitsRows()
    {
        /** Выбираем все записи - только активные */
        $list = Tamojnya::find()
            ->where([Tamojnya::ATTR_ENABLED => 1])
            ->andWhere([Tamojnya::ATTR_EXITS_GROUP => 'Диких зона'])
            ->all();

        /** Ожидаем получить из фикстур - 1 запись */
        $this->assertTrue(count($list) == 1);
    }

    /** Тестируем получение всех записей - только активных и с кастомной иконкой (select) */
    public function testSelectActiveWithCustomIconRows()
    {
        /** Выбираем все записи - только активные */
        $list = Tamojnya::find()
            ->where([Tamojnya::ATTR_ENABLED => 1])
            ->andWhere(['is not', Tamojnya::ATTR_CUSTOMICON, null])
            ->all();

        /** Ожидаем получить из фикстур - 1 запись */
        $this->assertTrue(count($list) == 1);
    }

    /** Тестируем получение всех записей - только активных и без кастомной иконки (select) */
    public function testSelectActiveWithoutCustomIconRows()
    {
        /** Выбираем все записи - только активные */
        $list = Tamojnya::find()
            ->where([Tamojnya::ATTR_ENABLED => 1])
            ->andWhere(['is', Tamojnya::ATTR_CUSTOMICON, null])
            ->all();

        /** Ожидаем получить из фикстур - 1 запись */
        $this->assertTrue(count($list) == 1);
    }

    /** Тестируем получение всех записей - только активных и с возможностью выходить любой из сторон (select) */
    public function testSelectActiveWithExitsAnywayRows()
    {
        /** Выбираем все записи - только активные */
        $list = Tamojnya::find()
            ->where([Tamojnya::ATTR_ENABLED => 1])
            ->andWhere([Tamojnya::ATTR_EXIT_ANYWAY => 1])
            ->all();

        /** Ожидаем получить из фикстур - 1 запись */
        $this->assertTrue(count($list) == 1);
    }

    /** Тестируем получение всех записей - только активных и без возможности выходить любой из сторон (select) */
    public function testSelectActiveWithoutExitsAnywayRows()
    {
        /** Выбираем все записи - только активные */
        $list = Tamojnya::find()
            ->where([Tamojnya::ATTR_ENABLED => 1])
            ->andWhere([Tamojnya::ATTR_EXIT_ANYWAY => 0])
            ->all();

        /** Ожидаем получить из фикстур - 1 запись */
        $this->assertTrue(count($list) == 1);
    }

    /** Тестируем получение всех записей - только активных и с группой маркеры выходов (select) */
    public function testSelectActiveWithExitsRows()
    {
        /** Выбираем все записи - только активные */
        $list = Tamojnya::find()
            ->where([Tamojnya::ATTR_ENABLED => 1])
            ->andWhere([Tamojnya::ATTR_MARKER_GROUP => 'Маркеры выходов'])
            ->all();

        /** Ожидаем получить из фикстур - 0 записей */
        $this->assertTrue(count($list) == 0);
    }

    /** Тестируем получение всех записей - только активных и с группой военных ящиков (select) */
    public function testSelectActiveWithArmyLootRows()
    {
        /** Выбираем все записи - только активные */
        $list = Tamojnya::find()
            ->where([Tamojnya::ATTR_ENABLED => 1])
            ->andWhere([Tamojnya::ATTR_MARKER_GROUP => 'Военные ящики'])
            ->all();

        /** Ожидаем получить из фикстур - 1 запись */
        $this->assertTrue(count($list) == 1);
    }

    /** Тестируем получение всех записей - только активных и с группой интересных мест (select) */
    public function testSelectActiveWithInterestingPlacesRows()
    {
        /** Выбираем все записи - только активные */
        $list = Tamojnya::find()
            ->where([Tamojnya::ATTR_ENABLED => 1])
            ->andWhere([Tamojnya::ATTR_MARKER_GROUP => 'Интересные места'])
            ->all();

        /** Ожидаем получить из фикстур - 1 запись */
        $this->assertTrue(count($list) == 1);
    }

    /** Тестируем получение всех записей - только активных и с группой спавны за диких (select) */
    public function testSelectActiveWithDikieSpawnsRows()
    {
        /** Выбираем все записи - только активные */
        $list = Tamojnya::find()
            ->where([Tamojnya::ATTR_ENABLED => 1])
            ->andWhere([Tamojnya::ATTR_MARKER_GROUP => 'Спавны диких'])
            ->all();

        /** Ожидаем получить из фикстур - 0 записей */
        $this->assertTrue(count($list) == 0);
    }

    /** Тестируем получение всех записей - только активных и с группой спавны за диких (select) */
    public function testSelectActiveWithChvkSpawnsRows()
    {
        /** Выбираем все записи - только активные */
        $list = Tamojnya::find()
            ->where([Tamojnya::ATTR_ENABLED => 1])
            ->andWhere([Tamojnya::ATTR_MARKER_GROUP => 'Спавны игроков ЧВК'])
            ->all();

        /** Ожидаем получить из фикстур - 0 записей */
        $this->assertTrue(count($list) == 0);
    }

    /** Тестируем получение всех записей - только активных и с группой квестовые точки (select) */
    public function testSelectActiveWithQuestsRows()
    {
        /** Выбираем все записи - только активные */
        $list = Tamojnya::find()
            ->where([Tamojnya::ATTR_ENABLED => 1])
            ->andWhere([Tamojnya::ATTR_MARKER_GROUP => 'Квестовые точки'])
            ->all();

        /** Ожидаем получить из фикстур - 0 записей */
        $this->assertTrue(count($list) == 0);
    }

    /** Тестируем получение всех записей - только активных и с группой точки с ключами (select) */
    public function testSelectActiveWithKeysRows()
    {
        /** Выбираем все записи - только активные */
        $list = Tamojnya::find()
            ->where([Tamojnya::ATTR_ENABLED => 1])
            ->andWhere([Tamojnya::ATTR_MARKER_GROUP => 'Маркеры ключей'])
            ->all();

        /** Ожидаем получить из фикстур - 0 записей */
        $this->assertTrue(count($list) == 0);
    }

    /** Тестируем получение всех записей - только активных (select) */
    public function testSelectDisabledRows()
    {
        /** Выбираем все записи - только активные */
        $list = Tamojnya::find()
            ->where([Tamojnya::ATTR_ENABLED => 1])
            ->all();

        /** Ожидаем получить из фикстур - 2 записи */
        $this->assertTrue(count($list) == 2);
    }

    /** Тестируем удаление объекта */
    public function testDelete()
    {
        /** Выбираем одну из записей, представленных в фикстурах */
        $marker = Tamojnya::findOne([Tamojnya::ATTR_ID => 3]);

        /** Удаляем запись */
        $marker->delete();

        /** Получаем список всех записей */
        $list = Tamojnya::find()->all();

        /** Ожидаем получить из фикстур - 2 записи */
        $this->assertTrue(count($list) == 2);
    }
}