<?php

use yii\db\Migration;

/**
 * Class m220815_173553_trg_bereg_trigger
 * Триггер на CURRENT Timestamp для интерактивных карт Берега
 */
class m220815_173553_trg_bereg_trigger extends Migration
{
    /**
     * {@inheritdoc}
     */
    public function safeUp()
    {
        $sql = 'CREATE DEFINER=`'. $_ENV['DB_USER'] .'`@`localhost` TRIGGER `trg-bereg` BEFORE UPDATE ON `bereg` FOR EACH ROW BEGIN
      SET NEW.date_update = CURRENT_TIMESTAMP;
     END';
        $this->execute($sql);
    }

    /**
     * {@inheritdoc}
     */
    public function safeDown()
    {
        $sql = "DROP TRIGGER IF EXISTS `trg-bereg`;";
        $this->execute($sql);
    }
}
