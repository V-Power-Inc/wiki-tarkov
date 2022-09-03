<?php

use yii\db\Migration;

/**
 * Class m220815_175426_trg_datemod_category_trigger
 * Триггер на автоапдейт поля обновления для категорий справочника лута
 */
class m220815_175426_trg_datemod_category_trigger extends Migration
{
    /**
     * {@inheritdoc}
     */
    public function safeUp()
    {
        $sql = 'CREATE DEFINER=`'. $_ENV['DB_USER'] .'`@`localhost` TRIGGER `DateModCategory` BEFORE UPDATE ON `skills` FOR EACH ROW begin
SET NEW.date_update = CURRENT_TIMESTAMP();
end';
        $this->execute($sql);
    }

    /**
     * {@inheritdoc}
     */
    public function safeDown()
    {
        $sql = "DROP TRIGGER IF EXISTS `DateModCategory`;";
        $this->execute($sql);
    }
}
