<?php

/**
 * Created by PhpStorm.
 * User: PC_Principal
 * Date: 16.03.2024
 * Time: 2:29
 */

namespace tests\_support;

use app\tests\fixtures\AdminsFixture;
use app\tests\fixtures\ApilootFixture;
use app\tests\fixtures\ApiSearchLogsFixture;
use app\tests\fixtures\ArticlesFixture;
use app\tests\fixtures\BartersFixture;
use app\tests\fixtures\BossesFixture;
use app\tests\fixtures\CategoryFixture;
use app\tests\fixtures\CatskillsFixture;
use app\tests\fixtures\ClansFixture;
use app\tests\fixtures\CurrenciesFixture;
use app\tests\fixtures\DoorkeysFixture;
use app\tests\fixtures\ErrorLogFixture;
use app\tests\fixtures\FeedbackMessagesFixture;
use app\tests\fixtures\ItemsFixture;
use app\tests\fixtures\MapsFixture;
use app\tests\fixtures\NewsFixture;
use app\tests\fixtures\PatronsFixture;
use app\tests\fixtures\QuestionsFixture;
use app\tests\fixtures\SkillsFixture;
use app\tests\fixtures\TasksFixture;
use app\tests\fixtures\TradersFixture;

/**
 * Класс для возврата конфигов фикстур, для последуюшего использования в тестах
 *
 * Class FixturesCollection
 * @package tests\_support
 */
final class FixturesCollection
{
    /**
     * Возвращаем все имеющиеся у нас фикстуры
     *
     * @return array
     */
    public static function getCrudOnly(): array
    {
        return array_merge(
            self::getAdmins(),
            self::getApiloot(),
            self::getArticles(),
            self::getBarters(),
            self::getBosses(),
            self::getCategory(),
            self::getItems(),
            self::getCatskills(),
            self::getSkills(),
            self::getClans(),
            self::getCurrencies(),
            self::getDoorkeys(),
            self::getErrors(),
            self::getFeedbackMessages(),
            self::getMaps(),
            self::getNews(),
            self::getQuestions(),
            self::getTraders(),
            self::getTasks()
        );
    }

    /**
     * Получаем админов
     * @return array[]
     */
    public static function getAdmins(): array
    {
        return [
            'admins' => [
                'class' => AdminsFixture::class,
                'dataFile' => codecept_data_dir() . 'admins.php'
            ],
        ];
    }

    /**
     * Получаем лут из API
     * @return array[]
     */
    public static function getApiloot(): array
    {
        return [
            'api_loot' => [
                'class' => ApilootFixture::class,
                'dataFile' => codecept_data_dir() . 'api-loot.php'
            ]
        ];
    }

    /**
     * Получаем полезные статьи
     * @return array[]
     */
    public static function getArticles(): array
    {
        return [
            'articles' => [
                'class' => ArticlesFixture::class,
                'dataFile' => codecept_data_dir() . 'articles.php'
            ]
        ];
    }

    /**
     * Получаем бартеры
     * @return array[]
     */
    public static function getBarters(): array
    {
        return [
            'barters' => [
                'class' => BartersFixture::class,
                'dataFile' => codecept_data_dir() . 'barters.php'
            ]
        ];
    }

    /**
     * Получаем боссов из API
     * @return array[]
     */
    public static function getBosses(): array
    {
        return [
            'bosses' => [
                'class' => BossesFixture::class,
                'dataFile' => codecept_data_dir() . 'bosses.php'
            ]
        ];
    }

    /**
     * Получаем категории справочника лута
     * @return array[]
     */
    public static function getCategory(): array
    {
        return [
            'category' => [
                'class' => CategoryFixture::class,
                'dataFile' => codecept_data_dir() . 'category.php'
            ]
        ];
    }

    /**
     * Получаем предметы из справочника лута
     * @return array[]
     */
    public static function getItems(): array
    {
        return [
            'items' => [
                'class' => ItemsFixture::class,
                'dataFile' => codecept_data_dir() . 'items.php'
            ]
        ];
    }

    /**
     * Получаем категории скилов
     * @return array[]
     */
    public static function getCatskills(): array
    {
        return [
            'catskills' => [
                'class' => CatskillsFixture::class,
                'dataFile' => codecept_data_dir() . 'catskills.php'
            ]
        ];
    }

