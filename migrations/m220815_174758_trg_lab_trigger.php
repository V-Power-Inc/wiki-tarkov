<?php

use yii\db\Migration;

/**
 * Class m220815_174758_trg_lab_trigger
 * Триггер на CURRENT Timestamp для локации Лаборатория
 */
class m220815_174758_trg_lab_trigger extends Migration
{
    /**
     * {@inheritdoc}
     */
    public function safeUp()
    {
        $sql = 'CREATE DEFINER=`'. $_ENV['DB_USER'] .'`@`localhost` TRIGGER `trg-lab` BEFORE UPDATE ON `laboratory` FOR EACH ROW BEGIN
      SET NEW.date_update = CURRENT_TIMESTAMP;
     END';
        $this->execute($sql);
    }

    /**
     * {@inheritdoc}
     */
    public function safeDown()
    {
        $sql = "DROP TRIGGER IF EXISTS `trg-lab`;";
        $this->execute($sql);
    }
}
