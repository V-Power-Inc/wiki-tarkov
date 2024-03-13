<?php

namespace app\tests\fixtures;

class TasksFixture extends \yii\test\ActiveFixture
{
    /** @var string - nameSpace и modelClass */
    public $modelClass = 'app\models\Tasks';

    /** @var string Имя таблицы */
    public const TABLE_NAME = 'tasks';
}