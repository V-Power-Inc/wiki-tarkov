<?php

namespace app\tests\fixtures;

class MehanicFixture extends \yii\test\ActiveFixture
{

    public $modelClass = 'app\models\Mehanic';

    /** @var string Имя таблицы */
    const TABLE_NAME = 'mehanic';

//    Действие для фикстур после отработки каждого теста
//    public function afterLoad() {
//        parent::afterLoad();
//        $this->db->createCommand()->setSql('truncate table .'.static::TABLE_NAME)->execute();
//    }
}