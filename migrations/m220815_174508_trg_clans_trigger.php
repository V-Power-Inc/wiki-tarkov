<?php

use yii\db\Migration;

/**
 * Class m220815_174508_trg_clans_trigger
 * Триггер на CURRENT Timestamp для таблицы clans
 */
class m220815_174508_trg_clans_trigger extends Migration
{
    /**
     * {@inheritdoc}
     */
    public function safeUp()
    {
        $sql = 'CREATE DEFINER=`'. $_ENV['DB_USER'] .'`@`localhost` TRIGGER `trg-clans` BEFORE UPDATE ON `clans` FOR EACH ROW BEGIN
      SET NEW.date_update = CURRENT_TIMESTAMP;
     END';
        $this->execute($sql);
    }

    /**
     * {@inheritdoc}
     */
    public function safeDown()
    {
        $sql = "DROP TRIGGER IF EXISTS `trg-clans`;";
        $this->execute($sql);
    }
}
