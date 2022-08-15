<?php

/** Файл миграции, необходимо вынести методы в боевую миграцию, когда она будет создана */

use yii\db\Migration;


class Doorkeys extends Migration
{
    const TABLE_NAME = 'doorkeys';

    /**
     * {@inheritdoc}
     */
    public function safeUp()
    {
        $this->createTable(static::TABLE_NAME, [
            'id' => $this->primaryKey()->comment('ID primary key'),
            'name' => $this->string(255)->comment('Название ключа'),
            'mapgroup' => $this->text()->Null()->comment('К какой карте относится ключ'),
            'content' => $this->text()->Null()->comment('Содержимое ключа'),
            'active' => $this->integer(1)->Null()->comment('Активен ли ключ'),
            'date_create' => $this->timestamp()->notNull()->defaultExpression('CURRENT_TIMESTAMP')->comment('Дата создания ключа'),
            'preview' => $this->string(100)->Null()->comment('Превью ключа'),
            'shortcontent' => $this->text()->Null()->comment('Короткое описание ключа'),
            'url' => $this->string(255)->comment('Url ключа'),
            'description' => $this->string(255)->comment('Seo описание ключа'),
            'keywords' => $this->string(255)->comment('Seo ключевые слова')
        ]);

        $this->addCommentOnTable(static::TABLE_NAME, "В этой таблице хранятся ключи от дверей - справочник");
    }

    /**
     * {@inheritdoc}
     */
    public function safeDown()
    {
        $this->dropTable(static::TABLE_NAME);
    }
}
