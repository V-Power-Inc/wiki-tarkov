<?php

use yii\db\Migration;

/**
 * Handles the creation of table `{{%currencies}}`.
 */
class m220814_172404_create_currencies_table extends Migration
{
    const TABLE_NAME = 'currencies';

    /**
     * {@inheritdoc}
     */
    public function safeUp()
    {
        $this->createTable(static::TABLE_NAME, [
            'id' => $this->primaryKey()->comment('ID primary key'),
            'title' => $this->string(255)->Null()->defaultValue(null)->comment('Название валюты'),
            'value' => $this->integer(11)->Null()->defaultValue(null)->comment('Значение валюты'),
            'enabled' => $this->integer(1)->Null()->defaultValue(null)->comment('Активна ли валюта')
        ]);

        $this->addCommentOnTable(static::TABLE_NAME, "В этой таблице хранятся значения валют");
    }

    /**
     * {@inheritdoc}
     */
    public function safeDown()
    {
        $this->dropTable(static::TABLE_NAME);
    }
}
