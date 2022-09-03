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
   // public $depends = ['app\tests\fixtures\TradersFixture'];

    // const TABLE_NAME = 'prapor';

//  Действие для фикстур после отработки каждого теста
//    public function beforeUnload() {
//        parent::beforeUnload();
//        $this->db->createCommand()->setSql('truncate table .'.static::TABLE_NAME)->execute();
//    }
}