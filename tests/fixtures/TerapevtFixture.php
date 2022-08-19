<?php
/**
 * Created by PhpStorm.
 * User: PC_Principal
 * Date: 19.08.2022
 * Time: 23:43
 */

namespace app\tests\fixtures;

class TerapevtFixture extends \yii\test\ActiveFixture {

    public $modelClass = 'app\models\Terapevt';

    /** @var string Имя таблицы */
    const TABLE_NAME = 'terapevt';

//    Действие для фикстур после отработки каждого теста
//    public function afterLoad() {
//        parent::afterLoad();
//        $this->db->createCommand()->setSql('truncate table .'.static::TABLE_NAME)->execute();
//    }
}