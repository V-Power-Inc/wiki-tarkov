<?php
/**
 * Created by PhpStorm.
 * User: PC_Principal
 * Date: 29.11.2022
 * Time: 23:51
 */

namespace app\tests;

use app\models\Bosses;
use app\tests\fixtures\BossesFixture;
use app\common\helpers\validators\StringValidator;
use UnitTester;

/**
 * Unit тесты для API страниц боссов
 *
 * Class BossesTest
 * @package models
 *
 * @see https://codeception.com/docs/UnitTests
 * @see https://www.yiiframework.com/doc/guide/2.0/ru/test-fixtures
 */
class BossesTest extends \Codeception\Test\Unit
{
    /** Объект класса для тестирования */
    protected UnitTester $tester;

    /** Метод выполняется перед каждым тестом */
    protected function _before()
    {
        /** Грузим фикстуры перед каждым тестом */
        $this->tester->haveFixtures([
            'bosses' => [
                'class' => BossesFixture::class,
                'dataFile' => codecept_data_dir() . 'bosses.php'
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
        $list = [Bosses::ATTR_ID, Bosses::ATTR_ACTIVE, Bosses::ATTR_OLD];

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
        $list_hundred = [Bosses::ATTR_MAP];

        /** Список атрибутов на валидацию - длина 255 символов */
        $list_main = [Bosses::ATTR_URL];

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
        $item = new Bosses();

        /** Валидируем все атрибуты AR объекта*/
        $this->_validateAttributes($item);

        /** Значения на сохранение нового объекта */
        $values = [
            Bosses::ATTR_ID     => 10,
            Bosses::ATTR_MAP    => 'Новая локация',
            Bosses::ATTR_BOSSES => '[{"name":"Death Knight","spawnChance":0.16,"spawnTrigger":null,"spawnLocations":[{"name":"ScavBase"}],"escorts":[{"amount":[{"count":2}]},{"amount":[{"count":1}]},{"amount":[{"count":1}]}]},{"name":"Решала","spawnChance":0.1,"spawnTrigger":null,"spawnLocations":[{"name":"Dormitory"},{"name":"GasStation"}],"escorts":[{"amount":[{"count":4}]}]},{"name":"Сектант Жрец","spawnChance":0.02,"spawnTrigger":null,"spawnLocations":[{"name":"ScavBase"}],"escorts":[{"amount":[{"count":4}]}]}]',
            Bosses::ATTR_ACTIVE => 1,
            Bosses::ATTR_OLD    => 0,
            Bosses::ATTR_URL    => 'new_location'

        ];

        /** Сетапим атрибуты AR объекту */
        $item->setAttributes($values);

        /** Валидируем атрибуты */
        $item->validate();

        /** Ожидаем что запись сохранилась */
        $this->assertTrue($item->save(), 'Ожидалось true - объект не сохранился.');

        /** Выбираем все записи */
        $list = Bosses::find()->all();

        /** Ожидаем что всего будет 4 записи */
        $this->assertTrue(count($list) == 10);
    }

    /** Тестируем выборку записи на обновление */
    public function testEdit()
    {
        /** Выбираем одну из записей, представленных в фикстурах */
        $item = Bosses::findOne([Bosses::ATTR_ID => 3]);

        /** Проводит валидацию атрибутов данных, полученных из фикстуры */
        $this->_validateAttributes($item);
    }

    /** Тестируем получение всех записей (select) */
    public function testList()
    {
        /** Выбираем все записи */
        $list = Bosses::find()->all();

        /** Ожидаем получить из фикстур - 9 записи */
        $this->assertTrue(count($list) == 9);
    }

    /** Тестируем получение только активных записей - у который не проставлено old - их должно быть 9 */
    public function testSelectActiveRows()
    {
        /** Выбираем все записи */
        $list = Bosses::find()
            ->where([Bosses::ATTR_ACTIVE => Bosses::TRUE])
            ->andWhere([Bosses::ATTR_OLD => Bosses::FALSE])
            ->all();

        /** Ожидаем получить из фикстур - 9 записи */
        $this->assertTrue(count($list) == 9);
    }

    /** Тестируем получение записей с боссами по локации Завод - подразумевается активная запись */
    public function testSelectActiveZavodBossesByMapnameRow()
    {
        /** Ищем запись в соответствии с условием */
        $item = Bosses::find()
            ->where([Bosses::ATTR_MAP => 'Завод'])
            ->andWhere([Bosses::ATTR_ACTIVE => Bosses::TRUE])
            ->andWhere([Bosses::ATTR_OLD => Bosses::FALSE])
            ->one();

        /** Ожидаем получить из искомую запись */
        $this->assertTrue(!empty($item));
    }

    /** Тестируем получение записей с боссами по локации ночной Завод - подразумевается активная запись */
    public function testSelectActiveNightZavodBossesByMapnameRow()
    {
        /** Ищем запись в соответствии с условием */
        $item = Bosses::find()
            ->where([Bosses::ATTR_MAP => 'Ночной Завод'])
            ->andWhere([Bosses::ATTR_ACTIVE => Bosses::TRUE])
            ->andWhere([Bosses::ATTR_OLD => Bosses::FALSE])
            ->one();

        /** Ожидаем получить из искомую запись */
        $this->assertTrue(!empty($item));
    }

    /** Тестируем получение записей с боссами по локации Таможня - подразумевается активная запись */
    public function testSelectActiveTamojnyaBossesByMapnameRow()
    {
        /** Ищем запись в соответствии с условием */
        $item = Bosses::find()
            ->where([Bosses::ATTR_MAP => 'Таможня'])
            ->andWhere([Bosses::ATTR_ACTIVE => Bosses::TRUE])
            ->andWhere([Bosses::ATTR_OLD => Bosses::FALSE])
            ->one();

        /** Ожидаем получить из искомую запись */
        $this->assertTrue(!empty($item));
    }

    /** Тестируем получение записей с боссами по локации Лес - подразумевается активная запись */
    public function testSelectActiveForestBossesByMapnameRow()
    {
        /** Ищем запись в соответствии с условием */
        $item = Bosses::find()
            ->where([Bosses::ATTR_MAP => 'Лес'])
            ->andWhere([Bosses::ATTR_ACTIVE => Bosses::TRUE])
            ->andWhere([Bosses::ATTR_OLD => Bosses::FALSE])
            ->one();

        /** Ожидаем получить из искомую запись */
        $this->assertTrue(!empty($item));
    }

    /** Тестируем получение записей с боссами по локации Берег - подразумевается активная запись */
    public function testSelectActiveBeregBossesByMapnameRow()
    {
        /** Ищем запись в соответствии с условием */
        $item = Bosses::find()
            ->where([Bosses::ATTR_MAP => 'Берег'])
            ->andWhere([Bosses::ATTR_ACTIVE => Bosses::TRUE])
            ->andWhere([Bosses::ATTR_OLD => Bosses::FALSE])
            ->one();

        /** Ожидаем получить из искомую запись */
        $this->assertTrue(!empty($item));
    }

    /** Тестируем получение записей с боссами по локации Развязка - подразумевается активная запись */
    public function testSelectActiveRazvyazkaBossesByMapnameRow()
    {
        /** Ищем запись в соответствии с условием */
        $item = Bosses::find()
            ->where([Bosses::ATTR_MAP => 'Развязка'])
            ->andWhere([Bosses::ATTR_ACTIVE => Bosses::TRUE])
            ->andWhere([Bosses::ATTR_OLD => Bosses::FALSE])
            ->one();

        /** Ожидаем получить из искомую запись */
        $this->assertTrue(!empty($item));
    }

    /** Тестируем получение записей с боссами по локации Маяк - подразумевается активная запись */
    public function testSelectActiveLighthouseBossesByMapnameRow()
    {
        /** Ищем запись в соответствии с условием */
        $item = Bosses::find()
            ->where([Bosses::ATTR_MAP => 'Маяк'])
            ->andWhere([Bosses::ATTR_ACTIVE => Bosses::TRUE])
            ->andWhere([Bosses::ATTR_OLD => Bosses::FALSE])
            ->one();

        /** Ожидаем получить из искомую запись */
        $this->assertTrue(!empty($item));
    }

    /** Тестируем получение записей с боссами по локации Резерв - подразумевается активная запись */
    public function testSelectActiveRezervBossesByMapnameRow()
    {
        /** Ищем запись в соответствии с условием */
        $item = Bosses::find()
            ->where([Bosses::ATTR_MAP => 'Резерв'])
            ->andWhere([Bosses::ATTR_ACTIVE => Bosses::TRUE])
            ->andWhere([Bosses::ATTR_OLD => Bosses::FALSE])
            ->one();

        /** Ожидаем получить из искомую запись */
        $this->assertTrue(!empty($item));
    }

    /** Тестируем получение записей с боссами по локации Лаборатория - подразумевается активная запись */
    public function testSelectActiveLaboratoryBossesByMapnameRow()
    {
        /** Ищем запись в соответствии с условием */
        $item = Bosses::find()
            ->where([Bosses::ATTR_MAP => 'Лаборатория'])
            ->andWhere([Bosses::ATTR_ACTIVE => Bosses::TRUE])
            ->andWhere([Bosses::ATTR_OLD => Bosses::FALSE])
            ->one();

        /** Ожидаем получить из искомую запись */
        $this->assertTrue(!empty($item));
    }

    /** Тестируем получение записей с боссами по локации Завод - подразумевается активная запись */
    public function testSelectActiveZavodBossesByUrlRow()
    {
        /** Ищем запись в соответствии с условием */
        $item = Bosses::find()
            ->where([Bosses::ATTR_URL => 'zavod'])
            ->andWhere([Bosses::ATTR_ACTIVE => Bosses::TRUE])
            ->andWhere([Bosses::ATTR_OLD => Bosses::FALSE])
            ->one();

        /** Ожидаем получить из искомую запись */
        $this->assertTrue(!empty($item));
    }

    /** Тестируем получение записей с боссами по локации ночной Завод - подразумевается активная запись */
    public function testSelectActiveNightZavodBossesByUrlRow()
    {
        /** Ищем запись в соответствии с условием */
        $item = Bosses::find()
            ->where([Bosses::ATTR_URL => 'night-zavod'])
            ->andWhere([Bosses::ATTR_ACTIVE => Bosses::TRUE])
            ->andWhere([Bosses::ATTR_OLD => Bosses::FALSE])
            ->one();

        /** Ожидаем получить из искомую запись */
        $this->assertTrue(!empty($item));
    }

    /** Тестируем получение записей с боссами по локации Таможня - подразумевается активная запись */
    public function testSelectActiveTamojnyaBossesByUrlRow()
    {
        /** Ищем запись в соответствии с условием */
        $item = Bosses::find()
            ->where([Bosses::ATTR_URL => 'tamojnya'])
            ->andWhere([Bosses::ATTR_ACTIVE => Bosses::TRUE])
            ->andWhere([Bosses::ATTR_OLD => Bosses::FALSE])
            ->one();

        /** Ожидаем получить из искомую запись */
        $this->assertTrue(!empty($item));
    }

    /** Тестируем получение записей с боссами по локации Лес - подразумевается активная запись */
    public function testSelectActiveForestBossesByUrlRow()
    {
        /** Ищем запись в соответствии с условием */
        $item = Bosses::find()
            ->where([Bosses::ATTR_URL => 'forest'])
            ->andWhere([Bosses::ATTR_ACTIVE => Bosses::TRUE])
            ->andWhere([Bosses::ATTR_OLD => Bosses::FALSE])
            ->one();

        /** Ожидаем получить из искомую запись */
        $this->assertTrue(!empty($item));
    }

    /** Тестируем получение записей с боссами по локации Берег - подразумевается активная запись */
    public function testSelectActiveBeregBossesByUrlRow()
    {
        /** Ищем запись в соответствии с условием */
        $item = Bosses::find()
            ->where([Bosses::ATTR_URL => 'bereg'])
            ->andWhere([Bosses::ATTR_ACTIVE => Bosses::TRUE])
            ->andWhere([Bosses::ATTR_OLD => Bosses::FALSE])
            ->one();

        /** Ожидаем получить из искомую запись */
        $this->assertTrue(!empty($item));
    }

    /** Тестируем получение записей с боссами по локации Развязка - подразумевается активная запись */
    public function testSelectActiveRazvyazkaBossesByUrlRow()
    {
        /** Ищем запись в соответствии с условием */
        $item = Bosses::find()
            ->where([Bosses::ATTR_URL => 'razvyazka'])
            ->andWhere([Bosses::ATTR_ACTIVE => Bosses::TRUE])
            ->andWhere([Bosses::ATTR_OLD => Bosses::FALSE])
            ->one();

        /** Ожидаем получить из искомую запись */
        $this->assertTrue(!empty($item));
    }

    /** Тестируем получение записей с боссами по локации Маяк - подразумевается активная запись */
    public function testSelectActiveLighthouseBossesByUrlRow()
    {
        /** Ищем запись в соответствии с условием */
        $item = Bosses::find()
            ->where([Bosses::ATTR_URL => 'lighthouse'])
            ->andWhere([Bosses::ATTR_ACTIVE => Bosses::TRUE])
            ->andWhere([Bosses::ATTR_OLD => Bosses::FALSE])
            ->one();

        /** Ожидаем получить из искомую запись */
        $this->assertTrue(!empty($item));
    }

    /** Тестируем получение записей с боссами по локации Резерв - подразумевается активная запись */
    public function testSelectActiveRezervBossesByUrlRow()
    {
        /** Ищем запись в соответствии с условием */
        $item = Bosses::find()
            ->where([Bosses::ATTR_URL => 'rezerv'])
            ->andWhere([Bosses::ATTR_ACTIVE => Bosses::TRUE])
            ->andWhere([Bosses::ATTR_OLD => Bosses::FALSE])
            ->one();

        /** Ожидаем получить из искомую запись */
        $this->assertTrue(!empty($item));
    }

    /** Тестируем получение записей с боссами по локации Лаборатория - подразумевается активная запись */
    public function testSelectActiveLaboratoryBossesByUrlRow()
    {
        /** Ищем запись в соответствии с условием */
        $item = Bosses::find()
            ->where([Bosses::ATTR_URL => 'terragroup-laboratory'])
            ->andWhere([Bosses::ATTR_ACTIVE => Bosses::TRUE])
            ->andWhere([Bosses::ATTR_OLD => Bosses::FALSE])
            ->one();

        /** Ожидаем получить из искомую запись */
        $this->assertTrue(!empty($item));
    }

    /** Тестируем получение только устаревших записей, их должно быть 0 */
    public function testSelectOldRows()
    {
        /** Выбираем все записи */
        $list = Bosses::find()
            ->andWhere([Bosses::ATTR_OLD => Bosses::TRUE])
            ->all();

        /** Ожидаем получить из фикстур - 0 записи */
        $this->assertTrue(count($list) == 0);
    }

    /** Тестируем получение только неактивных записей, их должно быть 0 */
    public function testSelectDisabledRows()
    {
        /** Выбираем все записи */
        $list = Bosses::find()
            ->where([Bosses::ATTR_ACTIVE => Bosses::FALSE])
            ->andWhere([Bosses::ATTR_OLD => Bosses::FALSE])
            ->all();

        /** Ожидаем получить из фикстур - 0 записи */
        $this->assertTrue(count($list) == 0);
    }

    /** Тестируем удаление объекта */
    public function testDelete()
    {
        /** Выбираем одну из записей, представленных в фикстурах */
        $item = Bosses::findOne([Bosses::ATTR_ID => 3]);

        /** Удаляем запись */
        $item->delete();

        /** Получаем список всех записей */
        $list = Bosses::find()->all();

        /** Ожидаем получить из фикстур - 2 записи */
        $this->assertTrue(count($list) == 8);
    }
}