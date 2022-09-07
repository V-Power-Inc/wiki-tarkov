<?php

use yii\db\Migration;

/**
 * Handles the creation of table `{{%skills}}`.
 */
class m220815_172303_create_skills_table extends Migration
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

        /** Внешний ключ на cat_skills - id */
        $this->addForeignKey(
            'skills_cat_skills_id_fk',
            'skills',
            'category',
            'cat_skills',
            'id',
            'RESTRICT',
            'RESTRICT'
        );

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
