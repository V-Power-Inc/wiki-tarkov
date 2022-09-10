<?php

use yii\db\Migration;

/**
 * Handles the creation of table `{{%catskills}}`.
 */
class m220815_172232_create_catskills_table extends Migration
{
    const TABLE_NAME = 'cat_skills';

    /**
     * {@inheritdoc}
     */
    public function safeUp()
    {
        $this->createTable(static::TABLE_NAME, [
            'id' => $this->primaryKey()->comment('ID primary key'),
            'title' => $this->string(255)->Null()->comment('Название категории'),
            'content'=> $this->text()->Null()->comment('Содержимое категории'),
            'sortir' => $this->integer(11)->Null()->comment('Сортировка категорий'),
            'url' => $this->string(255)->Null()->comment('Url адрес'),
            'description' => $this->string(255)->Null()->comment('Seo описание'),
            'keywords' => $this->string(255)->Null()->comment('Seo ключевые слова'),
            'enabled' => $this->integer(1)->Null()->comment('Активна ли категория'),
            'preview' => $this->string(255)->Null()->comment('Превьшка категории'),
            'bg_style' => $this->string(100)->Null()->comment('Бэкграунд категории')
        ]);

        $this->addCommentOnTable(static::TABLE_NAME, "В этой таблице хранятся категории умений персонажа");
    }

    /**
     * {@inheritdoc}
     */
    public function safeDown()
    {
        $this->dropTable(static::TABLE_NAME);
    }
}
