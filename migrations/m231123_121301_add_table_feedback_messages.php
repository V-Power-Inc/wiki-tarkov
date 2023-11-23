<?php

use yii\db\Migration;

/**
 * Class m231123_121301_add_table_feedback_messages
 */
class m231123_121301_add_table_feedback_messages extends Migration
{
    /** @var string - Название таблицы */
    const TABLE_NAME = 'feedback_messages';

    /**
     * {@inheritdoc}
     */
    public function safeUp()
    {
        /** Создаем таблицу обратной связи */
        $this->createTable(static::TABLE_NAME, [
            'id' => $this->primaryKey()->comment('ID primary key'),
            'content' => $this->text()->Null()->comment('Сообщение из формы'),
            'date_create' => $this->timestamp()->notNull()->defaultExpression('CURRENT_TIMESTAMP')->comment('Дата отправки сообщения'),
        ]);

        /** Добавляем к ней коммент */
        $this->addCommentOnTable(static::TABLE_NAME, "В этой таблице хранятся сообщения от пользователей на сайте (Форма обратной связи");
    }

    /**
     * {@inheritdoc}
     */
    public function safeDown()
    {
        /** Дропаем таблицу */
        $this->dropTable(static::TABLE_NAME);
    }
}