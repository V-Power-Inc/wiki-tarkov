<?php

use yii\db\Migration;

/**
 * Class m231123_122442_alter_column_content_in_table_feedback_messages_set_required
 */
class m231123_122442_alter_column_content_in_table_feedback_messages_set_required extends Migration
{
    /** @var string - Название таблицы */
    const TABLE_NAME = 'feedback_messages';

    /**
     * {@inheritdoc}
     */
    public function safeUp()
    {
        $this->alterColumn(static::TABLE_NAME, 'content', $this->text()->notNull()->comment('Сообщение из формы'));
    }

    /** Отмены не будет, т.к. исправлен недочет при создании таблицы */
    public function safeDown()
    {}
}