<?php
/**
 * Created by PhpStorm.
 * User: PC_Principal
 * Date: 20.08.2022
 * Time: 0:23
 */

namespace app\tests\fixtures;

class SkypshikFixture extends \yii\test\ActiveFixture {

    public $modelClass = 'app\models\Skypshik';
    public $depends = ['app\tests\fixtures\TradersFixture'];

    /** @var string Имя таблицы */
    const TABLE_NAME = 'skypshik';

//    Действие для фикстур после отработки каждого теста
//    public function afterLoad() {
//        parent::afterLoad();
//        $this->db->createCommand()->setSql('truncate table .'.static::TABLE_NAME)->execute();
//    }
}