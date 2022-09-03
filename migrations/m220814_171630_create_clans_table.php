<?php

use yii\db\Migration;

/**
 * Handles the creation of table `{{%clans}}`.
 */
class m220814_171630_create_clans_table extends Migration
{
    const TABLE_NAME = 'clans';

    /**
     * {@inheritdoc}
     */
    public function safeUp()
    {
        $this->createTable(static::TABLE_NAME, [
            'id' => $this->primaryKey()->comment('ID primary key'),
            'title' => $this->string(100)->comment('Название клана'),
            'description' => $this->string(255)->comment('Описание клана'),
            'preview' => $this->string(255)->Null()->comment('Превьюшка клана'),
            'link' => $this->text()->Null()->comment('Ссылка на сообщество клана'),
            'date_create' => $this->timestamp()->notNull()->defaultExpression('CURRENT_TIMESTAMP')->comment('Дата создания клана'),
            'moderated' => $this->integer(1)->Null()->comment('Промодерирован ли клан'),
            'date_update' => $this->timestamp()->Null()->comment('Дата создания клана'),
        ]);

        $this->addCommentOnTable(static::TABLE_NAME, "В этой таблице хранятся Кланы");
    }

    /**
     * {@inheritdoc}
     */
    public function safeDown()
    {
        $this->dropTable(static::TABLE_NAME);
    }
}
