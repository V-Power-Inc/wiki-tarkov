<?php
/**
 * Created by PhpStorm.
 * User: PC_Principal
 * Date: 16.12.2023
 * Time: 14:15
 *
 * Фикстура для тестирования ключей от дверей
 */

namespace app\tests\fixtures;

class DoorkeysFixture extends \yii\test\ActiveFixture {

    /** @var string - Путь до AR модели */
    public $modelClass = 'app\models\Doorkeys';

    /** @var string Имя таблицы */
    public const TABLE_NAME = 'doorkeys';
}