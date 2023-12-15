<?php
/**
 * Created by PhpStorm
 * User: PC_Principal
 * Date: 23.08.2022
 * Time: 9:12
 */

namespace app\tests;

use app\models\Tasks;
use app\common\helpers\validators\StringValidator;
use app\tests\fixtures\TasksFixture;

/**
 * Unit тесты квестов из API
 * Раньше это было Unit тестирование таблицы Барахольщика, поэтому квесты тестируем по его примеру
 *
 * Class TasksTest
 * @package models
 */
class TasksTest extends \Codeception\Test\Unit
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
            'tasks' => [
                'class' => TasksFixture::class,
                'dataFile' => codecept_data_dir() . 'tasks.php'
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
        $list = [Tasks::ATTR_QUEST, Tasks::ATTR_TRADER_NAME, Tasks::ATTR_TRADER_ICON, Tasks::ATTR_JSON];

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
        $list = [Tasks::ATTR_ID, Tasks::ATTR_ACTIVE, Tasks::ATTR_OLD];

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
        $list = [Tasks::ATTR_QUEST, Tasks::ATTR_TRADER_NAME];

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

    /** Тестируем создание нового объекта */
    public function testCreation()
    {
        /** Создаем новый AR объект  */
        $task = new Tasks();

        /** Валидируем все атрибуты AR объекта*/
        $this->_validateAttributes($task);

        /** Значения на сохранение нового объекта */
        $values = [
            Tasks::ATTR_ID => 4,
            Tasks::ATTR_QUEST => 'Первый квест',
            Tasks::ATTR_TRADER_NAME => 'Барахольщик',
            Tasks::ATTR_TRADER_ICON => 'https://assets.tarkov.dev/5ac3b934156ae10c4430e83c.webp',
            Tasks::ATTR_JSON => '{"name":"Секрет успеха","factionName":"Any","minPlayerLevel":26,"objectives":[{"type":"findQuestItem","description":"Найти Книгу о технологии изготовления одежды - Часть 1 на Развязке","optional":false},{"type":"giveQuestItem","description":"Передать первую книгу","optional":false},{"type":"findQuestItem","description":"Найти Книгу о технологии изготовления одежды - Часть 2 на Развязке","optional":false},{"type":"giveQuestItem","description":"Передать вторую книгу","optional":false}],"neededKeys":[],"taskRequirements":[{"task":{"name":"Шить - не тужить - Часть 2"},"status":["complete"]}],"experience":15600,"map":{"name":"Развязка"},"trader":{"name":"Барахольщик","imageLink":"https://assets.tarkov.dev/5ac3b934156ae10c4430e83c.webp"},"restartable":false,"startRewards":{"items":[]},"finishRewards":{"items":[{"item":{"name":"Рубли","description":"Несколько банкнот пока еще котирующихся российских рублей.","iconLink":"https://assets.tarkov.dev/5449016a4bdc2d6f028b456f-icon.webp","inspectImageLink":"https://assets.tarkov.dev/5449016a4bdc2d6f028b456f-image.webp"},"count":60000},{"item":{"name":"Балаклава Призрак","description":"Балаклава с рисунком черепа. Выглядит опасно.","iconLink":"https://assets.tarkov.dev/5ab8f4ff86f77431c60d91ba-icon.webp","inspectImageLink":"https://assets.tarkov.dev/5ab8f4ff86f77431c60d91ba-image.webp"},"count":2}]}}',
            Tasks::ATTR_URL => 'baraholshik-quests',
            Tasks::ATTR_ACTIVE => 1,
            Tasks::ATTR_OLD => 0
        ];

        /** Сетапим атрибуты AR объекту */
        $task->setAttributes($values);

        /** Валидируем атрибуты */
        $task->validate();

        /** Ожидаем что запись сохранилась */
        $this->assertTrue($task->save(), 'Ожидалось true - объект не сохранился.');

        /** Выбираем все записи */
        $list = Tasks::find()->all();

        /** Ожидаем что всего будет 4 записи */
        $this->assertTrue(count($list) == 4);
    }

    /** Тестируем выборку записи на обновление */
    public function testEdit()
    {
        /** Выбираем одну из записей, представленных в фикстурах */
        $task = Tasks::findOne([Tasks::ATTR_ID => 3]);

        /** Проводит валидацию атрибутов данных, полученных из фикстуры */
        $this->_validateAttributes($task);
    }

    /** Тестируем получение всех записей (select) */
    public function testList()
    {
        /** Выбираем все записи */
        $list = Tasks::find()->all();

        /** Ожидаем получить из фикстур - 3 записи */
        $this->assertTrue(count($list) == 3);
    }

    /** Тестируем удаление объекта */
    public function testDelete()
    {
        /** Выбираем одну из записей, представленных в фикстурах */
        $task = Tasks::findOne([Tasks::ATTR_ID => 3]);

        /** Удаляем запись */
        $task->delete();

        /** Получаем список всех записей */
        $list = Tasks::find()->all();

        /** Ожидаем получить из фикстур - 2 записи */
        $this->assertTrue(count($list) == 2);
    }
}