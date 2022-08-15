<?php

/** Файл миграции, необходимо вынести методы в боевую миграцию, когда она будет создана */
/** Также конкретно этому файлу прописать внешний ключ */

use yii\db\Migration;


class Skills extends Migration
{
    const TABLE_NAME = 'skills';

    /**
     * {@inheritdoc}
     */
    public function safeUp()
    {
        $this->createTable(static::TABLE_NAME, [
            'id' => $this->primaryKey()->comment('ID primary key'),
            'title' => $this->string(255)->Null()->comment('Название умения'),
            'category' => $this->integer(11)->Null()->comment('Родительская категория умения'),
            'url' => $this->string(255)->Null()->comment('Url адрес умения'),
            'enabled' => $this->integer(1)->Null()->comment('Активность умения'),
            'description' => $this->string(255)->Null()->comment('Seo описание'),
            'keywords' => $this->string(255)->Null()->comment('Seo ключевые слова'),
            'preview' => $this->string(255)->Null()->comment('Превьюшка'),
            'content' => $this->text()->Null()->comment('Содержимое умения'),
            'short_desc' => $this->text()->Null()->comment('Короткое описание умения'),
            'date_update' => $this->timestamp()->Null()->comment('Дата создания умения')
        ]);

        $this->addCommentOnTable(static::TABLE_NAME, "В этой таблице хранятся умения персонажа");
    }

    /**
     * {@inheritdoc}
     */
    public function safeDown()
    {
        $this->dropTable(static::TABLE_NAME);
    }
}
