<?php
/**
 * Created by PhpStorm.
 * User: PC_Principal
 * Date: 25.08.2022
 * Time: 23:03
 *
 * Фикстура торговца для функционального теста детальной страницы торговца
 */

namespace app\tests\fixtures;

class TradersFixture extends \yii\test\ActiveFixture {
    public $modelClass = 'app\models\Traders';

    /** @var string Имя таблицы */
    const TABLE_NAME = 'traders';
}