<?php
/**
 * Created by PhpStorm.
 * User: PC_Principal
 * Date: 16.08.2022
 * Time: 20:49
 *
 * Фикстура маркеров локации Завод
 */

namespace app\tests\fixtures;

class ForestFixture extends \yii\test\ActiveFixture {

    public $modelClass = 'app\models\Forest';

    /** @var string Имя таблицы */
    const TABLE_NAME = 'forest';

//    Действие для фикстур после отработки каждого теста
//    public function afterLoad() {
//        parent::afterLoad();
//        $this->db->createCommand()->setSql('truncate table .'.static::TABLE_NAME)->execute();
//    }
}