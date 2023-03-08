<?php

use yii\db\Migration;

/**
 * Class m230306_091352_add_url_to_tasks_table
 */
class m230306_091352_add_url_to_tasks_table extends Migration
{
    const TABLE_NAME = 'tasks';
    /**
     * {@inheritdoc}
     */
    public function safeUp()
    {
        $this->addColumn(
            static::TABLE_NAME,
            'url',
            $this->string()->comment('Url адрес до квестов конкретного торговца')
        );
    }

    /**
     * {@inheritdoc}
     */
    public function safeDown()
    {
        $this->dropColumn(static::TABLE_NAME, 'url');
    }
}
