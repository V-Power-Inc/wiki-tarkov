<?php
/**
 * Created by PhpStorm.
 * User: PC_Principal
 * Date: 25.08.2022
 * Time: 23:03
 */

namespace app\tests\fixtures;

/**
 * Фикстура торговцев для тестов
 *
 * Class TradersFixture
 * @package app\tests\fixtures
 */
class TradersFixture extends \yii\test\ActiveFixture
{
    /** @var string - nameSpace и modelClass */
    public $modelClass = 'app\models\Traders';

    /** @var string Имя таблицы */
    const TABLE_NAME = 'traders';
}