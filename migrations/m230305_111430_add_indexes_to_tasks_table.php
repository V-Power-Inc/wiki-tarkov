<?php

use yii\db\Migration;

/**
 * Class m230305_111430_add_indexes_to_tasks_table
 */
class m230305_111430_add_indexes_to_tasks_table extends Migration
{
    const TABLE_NAME = 'tasks';

    /**
     * {@inheritdoc}
     */
    public function safeUp()
    {
        /** Индекс на таблицу tasks - для поисков квестов по имени торговца */
        $this->createIndex(
            'idx_trader_name',
            static::TABLE_NAME,
            'trader_name'
        );

        /** Индексы на таблицу tasks - для поисков по флагу устаревания */
        $this->createIndex(
            'idx_old',
            static::TABLE_NAME,
            'old'
        );

        /** Индексы на таблицу tasks - для поисков связанных с удалением устаревших записей **/
        $this->createIndex(
            'idx_remove',
            static::TABLE_NAME,
            'old, trader_name'
        );
    }

    /**
     * {@inheritdoc}
     */
    public function safeDown()
    {
        /** Дропаем вышеупомянутые индексы */
        $this->dropIndex(
            'idx_trader_name',
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
