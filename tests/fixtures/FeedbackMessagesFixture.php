<?php
/**
 * Created by PhpStorm.
 * User: PC_Principal
 * Date: 16.12.2023
 * Time: 17:03
 */

namespace app\tests\fixtures;

/**
 * Фикстура раздела обратной связи
 *
 * Class FeedbackMessagesFixture
 * @package app\tests\fixtures
 */
class FeedbackMessagesFixture extends \yii\test\ActiveFixture
{
    /** @var string - nameSpace и modelClass */
    public $modelClass = 'app\models\FeedbackMessages';

    /** @var string Имя таблицы */
    const TABLE_NAME = 'feedback_messages';
}