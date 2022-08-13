<?php

use yii\db\Migration;

/**
 * Handles the creation of table `{{%articles}}`.
 */
class m220813_172108_create_articles_table extends Migration
{
    const TABLE_NAME = 'articles';

    /**
     * {@inheritdoc}
     */
    public function safeUp()
    {
        $this->createTable(static::TABLE_NAME, [
            'id' => $this->primaryKey()->comment('ID primary key'),
            'title' => $this->string(255)->comment('Название материала'),
            'url' => $this->string(100)->Null()->comment('URL адрес материала'),
            'preview' => $this->string(200)->Null()->comment('Ссылка на превью материала'),
            'content' => $this->text()->Null()->comment('Содержимое материала'),
            'date_create' => $this->timestamp()->Null()->comment('Дата создания материала'),
            'enabled' => $this->integer(1)->Null()->comment('Флаг активности материала'),
            'description' => $this->string(255)->Null()->comment('SEO описание материала'),
            'keywords' => $this->string(255)->Null()->comment('SEO ключевые слова материала'),
            'shortdesc' => $this->text()->Null()->comment('Описание материала')
        ]);

        $this->addCommentOnTable(static::TABLE_NAME, "Таблица в которой хранятся полезные статьи");
    }

    /**
     * {@inheritdoc}
     */
    public function safeDown()
    {
        $this->dropTable(static::TABLE_NAME);
    }
}
