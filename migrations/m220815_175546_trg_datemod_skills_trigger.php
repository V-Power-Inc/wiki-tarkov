<?php

use yii\db\Migration;

/**
 * Class m220815_175546_trg_datemod_skills_trigger
 * Триггер на обновление даты изменения умений
 */
class m220815_175546_trg_datemod_skills_trigger extends Migration
{
    /**
     * {@inheritdoc}
     */
    public function safeUp()
    {
        $sql = 'CREATE DEFINER=`'. $_ENV['DB_USER'] .'`@`localhost` TRIGGER `DateModSkills` BEFORE UPDATE ON `skills` FOR EACH ROW begin
SET NEW.date_update = CURRENT_TIMESTAMP();
end';
        $this->execute($sql);
    }

    /**
     * {@inheritdoc}
     */
    public function safeDown()
    {
        $sql = "DROP TRIGGER IF EXISTS `DateModSkills`;";
        $this->execute($sql);
    }
}
