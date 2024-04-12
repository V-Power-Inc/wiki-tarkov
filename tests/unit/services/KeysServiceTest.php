<?php
/**
 * Created by PhpStorm.
 * User: PC_Principal
 * Date: 06.04.2024
 * Time: 11:28
 */

namespace tests\unit\common\services;

use app\common\services\KeysService;
use app\models\Doorkeys;
use Codeception\Test\Unit;
use tests\_support\FixturesCollection;
use Yii;
use UnitTester;

/**
 * Тестируем сервис по выборке ключей от дверей
 *
 * Class KeysServiceTest
 * @package tests\unit\common\services
 */
class KeysServiceTest extends Unit
{
    /** @var UnitTester - Объект класса для тестирования */
    protected UnitTester $tester;

    /**
     * Действия выполняемые перед каждым тестом
     *
     * @return void
     */
    public function _before()
    {
        /** Грузим фикстуры перед каждым тестом */
        $this->tester->haveFixtures(FixturesCollection::getDoorkeys());
    }

    /**
     * Тестируем метод по получению данных о ключах от дверей (Все ключи)
     *
     * @return void
     */
    public function testTakeResultWithAllKeys()
    {
        /** Создаем объект AR модели */
        $formModel = new Doorkeys();

        /** Подгатавливаем POST данные аналогично работе метода */
        $postData = [
            'Doorkeys' => [
                'doorkey' => 'Все ключи',
            ],
        ];

        /** Сетапим данные в атрибут */
        Yii::$app->request->setBodyParams($postData);

        /** Получаем POST данные */
        $_POST['Doorkeys']['doorkey'] = 'Все ключи';

        /** Дергаем метод */
        $result = KeysService::takeResult($formModel);

        /** Проверяем что результат - массив */
        $this->assertIsArray($result);
    }

    /**
     * Тестируем метод по получению данных о ключах от дверей (С определенной группой)
     *
     * @return void
     */
    public function testTakeResultWithOneKeyGropup()
    {
        /** Создаем объект AR модели */
        $formModel = new Doorkeys();

        /** Подгатавливаем POST данные аналогично работе метода */
        $postData = [
            'Doorkeys' => [
                'doorkey' => 'Берег',
            ],
        ];

        /** Сетапим данные в атрибут */
        Yii::$app->request->setBodyParams($postData);

        /** Получаем POST данные */
        $_POST['Doorkeys']['doorkey'] = 'Берег';

        /** Дергаем метод */
        $result = KeysService::takeResult($formModel);

        /** Проверяем что результат - массив */
        $this->assertIsArray($result);
    }
}