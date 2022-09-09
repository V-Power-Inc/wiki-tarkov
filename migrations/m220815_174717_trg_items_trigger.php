<?php

use yii\db\Migration;

/**
 * Class m220815_174717_trg_items_trigger
 * Триггер на CURRENT Timestamp для справочника лута
 */
class m220815_174717_trg_items_trigger extends Migration
{
    /**
     * {@inheritdoc}
     */
    public function safeUp()
    {
        $sql = 'CREATE DEFINER=`'. $_ENV['DB_USER'] .'`@`localhost` TRIGGER `trg-items` BEFORE UPDATE ON `bereg` FOR EACH ROW BEGIN
      SET NEW.date_update = CURRENT_TIMESTAMP;
     END';
        $this->execute($sql);
    }

    /**
     * {@inheritdoc}
     */
    public function safeDown()
    {
        $sql = "DROP TRIGGER IF EXISTS `trg-items`;";
        $this->execute($sql);
    }
}
