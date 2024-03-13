<?php
/**
 * Created by PhpStorm.
 * User: PC_Principal
 * Date: 23.12.2023
 * Time: 16:55
 */

namespace app\tests\fixtures;

/**
 * Фикстура маркеров интерактивных карт локаций
 *
 * Class MapsFixture
 * @package app\tests\fixtures
 */
class MapsFixture extends \yii\test\ActiveFixture
{
    /** @var string - nameSpace и modelClass */
    public $modelClass = 'app\models\Maps';

    /** @var string Имя таблицы */
    public const TABLE_NAME = 'maps';
}