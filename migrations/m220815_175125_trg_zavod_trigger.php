<?php

use yii\db\Migration;

/**
 * Class m220815_175125_trg_zavod_trigger
 * Триггер на CURRENT Timestamp для локации Завод
 */
class m220815_175125_trg_zavod_trigger extends Migration
{
    /**
     * {@inheritdoc}
     */
    public function safeUp()
    {
        $sql = 'CREATE DEFINER=`'. $_ENV['DB_USER'] .'`@`localhost` TRIGGER `zavod` BEFORE UPDATE ON `bereg` FOR EACH ROW BEGIN
      SET NEW.date_update = CURRENT_TIMESTAMP;
     END';
        $this->execute($sql);
    }

    /**
     * {@inheritdoc}
     */
    public function safeDown()
    {
        $sql = "DROP TRIGGER IF EXISTS `zavod`;";
        $this->execute($sql);
    }
}
