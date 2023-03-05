<?php

use yii\db\Migration;

/**
 * Handles the creation of table `{{%tasks}}`.
 */
class m230305_110259_create_tasks_table extends Migration
{
    const TABLE_NAME = 'tasks';

    /**
     * {@inheritdoc}
     */
    public function safeUp()
    {
        $this->createTable(static::TABLE_NAME, [
            'id' => $this->primaryKey()->comment('ID primary key'),
            'quest' => $this->string()->notNull()->comment('Название квеста'),
            'trader_name' => $this->string()->notNull()->comment('Имя торговца, что выдает квест'),
            'trader_icon' => $this->text()->notNull()->comment('Иконка торговца'),
            'json' => $this->text()->notNull()->comment('Json из которого разбираем данные для заполнения квестов'),
            'date_create' => $this->timestamp()->notNull()->defaultExpression('CURRENT_TIMESTAMP')->comment('Дата создания записи о квесте'),
            'active' => $this->integer(1)->notNull()->defaultValue(1)->comment('Флаг активности записи'),
            'old' => $this->integer(1)->notNull()->defaultValue(0)->comment('Флаг возраста записи, если стоит 1, пора удалять')
        ]);

        $this->addCommentOnTable(static::TABLE_NAME, "Эта таблица хранит все данные полученные из API по квестам");
    }

    /**
     * {@inheritdoc}
     */
    public function safeDown()
    {
        $this->dropTable(static::TABLE_NAME);
    }
}
