<?php

use yii\db\Migration;

/**
 * В этой миграции мы дропаем таблицу информационных виджетов (Устаревший функционал)
 *
 * Handles the dropping of table `info`.
 */
class m230306_192213_drop_info_table extends Migration
{
    const TABLE_NAME = 'info';

    /**
     * Дропаем этой миграцией таблицу информационных виджетов
     *
     * @return false|mixed|void
     */
    public function safeUp()
    {
        $this->dropTable(static::TABLE_NAME);
    }

    /**
     * ВАЖНО!!! Эту миграцию нельзя откатить
     *
     * @return false|mixed|void
     */
    public function safeDown()
    {
        echo "Необратимая миграция, таблица info не будет восстановлена.\n";
    }
}