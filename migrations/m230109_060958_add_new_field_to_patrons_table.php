<?php

use yii\db\Migration;

/**
 * Class m230109_060958_add_new_field_to_patrons_table
 */
class m230109_060958_add_new_field_to_patrons_table extends Migration
{
    const TABLE_NAME = 'patrons';

    /**
     * {@inheritdoc}
     */
    public function safeUp()
    {
        $this->addColumn(
            static::TABLE_NAME,
            'yb',
            $this->string(255)->notNull()->defaultValue(0)->comment('Убойная сила'),
        );
    }

    /**
     * {@inheritdoc}
     */
    public function safeDown()
    {
        $this->dropColumn(static::TABLE_NAME, 'yb');
    }
}
