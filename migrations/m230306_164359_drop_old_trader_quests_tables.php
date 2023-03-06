<?php

use yii\db\Migration;

/**
 * ВНИМАНИЕ!!! В этой миграции удаляются более не актуальные таблицы квестов торговцев, т.к. со следующего релиза
 * информация о квестах будет поставляться через API
 *
 * Class m230306_164359_drop_old_trader_quests_tables
 */
class m230306_164359_drop_old_trader_quests_tables extends Migration
{
    /** @var string - константы с именами таблиц, которые будут удалены */
    const PRAPOR_TABLE          = 'prapor';
    const EGER_TABLE            = 'eger';
    const TERAPEVT_TABLE        = 'terapevt';
    const BARAHOLSHIK_TABLE     = 'baraholshik';
    const SKYPSHIK_TABLE        = 'skypshik';
    const LYJNIC_TABLE          = 'lyjnic';
    const MEHANIC_TABLE         = 'mehanic';
    const MIROTVOREC_TABLE      = 'mirotvorec';

    /**
     * Дропаем этой миграцией все устаревшие таблицы квестов торговцев
     *
     * @return false|mixed|void
     */
    public function safeUp()
    {
        $this->dropTable(static::PRAPOR_TABLE);
        $this->dropTable(static::EGER_TABLE);
        $this->dropTable(static::TERAPEVT_TABLE);
        $this->dropTable(static::BARAHOLSHIK_TABLE);
        $this->dropTable(static::SKYPSHIK_TABLE);
        $this->dropTable(static::LYJNIC_TABLE);
        $this->dropTable(static::MEHANIC_TABLE);
        $this->dropTable(static::MIROTVOREC_TABLE);
    }

    /**
     * ВАЖНО!!! Эту миграцию нельзя откатить
     *
     * @return false|mixed|void
     */
    public function safeDown()
    {
        echo "Откат до таблиц с торговцами в старом виде не предусмотрен, таблицы квестов торговцев не будут воссозданы.\n";
    }
}
