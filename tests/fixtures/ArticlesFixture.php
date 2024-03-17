<?php
/**
 * Created by PhpStorm.
 * User: PC_Principal
 * Date: 16.12.2023
 * Time: 16:19
 */

namespace app\tests\fixtures;

/**
 * Фикстура раздела полезных статей
 *
 * Class ArticlesFixture
 * @package app\tests\fixtures
 */
class ArticlesFixture extends \yii\test\ActiveFixture
{
    /** @var string - nameSpace и modelClass */
    public $modelClass = 'app\models\Articles';

    /** @var string Имя таблицы */
    public const TABLE_NAME = 'articles';
}