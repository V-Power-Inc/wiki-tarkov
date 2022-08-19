<?php
/**
 * Created by PhpStorm.
 * User: PC_Principal
 * Date: 20.08.2022
 * Time: 0:12
 */

namespace app\tests\fixtures;

class LyjnicFixture extends \yii\test\ActiveFixture {

    public $modelClass = 'app\models\Lyjnic';

    /** @var string Имя таблицы */
    const TABLE_NAME = 'lyjnic';

//    Действие для фикстур после отработки каждого теста
//    public function afterLoad() {
//        parent::afterLoad();
//        $this->db->createCommand()->setSql('truncate table .'.static::TABLE_NAME)->execute();
//    }
}