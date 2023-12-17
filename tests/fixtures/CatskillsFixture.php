<?php
/**
 * Created by PhpStorm.
 * User: PC_Principal
 * Date: 17.12.2023
 * Time: 21:41
 */

namespace app\tests\fixtures;

/**
 * Фикстура категорий скилов
 *
 * Class CatskillsFixture
 * @package app\tests\fixtures
 */
class CatskillsFixture extends \yii\test\ActiveFixture
{
    public $modelClass = 'app\models\Catskills';

    /** @var string Имя таблицы */
    const TABLE_NAME = 'cat_skills';
}