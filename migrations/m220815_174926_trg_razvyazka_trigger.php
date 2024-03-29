<?php

use yii\db\Migration;

/**
 * Class m220815_174926_trg_razvyazka_trigger
 * Триггер на CURRENT Timestamp для локации Развязка
 */
class m220815_174926_trg_razvyazka_trigger extends Migration
{
    /**
     * {@inheritdoc}
     */
    public function safeUp()
    {
        $sql = 'CREATE DEFINER=`'. $_ENV['DB_USER'] .'`@`localhost` TRIGGER `trg-razvyazka` BEFORE UPDATE ON `razvyazka` FOR EACH ROW BEGIN
      SET NEW.date_update = CURRENT_TIMESTAMP;
     END';
        $this->execute($sql);
    }

    /**
     * {@inheritdoc}
     */
    public function safeDown()
    {
        $sql = "DROP TRIGGER IF EXISTS `trg-razvyazka`;";
        $this->execute($sql);
    }
}
