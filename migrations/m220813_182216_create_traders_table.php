<?php

use yii\db\Migration;

/**
 * Handles the creation of table `{{%traders}}`.
 */
class m220813_182216_create_traders_table extends Migration
{
    const TABLE_NAME = 'traders';

    /**
     * {@inheritdoc}
     */
    public function safeUp()
    {
        $this->createTable(static::TABLE_NAME, [
            'id' => $this->primaryKey()->comment('ID primary key'),
            'title' => $this->string(255)->Null()->comment('Имя торговца'),
            'preview' => $this->string(255)->Null()->comment('Превьюшка торговца'),
            'urltoquets' => $this->string(255)->Null()->comment('URL адрес до квестов'),
            'button_quests' => $this->string(255)->Null()->comment('Надпись на кнопке квестов'),
            'button_detail' => $this->string(255)->Null()->comment('Надпись на кнопке - ссылке на торговца'),
            'bg_style' => $this->text()->Null()->comment('Бэкграунд торговца на общей странице торговцев'),
            'enabled' => $this->integer(1)->Null()->comment('Активность торговца'),
            'content' => $this->text()->Null()->comment('Содержимое торговца'),
            'sortir' => $this->integer()->Null()->comment('Сортировка торговца'),
            'fullcontent' => $this->text()->Null()->comment('Полный контент торговца'),
            'description' => $this->string(255)->Null()->comment('Seo описание'),
            'keywords' => $this->string(255)->Null()->comment('Seo keywords'),
            'url' => $this->string(255)->Null()->comment('Url адрес')
        ]);

        $this->addCommentOnTable(static::TABLE_NAME, "В этой таблице хранятся торговцы");
    }

    /**
     * {@inheritdoc}
     */
    public function safeDown()
    {
        $this->dropTable(static::TABLE_NAME);
    }
}