    /**
     * Получаем скилы
     * @return array[]
     */
    public static function getSkills(): array
    {
        return [
            'skills' => [
                'class' => SkillsFixture::class,
                'dataFile' => codecept_data_dir() . 'skills.php'
            ]
        ];
    }

    /**
     * Получаем заявки кланов
     * @return array[]
     */
    public static function getClans(): array
    {
        return [
            'clans' => [
                'class' => ClansFixture::class,
                'dataFile' => codecept_data_dir() . 'clans.php'
            ]
        ];
    }

    /**
     * Получаем валюты
     * @return array[]
     */
    public static function getCurrencies(): array
    {
        return [
            'currencies' => [
                'class' => CurrenciesFixture::class,
                'dataFile' => codecept_data_dir() . 'currencies.php'
            ]
        ];
    }

    /**
     * Получаем коючи от дверей
     * @return array[]
     */
    public static function getDoorkeys(): array
    {
        return [
            'doorkeys' => [
                'class' => DoorkeysFixture::class,
                'dataFile' => codecept_data_dir() . 'doorkeys.php'
            ]
        ];
    }

    /**
     * Получаем ошибки из логов
     * @return array[]
     */
    public static function getErrors(): array
    {
        return [
            'error' => [
                'class' => ErrorLogFixture::class,
                'dataFile' => codecept_data_dir() . 'errors.php'
            ]
        ];
    }

    /**
     * Получаем сообщения из форм обратной связи
     * @return array[]
     */
    public static function getFeedbackMessages(): array
    {
        return [
            'feedback_messages' => [
                'class' => FeedbackMessagesFixture::class,
                'dataFile' => codecept_data_dir() . 'feedback_messages.php'
            ]
        ];
    }

    /**
     * Получаем маркеры локаций
     * @return array[]
     */
    public static function getMaps(): array
    {
        return [
            'maps' => [
                'class' => MapsFixture::class,
                'dataFile' => codecept_data_dir() . 'maps.php'
            ]
        ];
    }

    /**
     * Получаем новости
     * @return array[]
     */
    public static function getNews(): array
    {
        return [
            'news' => [
                'class' => NewsFixture::class,
                'dataFile' => codecept_data_dir() . 'news.php'
            ]
        ];
    }

    /**
     * Получаем данные по таблице патронов
     * @return array[]
     */
    public static function getPatrons(): array
    {
        return [
            'patrons' => [
                'class' => PatronsFixture::class,
                'dataFile' => codecept_data_dir() . 'patrons.php'
            ]
        ];
    }

    /**
     * Получаем вопросы
     * @return array[]
     */
    public static function getQuestions(): array
    {
        return [
            'questions' => [
                'class' => QuestionsFixture::class,
                'dataFile' => codecept_data_dir() . 'questions.php'
            ]
        ];
    }

    /**
     * Получаем торговцев
     * @return array[]
     */
    public static function getTraders(): array
    {
        return [
            'traders' => [
                'class' => TradersFixture::class,
                'dataFile' => codecept_data_dir() . 'traders.php'
            ]
        ];
    }

    /**
     * Возвращаем логи из API
     * @return array[]
     */
    public static function getApiSearchLogs(): array
    {
        return [
            'api_search_logs' => [
                'class' => ApiSearchLogsFixture::class,
                'dataFile' => codecept_data_dir() . 'api_search_logs.php'
            ]
        ];
    }

    /**
     * Возвращаем квесты из API
     * @return array[]
     */
    public static function getTasks(): array
    {
        return [
            'tasks' => [
                'class' => TasksFixture::class,
                'dataFile' => codecept_data_dir() . 'tasks.php'
            ]
        ];
    }

    /**
     * Возвращаем 2 фикстуры (Категории и предметы)
     * @return array[]
     */
    public static function getItemsWithCats(): array
    {
        return array_merge(self::getCategory(), self::getItems());
    }

    /**
     * Возвращаем 2 фикстуры (Категории скилов и скилы)
     * @return array[]
     */
    public static function getSkillsWithCats(): array
    {
        return array_merge(self::getCatskills(), self::getSkills());
    }

    /**
     * Возвращаем 2 фикстуры (Торговцы и квесты)
     * @return array[]
     */
    public static function getTradersWithTasks(): array
    {
        return array_merge(self::getTraders(), self::getTasks());
    }
}