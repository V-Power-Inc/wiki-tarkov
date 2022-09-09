<?php

use yii\db\Migration;

/**
 * Class m220815_175259_trg_datemod_trigger
 * Еще один триггер для таблицы items
 */
class m220815_175259_trg_datemod_trigger extends Migration
{
    /**
     * {@inheritdoc}
     */
    public function safeUp()
    {
        $sql = 'CREATE DEFINER=`'. $_ENV['DB_USER'] .'`@`localhost` TRIGGER `DateMod` BEFORE UPDATE ON `items` FOR EACH ROW begin
SET NEW.date_update = CURRENT_TIMESTAMP();
end';
        $this->execute($sql);
    }

    /**
     * {@inheritdoc}
     */
    public function safeDown()
    {
        $sql = "DROP TRIGGER IF EXISTS `DateMod`;";
        $this->execute($sql);
    }
}
