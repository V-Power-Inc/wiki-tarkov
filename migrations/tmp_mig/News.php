<?php

/** Файл миграции, необходимо вынести методы в боевую миграцию, когда она будет создана */

use yii\db\Migration;


class News extends Migration
{
    const TABLE_NAME = 'news';

    /**
     * {@inheritdoc}
     */
    public function safeUp()
    {
        $this->createTable(static::TABLE_NAME, [
            'id' => $this->primaryKey()->comment('ID primary key'),
            'title' => $this->string(150)->comment('Название новости'),
            'url' => $this->string(255)->Null()->comment('Название новости'),
            'preview' => $this->string(100)->Null()->comment('Превьюшка новости'),
            'content' => $this->text()->Null()->comment('Содержимое новости'),
            'date_create' => $this->date()->comment('Дата создания новости'),
            'enabled' => $this->integer(1)->Null()->comment('Активна ли новость'),
            'description' => $this->string(255)->Null()->comment('Seo описание'),
            'keywords'=> $this->string(255)->Null()->comment('Seo ключевые слова'),
            'shortdesc' => $this->text()->Null()->comment('Короткое описание новости')

        ]);

        $this->addCommentOnTable(static::TABLE_NAME, "В этой таблице хранятся новости сайта");
    }

    /**
     * {@inheritdoc}
     */
    public function safeDown()
    {
        $this->dropTable(static::TABLE_NAME);
    }
}
