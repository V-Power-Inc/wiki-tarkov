<?php

use yii\db\Migration;

/**
 * Class m231222_070047_alter_column_iznos_in_table_patrons
 *
 * Дропаем устаревшую филду в таблице патронов
 */
class m231222_070047_alter_column_iznos_in_table_patrons extends Migration
{
    /** @var string - Название таблицы */
    const TABLE_NAME = 'patrons';

    /**
     * {@inheritdoc}
     */
    public function safeUp()
    {
        $this->dropColumn(static::TABLE_NAME, 'iznos');
    }

    /**
     * {@inheritdoc}
     */
    public function safeDown()
    {
        $this->addColumn(static::TABLE_NAME, 'iznos', $this->string(255)->notNull()->defaultValue(0)->comment('Износ'));
    }
}