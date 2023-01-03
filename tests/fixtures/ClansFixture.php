<?php
/**
 * Created by PhpStorm.
 * User: PC_Principal
 * Date: 03.01.2023
 * Time: 12:04
 */

namespace app\tests\fixtures;

class ClansFixture extends \yii\test\ActiveFixture
{
    public $modelClass = 'app\models\Clans';

    /** @var string Имя таблицы */
    const TABLE_NAME = 'clans';
}