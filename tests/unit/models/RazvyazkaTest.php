<?php

namespace app\tests;

use app\models\Razvyazka;
use app\tests\fixtures\RazvyazkaFixture;
use app\common\helpers\validators\StringValidator;

/**
 * Unit тесты интерактивных маркеров Завода
 *
 * Class RazvyazkaTest
 * @package models
 *
 * @see https://codeception.com/docs/UnitTests
 * @see https://www.yiiframework.com/doc/guide/2.0/ru/test-fixtures
 */
class RazvyazkaTest extends \Codeception\Test\Unit
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
            'razvyazka' => [
                'class' => RazvyazkaFixture::class,
                'dataFile' => codecept_data_dir() . 'razvyazka.php'
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
        $list = [Razvyazka::ATTR_NAME];

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
        $list = [Razvyazka::ATTR_ID, Razvyazka::ATTR_COORDS_X, Razvyazka::ATTR_COORDS_Y, Razvyazka::ATTR_ENABLED, Razvyazka::ATTR_EXIT_ANYWAY];

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
        $list_fifty = [Razvyazka::ATTR_MARKER_GROUP];

        /** Список атрибутов на валидацию - длина 100 символов */
        $list_hundred = [Razvyazka::ATTR_NAME, Razvyazka::ATTR_EXITS_GROUP];

        /** Список атрибутов на валидацию - длина 255 символов */
        $list_main = [Razvyazka::ATTR_CUSTOMICON];

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
        $marker = new Razvyazka();

        /** Валидируем все атрибуты AR объекта*/
        $this->_validateAttributes($marker);

        /** Значения на сохранение нового объекта */
        $values = [
            Razvyazka::ATTR_ID => 4,
            Razvyazka::ATTR_NAME => 'Ящик у выхода с локации',
            Razvyazka::ATTR_MARKER_GROUP => 'Военные ящики',
            Razvyazka::ATTR_COORDS_X => 10,
            Razvyazka::ATTR_COORDS_Y => -135,
            Razvyazka::ATTR_CONTENT => '<p>Это основной выход с локации Завод, если у вас нет ключа от выхода с завода - это ваш единственный способ выйти с карты.</p><p><img alt="Основной выход с локации Завод. Через него выходит основная часть игроков." src="/img/upload/bereg_images/vihod-s-karty.png" style="width:100%" /></p>',
            Razvyazka::ATTR_ENABLED => 1,
            Razvyazka::ATTR_CUSTOMICON => '/img/admin/beregicons/vorota_3_d.png',
            Razvyazka::ATTR_EXITS_GROUP => 'Спавн на зеленой лампе',
            Razvyazka::ATTR_EXIT_ANYWAY => 1
        ];

        /** Сетапим атрибуты AR объекту */
        $marker->setAttributes($values);

        /** Валидируем атрибуты */
        $marker->validate();

        /** Ожидаем что запись сохранилась */
        $this->assertTrue($marker->save(), 'Ожидалось true - объект не сохранился.');

        /** Выбираем все записи */
        $list = Razvyazka::find()->all();

        /** Ожидаем что всего будет 4 записи */
        $this->assertTrue(count($list) == 4);
    }

    /** Тестируем обновление маркера */
    public function testUpdate()
    {
        $marker = Razvyazka::find()->where(['is not','id',null])->one();

        $marker->name = 'Ящик у выхода 234234с локации';
        $marker->marker_group='Военн234234ые ящики';
        $marker->coords_x='10';
        $marker->coords_y='-135';
        $marker->content='<p>Это основной выхо34234234д с локации Завод, если у вас нет ключа от выхода с завода - это ваш единственный способ выйти с карты.</p><p><img alt="Основной выход с локации Завод. Через него выходит основная часть игроков." src="/img/upload/bereg_images/vihod-s-karty.png" style="width:100%" /></p>';
        $marker->enabled='0';
        $marker->customicon='/img/orota_3_d.png';
        $marker->exits_group='Другое значение';
        $marker->exit_anyway='0';

        $this->assertIsInt($marker->update(), 'Ожидался int, вернулся false - объект не удалился.');
    }

    /** Тестируем выборку записи на обновление */
    public function testEdit()
    {
        /** Выбираем одну из записей, представленных в фикстурах */
        $marker = Razvyazka::findOne([Razvyazka::ATTR_ID => 3]);

        /** Проводит валидацию атрибутов данных, полученных из фикстуры */
        $this->_validateAttributes($marker);
    }

    /** Тестируем получение всех записей (select) */
    public function testList()
    {
        /** Выбираем все записи */
        $list = Razvyazka::find()->all();

        /** Ожидаем получить из фикстур - 3 записи */
        $this->assertTrue(count($list) == 3);
    }

    /** Тестируем удаление объекта */
    public function testDelete()
    {
        /** Выбираем одну из записей, представленных в фикстурах */
        $marker = Razvyazka::findOne([Razvyazka::ATTR_ID => 3]);

        /** Удаляем запись */
        $marker->delete();

        /** Получаем список всех записей */
        $list = Razvyazka::find()->all();

        /** Ожидаем получить из фикстур - 2 записи */
        $this->assertTrue(count($list) == 2);
    }
}