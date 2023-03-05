<?php

use yii\db\Migration;

/**
 * Class m221104_125926_add_indexes_to_api_loot
 */
class m221104_125926_add_indexes_to_api_loot extends Migration
{
    const TABLE_NAME = 'api_loot';
    /**
     * {@inheritdoc}
     */
    public function safeUp()
    {
        /** Индексы на таблицу api_loot - для поисков по имени предмета */
        $this->createIndex(
            'idx_name',
            static::TABLE_NAME,
            'name'
        );

        /** Индексы на таблицу api_loot - для поисков по урлу */
        $this->createIndex(
            'idx_url',
            static::TABLE_NAME,
            'url'
        );

        /** Индексы на таблицу api_loot - для поисков по флагу устаревания */
        $this->createIndex(
            'idx_old',
            static::TABLE_NAME,
            'old'
        );

        /** Индексы на таблицу api_loot - для поисков связанных с удалением устаревших записей **/
        $this->createIndex(
            'idx_remove',
            static::TABLE_NAME,
            'old, name'
        );
    }

    /**
     * {@inheritdoc}
     */
    public function safeDown()
    {
        /** Дропаем вышеупомянутые индексы */
        $this->dropIndex(
            'idx_name',
            static::TABLE_NAME
        );

        $this->dropIndex(
            'idx_url',
            static::TABLE_NAME
        );

        $this->dropIndex(
            'idx_old',
            static::TABLE_NAME
        );

        $this->dropIndex(
            'idx_remove',
            static::TABLE_NAME
        );
    }
}
