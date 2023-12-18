<?php
/**
 * Created by PhpStorm.
 * User: PC_Principal
 * Date: 17.12.2023
 * Time: 23:53
 */

namespace app\tests\fixtures;

/**
 * Фикстура бартеров торговцев
 *
 * Class BartersFixture
 * @package app\tests\fixtures
 */
class BartersFixture extends \yii\test\ActiveFixture
{
    /** @var string - nameSpace и modelClass */
    public $modelClass = 'app\models\Barters';

    /** @var string Имя таблицы */
    const TABLE_NAME = 'barters';
}