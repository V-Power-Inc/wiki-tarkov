<?php

use yii\db\Migration;

/**
 * Class m220815_174624_trg_forest_trigger
 * Триггер на CURRENT Timestamp для интерактивных карт Леса
 */
class m220815_174624_trg_forest_trigger extends Migration
{
    /**
     * {@inheritdoc}
     */
    public function safeUp()
    {
        $sql = 'CREATE DEFINER=`'. $_ENV['DB_USER'] .'`@`localhost` TRIGGER `trg-forest` BEFORE UPDATE ON `bereg` FOR EACH ROW BEGIN
      SET NEW.date_update = CURRENT_TIMESTAMP;
     END';
        $this->execute($sql);
    }

    /**
     * {@inheritdoc}
     */
    public function safeDown()
    {
        $sql = "DROP TRIGGER IF EXISTS `trg-forest`;";
        $this->execute($sql);
    }
}
