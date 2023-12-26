<?php
/**
 * Created by PhpStorm.
 * User: PC_Principal
 * Date: 25.12.2023
 * Time: 23:39
 */

namespace app\tests\fixtures;

class AdminsFixture extends \yii\test\ActiveFixture {

    public $modelClass = 'app\models\Admins';

    /** @var string Имя таблицы */
    const TABLE_NAME = 'admins';
}