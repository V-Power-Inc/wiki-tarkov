<?php

use yii\db\Migration;

/**
 * Class m220815_175031_trg_tamojnya_trigger
 * Триггер на CURRENT Timestamp для локации Таможня
 */
class m220815_175031_trg_tamojnya_trigger extends Migration
{
    /**
     * {@inheritdoc}
     */
    public function safeUp()
    {
        $sql = 'CREATE DEFINER=`'. $_ENV['DB_USER'] .'`@`localhost` TRIGGER `trg-tamojnya` BEFORE UPDATE ON `tamojnya` FOR EACH ROW BEGIN
      SET NEW.date_update = CURRENT_TIMESTAMP;
     END';
        $this->execute($sql);
    }

    /**
     * {@inheritdoc}
     */
    public function safeDown()
    {
        $sql = "DROP TRIGGER IF EXISTS `trg-tamojnya`;";
        $this->execute($sql);
    }
}
