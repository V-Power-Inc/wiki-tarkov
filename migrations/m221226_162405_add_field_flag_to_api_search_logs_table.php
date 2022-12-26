<?php

use yii\db\Migration;

/**
 * Class m221226_162405_add_field_flag_to_api_search_logs_table
 */
class m221226_162405_add_field_flag_to_api_search_logs_table extends Migration
{
    const TABLE_NAME = 'api_search_logs';

    /**
     * {@inheritdoc}
     */
    public function safeUp()
    {
        $this->addColumn(
            static::TABLE_NAME,
            'flag',
            $this->integer()->notNull()->defaultValue(0)->comment('Флаг для проверки вернулись ли данные по запросу или нет')
        );
    }

    /**
     * {@inheritdoc}
     */
    public function safeDown()
    {
        $this->dropColumn(static::TABLE_NAME, 'flag');
    }
}
