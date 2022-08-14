<?php

use yii\db\Migration;

/**
 * Handles the creation of table `{{%category}}`.
 */
class m220814_180533_create_category_table extends Migration
{
    const TABLE_NAME = 'category';

    /**
     * {@inheritdoc}
     */
    public function safeUp()
    {
        $this->createTable(static::TABLE_NAME, [
            'id' => $this->primaryKey()->comment('ID primary key'),
            'title' => $this->string(255)->comment('Название категории'),
            'parent_category' => $this->integer(1)->Null()->comment('ID родительской категории'),
            'url' => $this->string(255)->Null()->comment('Url категории'),
            'content' => $this->text()->Null()->comment('Название категории'),
            'description' => $this->string(255)->Null()->comment('Seo описание'),
            'keywords' => $this->string(255)->Null()->comment('Seo ключевые слова'),
            'enabled' => $this->integer(1)->Null()->comment('Активна ли категория'),
            'sortir' => $this->integer(11)->Null()->comment('Сортировка категорий'),
            'date_update' => $this->timestamp()->Null()->comment('Дата обновления категории')
        ]);

        $this->addCommentOnTable(static::TABLE_NAME, "Это таблица категорий справочника лута");
    }

    /**
     * {@inheritdoc}
     */
    public function safeDown()
    {
        $this->dropTable(static::TABLE_NAME);
    }
}
