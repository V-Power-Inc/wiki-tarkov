<?php
/**
 * Created by PhpStorm.
 * User: PC_Principal
 * Date: 16.08.2022
 * Time: 20:49
 *
 * Фикстура таблицы, в которой хранятся данные из API Боссов
 */

namespace app\tests\fixtures;

class BossesFixture extends \yii\test\ActiveFixture {

    public $modelClass = 'app\models\Bosses';

    /** @var string Имя таблицы */
    public const TABLE_NAME = 'bosses';
}