<?php
/**
 * Created by PhpStorm.
 * User: PC_Principal
 * Date: 26.03.2024
 * Time: 10:38
 */

namespace app\tests;

use app\common\services\ImageService;
use Codeception\Test\Unit;
use yii\base\InvalidConfigException;
use yii\web\Request;
use UnitTester;
use Yii;

/**
 * Тестируем сервис по подстановке изображений
 *
 * Class ImageServiceTest
 * @package app\tests
 */
class ImageServiceTest extends Unit
{
    /** @var UnitTester - Объект класса для тестирования */
    protected UnitTester $tester;

    /** Мок класса Request */
    protected $request;

    /**
     * Действия выполняемые перед каждым тестом
     *
     * @return void
     * @throws InvalidConfigException
     */
    protected function _before()
    {
        /** Создаем заглушку для объекта $request */
        $this->request = $this->getMockBuilder(Request::class)
            ->disableOriginalConstructor()
            ->getMock();

        $this->request->expects($this->any())
            ->method('getUrl')
            ->willReturn('/maps'); // Устанавливаем значение URL

        /** Создаем заглушку для объекта Request */
        Yii::$app->set('request', $this->request);
    }

    /**
     * Тестируем получение изображения до карты
     *
     * @return void
     * @throws InvalidConfigException
     */
    public function testMapImages()
    {
        $map_name = 'Таможня';
        $expected_image = '/img/maps/karta_tamozhnya_preview.png';
        $actual_image = ImageService::mapImages($map_name);
        $this->assertEquals($expected_image, $actual_image);
    }

    /**
     * Тестируем получение изображения до босса
     *
     * @return void
     * @throws InvalidConfigException
     */
    public function testBossImages()
    {
        $boss = 'Решала';
        $expected_image = '/img/bosses/reshala.jpg';
        $actual_image = ImageService::bossImages($boss);
        $this->assertEquals($expected_image, $actual_image);
    }

    /**
     * Тестируем получение изображения до торговца
     *
     * @return void
     * @throws InvalidConfigException
     */
    public function testTraderImages()
    {
        $trader = 'Прапор';
        $expected_image = '/img/admin/resized/p2240218062615.jpg';
        $actual_image = ImageService::traderImages($trader);
        $this->assertEquals($expected_image, $actual_image);
    }

    /**
     * Тестируем получение изображения до квестового торговца
     *
     * @return void
     * @throws InvalidConfigException
     */
    public function testQuestsTraderImages()
    {
        $trader = 'Прапор';
        $expected_image = '/img/torgovcy/prapor-quests/prapor-full.jpg';
        $actual_image = ImageService::questsTraderImages($trader);
        $this->assertEquals($expected_image, $actual_image);
    }

    /**
     * Тестируем получение изображения до карты (Не существующий вариант)
     *
     * @return void
     * @throws InvalidConfigException
     */
    public function testMapImagesNonExistent()
    {
        $map_name = 'Неизвестная локация';
        $expected_image = '/img/qsch.png';
        $actual_image = ImageService::mapImages($map_name);
        $this->assertEquals($expected_image, $actual_image);
    }

    /**
     * Тестируем получение изображения до босса (Не существующий вариант)
     *
     * @return void
     * @throws InvalidConfigException
     */
    public function testBossImagesNonExistent()
    {
        $boss = 'Неизвестный босс';
        $expected_image = '/img/qsch.png';
        $actual_image = ImageService::bossImages($boss);
        $this->assertEquals($expected_image, $actual_image);
    }

    /**
     * Тестируем получение изображения до торговца (Не существующий вариант)
     *
     * @return void
     * @throws InvalidConfigException
     */
    public function testTraderImagesNonExistent()
    {
        $trader = 'Неизвестный торговец';
        $expected_image = '/img/qsch.png';
        $actual_image = ImageService::traderImages($trader);
        $this->assertEquals($expected_image, $actual_image);
    }

    /**
     * Тестируем получение изображения до квестового торговца (Не существующий вариант)
     *
     * @return void
     * @throws InvalidConfigException
     */
    public function testQuestsTraderImagesNonExistent()
    {
        $trader = 'Неизвестный торговец';
        $expected_image = '/img/qsch.png';
        $actual_image = ImageService::questsTraderImages($trader);
        $this->assertEquals($expected_image, $actual_image);
    }
}