<?php

use yii\db\Migration;

/**
 * Handles the creation of table `{{%info}}`.
 */
class m220814_174932_create_info_table extends Migration
{
    const TABLE_NAME = 'info';

    /**
     * {@inheritdoc}
     */
    public function safeUp()
    {
        $this->createTable(static::TABLE_NAME, [
            'id' => $this->primaryKey()->comment('ID primary key'),
            'title' => $this->string(100)->Null()->comment('Название информационного виджета'),
            'content' => $this->text()->Null()->comment('Содержимое виджета'),
            'preview' => $this->string(200)->Null()->comment('Превьюшка виджета'),
            'enabled' => $this->integer(1)->Null()->comment('Активел ли виджет'),
            'course' => $this->text()->Null()->comment('Курс валюты из виджета - устаревший функционал'),
            'bgstyle' => $this->string(200)->Null()->comment('Превьюшка виджета')
        ]);

        $this->addCommentOnTable(static::TABLE_NAME, "В этой таблице информационные виджеты");
    }

    /**
     * {@inheritdoc}
     */
    public function safeDown()
    {
        $this->dropTable(static::TABLE_NAME);
    }
}
