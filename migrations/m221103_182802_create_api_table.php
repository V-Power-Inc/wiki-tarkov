<?php

use yii\db\Migration;

/**
 * Handles the creation of table `{{%api_loot}}`.
 */
class m221103_182802_create_api_table extends Migration
{
    const TABLE_NAME = 'api_loot';
    /**
     * {@inheritdoc}
     */
    public function safeUp()
    {
        $this->createTable(static::TABLE_NAME, [
            'id' => $this->primaryKey()->comment('ID primary key'),
            'name' => $this->string()->notNull()->comment('Название предмета'),
            'json' => $this->text()->notNull()->comment('Json из которого разбираем данные'),
            'url' => $this->string()->notNull()->comment('URL адрес'),
            'date_create' => $this->timestamp()->notNull()->defaultExpression('CURRENT_TIMESTAMP')->comment('Дата создания записи о предмете'),
            'active' => $this->integer(1)->notNull()->defaultValue(1)->comment('Флаг активности записи'),
            'old' => $this->integer(1)->notNull()->defaultValue(0)->comment('Флаг возраста записи, если стоит 1, пора удалять')
        ]);

        $this->addCommentOnTable(static::TABLE_NAME, "Эта таблица хранит все данные полученные из Апишки");
    }

    /**
     * {@inheritdoc}
     */
    public function safeDown()
    {
        $this->dropTable(static::TABLE_NAME);
    }
}
