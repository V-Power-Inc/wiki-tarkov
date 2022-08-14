<?php

use yii\db\Migration;

/**
 * Handles the creation of table `{{%items}}`.
 */
class m220814_181556_create_items_table extends Migration
{
    const TABLE_NAME = 'items';

    /**
     * {@inheritdoc}
     */
    public function safeUp()
    {
        $this->createTable(static::TABLE_NAME, [
            'id' => $this->primaryKey()->comment('ID primary key'),
            'title' => $this->string(255)->Null()->comment('Название лута'),
            'preview' => $this->string(255)->notNull()->comment('Превьюшка лута'),
            'shortdesc' => $this->text()->notNull()->comment('Короткое описание лута'),
            'content' => $this->text()->notNull()->comment('Детальное содержимое лута'),
            'date_create' => $this->timestamp()->notNull()->defaultExpression('CURRENT_TIMESTAMP')->comment('Дата создания лута'),
            'active' => $this->integer(1)->Null()->comment('Флаг активности лута'),
            'parentcat_id' => $this->integer(11)->Null()->comment('ID родительской категории'),
            'url' => $this->string(100)->Null()->comment('Url категории'),
            'description' => $this->string(255)->Null()->comment('Seo описание'),
            'keywords' => $this->string(255)->Null()->comment('Seo ключевые слова'),
            'quest_item' => $this->integer(1)->Null()->comment('Флаг квестового лута'),
            'trader_group' => $this->string(200)->Null()->comment('У каких трейдеров нужен предмет по квесту'),
            'module_weapon' => $this->text()->Null()->comment('Модуль оружия'),
            'search_words' => $this->text()->Null()->comment('Поисковые слова - синонимы лута'),
            'shortimage' => $this->string(255)->Null()->comment('Seo ключевые слова'),
            'date_update' => $this->timestamp()->Null()->comment('Дата обновления лута'),
            'creator' => $this->string(255)->Null()->comment('Имя админа - создавшего лут')
        ]);

        /** Внешний ключ на category - id */
        $this->addForeignKey(
            'items_category_id_fk',
            'items',
            'parentcat_id',
            'category',
            'id',
            'CASCADE',
            'CASCADE'
        );

        /** Индексы */
        $this->createIndex(
            'items_date_update_index',
            'items',
            'date_update'
        );

        $this->createIndex(
            'quest_item',
            'items',
            'quest_item'
        );

        $this->createIndex(
            'active',
            'items',
            'active'
        );

        $this->createIndex(
            'title',
            'items',
            'title'
        );

        $this->createIndex(
            'search_words',
            'items',
            'search_words'
        );

        $this->createIndex(
            'creator',
            'items',
            'creator'
        );

        $this->createIndex(
            'url',
            'items',
            'url'
        );

        $this->addCommentOnTable(static::TABLE_NAME, "Лут в разделе справочника лута");
    }

    /**
     * {@inheritdoc}
     */
    public function safeDown()
    {
        $this->dropTable(static::TABLE_NAME);
    }
}
