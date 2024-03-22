<?php
/**
 * Created by PhpStorm.
 * User: PC_Principal
 * Date: 19.03.2024
 * Time: 14:48
 */

namespace app\tests;

use app\components\UrlComponent;
use Codeception\Test\Unit;
use tests\_support\FixturesCollection;
use yii\web\UrlManager;
use yii\web\Request;
use UnitTester;

/**
 * Тестирование Url компонента
 *
 * Class UrlTest
 * @package app\tests\components
 */
class UrlTest extends Unit
{
    /** @var UnitTester - Объект класса для тестирования */
    protected UnitTester $tester;

    /** @var UrlManager - Класс урл менеджера */
    protected UrlManager $urlManager;

    /** @var UrlComponent - Компонент урл-менеджера */
    protected UrlComponent $urlComponent;

    /**
     * Действия выполняемые перед каждым тестом
     *
     * @return void
     */
    protected function _before()
    {
        /** Сетапим урл компонент свойству класса */
        $this->urlComponent = new UrlComponent();

        /** Сетапим объект урл менеджера в переменную */
        $this->urlManager = new UrlManager();

        /** Грузим фикстуры перед каждым тестом */
        $this->tester->haveFixtures(FixturesCollection::getCrudOnly());
    }

    /**
     * Проверяем что регулярные выражения по парсингу урла работают корректно
     *
     * @return void
     * @throws \yii\base\InvalidConfigException
     */
    public function testParseRequest()
    {
        /** Тестируем что попали в кейс обработки детальных ключей */
        $parsedRequestKeys = $this->urlComponent->parseRequest($this->urlManager, new Request(['pathInfo' => 'keys/some-key-id']));
        $this->assertEquals(['site/doorkeysdetail', ['id' => 'some-key-id']], $parsedRequestKeys);

        /** Тестируем что попали в кейс обработки детальных новостей */
        $parsedRequestNews = $this->urlComponent->parseRequest($this->urlManager, new Request(['pathInfo' => 'news/some-news-id']));
        $this->assertEquals(['site/newsdetail', ['id' => 'some-news-id']], $parsedRequestNews);

        /** Тестируем что попали в кейс обработки детальных статей */
        $parsedRequestArticles = $this->urlComponent->parseRequest($this->urlManager, new Request(['pathInfo' => 'articles/some-article-url']));
        $this->assertEquals(['site/articledetail', ['url' => 'some-article-url']], $parsedRequestArticles);

        /** Тестируем что попали в кейс обработки детальных торговцев */
        $parsedRequestTraders = $this->urlComponent->parseRequest($this->urlManager, new Request(['pathInfo' => 'traders/some-trader-id']));
        $this->assertEquals(['trader/tradersdetail', ['id' => 'some-trader-id']], $parsedRequestTraders);

        /** Тестируем что попали в кейс обработки детальных умений */
        $parsedRequestSkillsDetail = $this->urlComponent->parseRequest($this->urlManager, new Request(['pathInfo' => 'skills/some-skill-category/some-skill-id.html']));
        $this->assertEquals(['skills/skillsdetail', ['url' => 'some-skill-id']], $parsedRequestSkillsDetail);

        /** Тестируем что попали в кейс обработки категорий скилов */
        $parsedRequestSkillsCategory = $this->urlComponent->parseRequest($this->urlManager, new Request(['pathInfo' => 'skills/some-skill-category']));
        $this->assertEquals(['skills/skillscategory', ['name' => 'some-skill-category']], $parsedRequestSkillsCategory);

        /** Тестируем что попали в кейс обработки детальных предметов справочника лута */
        $parsedRequestLootDetail = $this->urlComponent->parseRequest($this->urlManager, new Request(['pathInfo' => 'loot/some-loot-id.html']));
        $this->assertEquals(['item/detailloot', ['item' => 'some-loot-id']], $parsedRequestLootDetail);

        /** Тестируем что попали в кейс обработки категорий справочника лута */
        $parsedRequestLootCategory = $this->urlComponent->parseRequest($this->urlManager, new Request(['pathInfo' => 'loot/some-category']));
        $this->assertEquals(['loot/category', ['name' => 'some-category']], $parsedRequestLootCategory);

        /** Тестируем что не попали не в один из кейсов */
        $parsedRequestLootCategory = $this->urlComponent->parseRequest($this->urlManager, new Request(['pathInfo' => 'somecontroller/unexists']));
        $this->assertFalse($parsedRequestLootCategory);
    }

    /**
     * Проверяем что при наличии определенного урла, он корректно создастся
     * Тут используются фикстуры для данных из БД
     *
     * @return void
     */
    public function testCreateUrl()
    {
        /** Проверяем что формируем корректный урл до детальной страницы ключей */
        $createUrlForDoorkeys = $this->urlComponent->createUrl($this->urlManager, 'zb-014', []);
        $this->assertEquals('keys/zb-014', $createUrlForDoorkeys);

        /** Проверяем что формируем корректный урл до детальной страницы новостей */
        $createUrlForNews = $this->urlComponent->createUrl($this->urlManager, 'sanatoriy-korpusa', []);
        $this->assertEquals('news/sanatoriy-korpusa', $createUrlForNews);

        /** Проверяем что формируем корректный урл до детальной страницы статей */
        $createUrlForArticles = $this->urlComponent->createUrl($this->urlManager, 'torgovci-reputaciya-art-item', []);
        $this->assertEquals('articles/torgovci-reputaciya-art-item', $createUrlForArticles);

        /** Проверяем что формируем корректный урл до детальной страницы торговца */
        $createUrlForTraders = $this->urlComponent->createUrl($this->urlManager, 'prapor', []);
        $this->assertEquals('traders/prapor', $createUrlForTraders);

        /** Проверяем что возвращаем false, если не один урл не был корректно сформирован */
        $createUrlForNonExistentRoute = $this->urlComponent->createUrl($this->urlManager, 'some-non-existent-route', []);
        $this->assertFalse($createUrlForNonExistentRoute);
    }
}