<?php

use yii\db\Migration;

/**
 * Handles the creation of table `{{%patrons}}`.
 */
class m220814_175651_create_patrons_table extends Migration
{
    const TABLE_NAME = 'patrons';

    /**
     * {@inheritdoc}
     */
    public function safeUp()
    {
        $this->createTable(static::TABLE_NAME, [
            'id' => $this->primaryKey()->comment('ID primary key'),
            'caliber' => $this->string(255)->notNull()->defaultValue(0)->comment('ID primary key'),
            'type' => $this->string(255)->notNull()->defaultValue(0)->comment('Тип патрона'),
            'damage' => $this->string(255)->notNull()->defaultValue(0)->comment('Урон'),
            'probitie' => $this->string(255)->notNull()->defaultValue(0)->comment('Пробитие'),
            'damage_per_defence' => $this->string(255)->notNull()->defaultValue(0)->comment('Урон через защиту'),
            'speed' => $this->string(255)->notNull()->defaultValue(0)->comment('Скорость'),
            'count' => $this->string(255)->notNull()->defaultValue(0)->comment('Количество снарядов'),
            'tochn' => $this->string(255)->notNull()->defaultValue(0)->comment('Точность'),
            'otdacha' => $this->string(255)->notNull()->defaultValue(0)->comment('Отдача'),
            'fragmentation' => $this->string(255)->notNull()->defaultValue(0)->comment('Фрагментация'),
            'iznos' => $this->string(255)->notNull()->defaultValue(0)->comment('Износ'),
            'blood_1' => $this->string(255)->notNull()->defaultValue(0)->comment('Тяжелое кровотечение'),
            'blood_2' => $this->string(255)->notNull()->defaultValue(0)->comment('Легкое кровотечение'),
            'rikochet' => $this->string(255)->notNull()->defaultValue(0)->comment('Рикошет'),
            'traccer' => $this->string(255)->notNull()->defaultValue(0)->comment('Трассер')
        ]);

        $this->addCommentOnTable(static::TABLE_NAME, "В этой таблице хранится информация о характеристиках патронов");
    }

    /**
     * {@inheritdoc}
     */
    public function safeDown()
    {
        $this->dropTable(static::TABLE_NAME);
    }
}
