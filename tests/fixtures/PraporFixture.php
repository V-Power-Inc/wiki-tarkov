<?php
/**
 * Created by PhpStorm.
 * User: PC_Principal
 * Date: 19.08.2022
 * Time: 23:58
 */

namespace app\tests\fixtures;

class PraporFixture extends \yii\test\ActiveFixture {

    public $modelClass = 'app\models\Prapor';

    /** @var string Имя таблицы */
    const TABLE_NAME = 'prapor';

//    Действие для фикстур после отработки каждого теста
//    public function afterLoad() {
//        parent::afterLoad();
//        $this->db->createCommand()->setSql('truncate table .'.static::TABLE_NAME)->execute();
//    }
}