<?php

use yii\db\Migration;

/**
 * Handles the dropping of table `{{%column_old_in_api_loot}}`.
 */
class m230412_185743_drop_column_old_in_api_loot_table extends Migration
{
    const TABLE_NAME = 'api_loot';

    /**
     * {@inheritdoc}
     */
    public function safeUp()
    {
        $this->dropColumn(static::TABLE_NAME, 'old');
    }

    /**
     * {@inheritdoc}
     */
    public function safeDown()
    {
        $this->addColumn(
            static::TABLE_NAME,
            'old',
            $this->integer(1)->notNull()->defaultValue(0)->comment('Флаг возраста записи, если стоит 1, пора удалять')
        );
    }
}
