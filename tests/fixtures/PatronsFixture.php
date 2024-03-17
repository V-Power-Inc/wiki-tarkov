<?php
/**
 * Created by PhpStorm.
 * User: PC_Principal
 * Date: 29.02.2024
 * Time: 20:36
 */

namespace app\tests\fixtures;

class PatronsFixture extends \yii\test\ActiveFixture {

    public $modelClass = 'app\models\Patrons';

    /** @var string Имя таблицы */
    public const TABLE_NAME = 'patrons';
}