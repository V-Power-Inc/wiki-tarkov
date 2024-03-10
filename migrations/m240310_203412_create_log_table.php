<?php

use yii\db\Migration;

/**
 * Handles the creation of table `{{%log}}`.
 */
class m240310_203412_create_log_table extends Migration
{
    /** @var string - Название таблицы */
    const TABLE_NAME = 'error_log';

    /**
     * {@inheritdoc}
     */
    public function safeUp()
    {
        /** Создаем таблицу миграцией */
        $this->createTable(static::TABLE_NAME, [
            'id' => $this->primaryKey()->comment('ID primary key'),
            'type' => $this->string(100)->comment('Тип ошибки'),
            'url' => $this->string()->notNull()->comment('Url, где произошла проблема'),
            'description' => $this->string(100)->Null()->comment('Подробное описание ошибки'),
            'error_code' => $this->integer()->notNull()->defaultValue(500)->comment('Код ошибки'),
            'date_create' => $this->timestamp()->notNull()->defaultExpression('CURRENT_TIMESTAMP')->comment('Дата создания записи')
        ]);
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
