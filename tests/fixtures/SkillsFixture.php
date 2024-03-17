<?php
/**
 * Created by PhpStorm.
 * User: PC_Principal
 * Date: 17.12.2023
 * Time: 22:00
 */

namespace app\tests\fixtures;

/**
 * Фикстура скилов
 *
 * Class CatskillsFixture
 * @package app\tests\fixtures
 */
class SkillsFixture extends \yii\test\ActiveFixture
{
    public $modelClass = 'app\models\Skills';

    /** @var string Имя таблицы */
    public const TABLE_NAME = 'skills';
}