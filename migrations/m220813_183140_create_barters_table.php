<?php

use yii\db\Migration;

/**
 * Handles the creation of table `{{%barters}}`.
 */
class m220813_183140_create_barters_table extends Migration
{
    const TABLE_NAME = 'barters';

    /**
     * {@inheritdoc}
     */
    public function safeUp()
    {
        $this->createTable(static::TABLE_NAME, [
            'id' => $this->primaryKey()->comment('ID primary key'),
            'title' => $this->string(255)->comment('Название обмена'),
            'content' => $this->text()->Null()->comment('Содержимое обмена'),
            'date_create' => $this->timestamp()->notNull()->defaultExpression('CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP')->comment('Дата создания и обновления обмена'),
            'enabled' => $this->integer(1)->Null()->comment('Активность бартера'),
            'site_title' => $this->string(255)->comment('Название бартера на сайте'),
            'trader_group' => $this->string(255)->Null()->comment('Торговец - которому принадлежит бартер')
        ]);

        $this->addCommentOnTable(static::TABLE_NAME, "В этой таблице хранятся бартеры торговцев");
    }

    /**
     * {@inheritdoc}
     */
    public function safeDown()
    {
        $this->dropTable(static::TABLE_NAME);
    }
}
