<?php

use yii\db\Migration;

/**
 * Handles the creation of table `{{%questions}}`.
 */
class m220815_172118_create_questions_table extends Migration
{
    const TABLE_NAME = 'questions';

    /**
     * {@inheritdoc}
     */
    public function safeUp()
    {
        $this->createTable(static::TABLE_NAME, [
            'id' => $this->primaryKey()->comment('ID primary key'),
            'title' => $this->string(255)->Null()->comment('Название вопроса'),
            'content' => $this->text()->Null()->comment('Содержимое вопроса'),
            'date_create' => $this->timestamp()->notNull()->defaultExpression('CURRENT_TIMESTAMP')->comment('Дата создания вопроса'),
            'enabled' => $this->integer(1)->Null()->comment('Активен ли вопрос')
        ]);

        $this->addCommentOnTable(static::TABLE_NAME, "В этой таблице хранятся вопросы-ответы сайта");
    }

    /**
     * {@inheritdoc}
     */
    public function safeDown()
    {
        $this->dropTable(static::TABLE_NAME);
    }
}
