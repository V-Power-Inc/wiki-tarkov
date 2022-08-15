<?php

use yii\db\Migration;

/**
 * Class m220815_180750_create_indexes_doorkeys
 * Применяем индексы к таблице DoorKeys
 */
class m220815_180750_create_indexes_doorkeys extends Migration
{
    const TABLE_NAME = 'doorkeys';

    /**
     * {@inheritdoc}
     */
    public function safeUp()
    {
        /** Индексы на таблицу Doorkeys */
        $this->createIndex(
            'name',
            static::TABLE_NAME,
            'name'
        );

        $this->createIndex(
            'url',
            static::TABLE_NAME,
            'url'
        );

        $this->createIndex(
            'active',
            static::TABLE_NAME,
            'active'
        );
    }

    /**
     * {@inheritdoc}
     */
    public function safeDown()
    {
        /** Дропаем вышеупомянутые индексы */
        $this->dropIndex(
            'name',
            static::TABLE_NAME
        );


        $this->dropIndex(
            'url',
            static::TABLE_NAME
        );


        $this->dropIndex(
            'active',
            static::TABLE_NAME
        );
    }


}
