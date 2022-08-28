<?php

namespace app\tests\fixtures;

class BaraholshikFixture extends \yii\test\ActiveFixture
{
    public $modelClass = 'app\models\Baraholshik';
    public $depends = ['app\tests\fixtures\TradersFixture'];

    /** @var string Имя таблицы */
    const TABLE_NAME = 'baraholshik';

//    Действие для фикстур после отработки каждого теста
//    public function afterLoad() {
//        parent::afterLoad();
//        $this->db->createCommand()->setSql('truncate table .'.static::TABLE_NAME)->execute();
//    }
}