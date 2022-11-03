<?php

use yii\db\Migration;

/**
 * Handles the creation of table `{{%bosses}}`.
 */
class m221103_035807_create_bosses_table extends Migration
{
    const TABLE_NAME = 'bosses';

    /**
     * {@inheritdoc}
     */
    public function safeUp()
    {
        $this->createTable('{{%bosses}}', [
            'id' => $this->primaryKey()->comment('ID primary key'),
            'map' => $this->string(100)->comment('Название карты спавна'),
            'bosses' => $this->text()->comment('Поле в котором хранится Json с данными о боссах'),
            'date_create' => $this->timestamp()->notNull()->defaultExpression('CURRENT_TIMESTAMP')->comment('Дата создания записи о боссах'),
            'active' => $this->integer(1)->notNull()->defaultValue(1)->comment('Флаг активности записи'),
            'old' => $this->integer(1)->notNull()->defaultValue(0)->comment('Флаг возраста записи, если стоит 1, пора удалять')
        ]);

        $this->addCommentOnTable(static::TABLE_NAME, "В этой таблице хранятся записи о боссах Escape From Tarkov");
    }

    /**
     * {@inheritdoc}
     */
    public function safeDown()
    {
        $this->dropTable(static::TABLE_NAME);
    }
}
