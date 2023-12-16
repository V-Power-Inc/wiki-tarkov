<?php
/**
 * Created by PhpStorm.
 * User: PC_Principal
 * Date: 16.12.2023
 * Time: 16:44
 */

namespace app\tests\fixtures;

/**
 * Фикстура раздела новостей
 *
 * Class NewsFixture
 * @package app\tests\fixtures
 */
class NewsFixture extends \yii\test\ActiveFixture
{
    /** @var string - nameSpace и modelClass */
    public $modelClass = 'app\models\News';

    /** @var string Имя таблицы */
    const TABLE_NAME = 'news';
}