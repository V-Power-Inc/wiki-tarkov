<?php

use yii\db\Migration;

/**
 * Handles the creation of table `{{%eger}}`.
 */
class m220915_114608_create_eger_table extends Migration
{
    const TABLE_NAME = 'eger';

    /**
     * {@inheritdoc}
     */
    public function safeUp()
    {
        $this->createTable(static::TABLE_NAME, [
            'id' => $this->primaryKey()->comment('ID primary key'),
            'tab_number' => $this->integer()->Null()->comment('Номер таба квеста'),
            'title' => $this->string(100)->comment('Название квеста'),
            'content' => $this->text()->Null()->comment('Содержимое квеста'),
            'date_create' => $this->timestamp()->notNull()->defaultExpression('CURRENT_TIMESTAMP')->comment('Дата создания квеста'),
            'date_edit' => $this->timestamp()->notNull()->defaultValue('0000-00-00 00:00:00')->comment('Дата обновления квеста'),
            'preview' => $this->string(100)->Null()->comment('Превьюшка квеста')
        ]);

        $this->addCommentOnTable(static::TABLE_NAME, "В этой таблице хранятся квесты Егеря");
    }

    /**
     * {@inheritdoc}
     */
    public function safeDown()
    {
        $this->dropTable(static::TABLE_NAME);
    }
}
