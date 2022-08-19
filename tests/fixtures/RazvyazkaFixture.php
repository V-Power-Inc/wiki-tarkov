<?php
/**
 * Created by PhpStorm.
 * User: PC_Principal
 * Date: 19.08.2022
 * Time: 23:29
 */

namespace app\tests\fixtures;

class RazvyazkaFixture extends \yii\test\ActiveFixture {

    public $modelClass = 'app\models\Razvyazka';

    /** @var string Имя таблицы */
    const TABLE_NAME = 'razvyazka';

//    Действие для фикстур после отработки каждого теста
//    public function afterLoad() {
//        parent::afterLoad();
//        $this->db->createCommand()->setSql('truncate table .'.static::TABLE_NAME)->execute();
//    }
}