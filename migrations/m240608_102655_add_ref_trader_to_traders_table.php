<?php

use yii\db\Migration;

/**
 * Добавляем торговца Рефа - в таблицу квестов
 * Class m240608_102655_add_ref_trader_to_traders_table
 */
class m240608_102655_add_ref_trader_to_traders_table extends Migration
{
    /** @var string - Название таблицы */
    private const TABLE_NAME = 'traders';

    /**
     * {@inheritdoc}
     */
    public function safeUp()
    {
        /** Инсертим нового торговца */
        $this->insert(
            self::TABLE_NAME,
            [
                'title' => 'Реф',
                'preview' => '/img/torgovcy/small/ref.jpg',
                'urltoquets' => '/quests-of-traders/ref-quests',
                'button_quests' => 'Перейти в раздел квестов Рефа',
                'bg_style' => 'interback-grey',
                'enabled' => 1,
                'content' => '<p><span style="font-size: 16px;">Раcпорядитель Арены организует гладиаторские бои по всему Таркову&nbsp;</span></p>',
                'sortir' => 1,
                'fullcontent' => null,
                'description' => 'Реф. Escape from Tarkov.',
                'keywords' => 'Реф из Escape from Tarkov, Что продаёт Реф в Escape from Tarkov, все о торговце Рефе.',
                'url' => null
            ]
        );
    }

    /**
     * {@inheritdoc}
     */
    public function safeDown()
    {
        /** Дропаем торговца */
        $this->delete(
            self::TABLE_NAME,
            [
                'title' => 'Реф'
            ]
        );
    }
}
