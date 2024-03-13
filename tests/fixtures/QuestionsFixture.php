<?php
/**
 * Created by PhpStorm.
 * User: PC_Principal
 * Date: 16.12.2023
 * Time: 16:01
 */

namespace app\tests\fixtures;

/**
 * Фикстура раздела FAQ
 *
 * Class QuestionsFixture
 * @package app\tests\fixtures
 */
class QuestionsFixture extends \yii\test\ActiveFixture
{
    /** @var string - nameSpace и modelClass */
    public $modelClass = 'app\models\Questions';

    /** @var string Имя таблицы */
    public const TABLE_NAME = 'questions';
}