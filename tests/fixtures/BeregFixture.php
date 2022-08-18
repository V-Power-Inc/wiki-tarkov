<?php
/**
 * Created by PhpStorm.
 * User: PC_Principal
 * Date: 18.08.2022
 * Time: 20:24
 */

namespace app\tests\fixtures;

class BeregFixture extends \yii\test\ActiveFixture {

    public $modelClass = 'app\models\Bereg';

    /** @var string Имя таблицы */
    const TABLE_NAME = 'bereg';

//    Действие для фикстур после отработки каждого теста
//    public function afterLoad() {
//        parent::afterLoad();
//        $this->db->createCommand()->setSql('truncate table .'.static::TABLE_NAME)->execute();
//    }
}