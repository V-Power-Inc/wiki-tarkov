<?php

use yii\db\Migration;

/**
 * Class m221105_120239_create_table_api_search_log
 */
class m221105_120239_create_table_api_search_log extends Migration
{
    const TABLE_NAME = 'api_search_logs';
    /**
     * {@inheritdoc}
     */
    public function safeUp()
    {
        $this->createTable(static::TABLE_NAME, [
            'id' => $this->primaryKey()->comment('ID primary key'),
            'words' => $this->string(255)->defaultValue(null)->comment('Поисковый запрос, который пользователи отправляли на сервер'),
            'info' => $this->text()->comment('Поле для дополнительной информации - на перспективу'),
            'date_create' => $this->timestamp()->notNull()->defaultExpression('CURRENT_TIMESTAMP')->comment('Дата создания записи лога'),
        ]);

        $this->addCommentOnTable(static::TABLE_NAME, "В этой таблице хранятся логи поисковых запросов пользователей к API");
    }

    /**
     * {@inheritdoc}
     */
    public function safeDown()
    {
        $this->dropTable(static::TABLE_NAME);
    }
}
