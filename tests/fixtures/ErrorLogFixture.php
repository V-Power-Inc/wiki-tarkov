<?php
/**
 * Created by PhpStorm.
 * User: PC_Principal
 * Date: 10.03.2024
 * Time: 23:52
 */

namespace app\tests\fixtures;

/**
 * Фикстуры для логирующей таблицы
 *
 * Class ErrorLogFixture
 * @package app\tests\fixtures
 */
class ErrorLogFixture extends \yii\test\ActiveFixture {

    /** @var string - Путь до AR модели */
    public $modelClass = 'app\models\ErrorLog';

    /** @var string - Имя таблицы */
    const TABLE_NAME = 'error_log';
}