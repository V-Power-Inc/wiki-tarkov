<?php
/**
 * Created by PhpStorm.
 * User: PC_Principal
 * Date: 20.08.2022
 * Time: 0:06
 */

namespace app\tests\fixtures;

class MirotvorecFixture extends \yii\test\ActiveFixture {

    public $modelClass = 'app\models\Mirotvorec';

    /** @var string Имя таблицы */
    const TABLE_NAME = 'mirotvorec';

//    Действие для фикстур после отработки каждого теста
//    public function afterLoad() {
//        parent::afterLoad();
//        $this->db->createCommand()->setSql('truncate table .'.static::TABLE_NAME)->execute();
//    }
}