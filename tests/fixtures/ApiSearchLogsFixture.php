<?php
/**
 * Created by PhpStorm.
 * User: PC_Principal
 * Date: 29.02.2024
 * Time: 20:13
 */

namespace app\tests\fixtures;

class ApiSearchLogsFixture extends \yii\test\ActiveFixture {

    public $modelClass = 'app\models\ApiSearchLogs';

    /** @var string Имя таблицы */
    public const TABLE_NAME = 'api_search_logs';
}