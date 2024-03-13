<?php
/**
 * Created by PhpStorm.
 * User: PC_Principal
 * Date: 16.12.2023
 * Time: 13:37
 *
 * Фикстура для тестирования валют EFT
 */

namespace app\tests\fixtures;

class CurrenciesFixture extends \yii\test\ActiveFixture {

    /** @var string - Путь до AR модели */
    public $modelClass = 'app\models\Currencies';

    /** @var string Имя таблицы */
    public const TABLE_NAME = 'currencies';
}