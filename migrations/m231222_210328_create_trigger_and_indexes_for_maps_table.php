<?php

use yii\db\Migration;

/**
 * Handles the creation of table `{{%trigger_and_indexes_for_maps}}`.
 *
 * В этой миграции создаем триггеры и индексы для таблицы maps
 */
class m231222_210328_create_trigger_and_indexes_for_maps_table extends Migration
{
    /** @var string - Название таблицы */
    const TABLE_NAME = 'maps';

    /**
     * {@inheritdoc}
     */
    public function safeUp()
    {
        /** Индексы на таблицу maps - для поисков маркеров по названию локации */
        $this->createIndex(
            'idx_map',
            static::TABLE_NAME,
            'map'
        );

        /** Индексы на таблицу maps - для поисков по флагу активности */
        $this->createIndex(
            'idx_enabled',
            static::TABLE_NAME,
            'enabled'
        );

        /** SQL для создания триггера на таблицу maps (обновление записей в БД) */
        $sql = 'CREATE DEFINER=`'. $_ENV['DB_USER'] .'`@`localhost` TRIGGER `trg-maps` BEFORE UPDATE ON `maps` FOR EACH ROW BEGIN
      SET NEW.date_update = CURRENT_TIMESTAMP;
     END';

        /** Создаем триггер */
        $this->execute($sql);
    }

    /**
     * {@inheritdoc}
     */
    public function safeDown()
    {
        /** Запрос на дроп миграции */
        $sql = "DROP TRIGGER IF EXISTS `trg-maps`;";

        /** Выполняем запрос */
        $this->execute($sql);

        /** Дропаем индекс на имя таблицы */
        $this->dropIndex(
            'idx_map',
            static::TABLE_NAME
        );

        /** Дропаем индекс на enabled флаг */
        $this->dropIndex(
            'idx_enabled',
            static::TABLE_NAME
        );
    }
}
