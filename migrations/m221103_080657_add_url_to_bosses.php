<?php

use yii\db\Migration;

/**
 * Class m221103_080657_add_url_to_bosses
 */
class m221103_080657_add_url_to_bosses extends Migration
{
    const TABLE_NAME = 'bosses';
    /**
     * {@inheritdoc}
     */
    public function safeUp()
    {
        $this->addColumn(
            static::TABLE_NAME,
            'url',
            $this->string()->comment('Url адрес до карты с боссами')
        );
    }

    /**
     * {@inheritdoc}
     */
    public function safeDown()
    {
        $this->dropColumn(static::TABLE_NAME, 'url');
    }
}
