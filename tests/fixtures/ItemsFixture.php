<?php
/**
 * Created by PhpStorm.
 * User: PC_Principal
 * Date: 03.09.2022
 * Time: 19:42
 */
namespace app\tests\fixtures;

class ItemsFixture extends \yii\test\ActiveFixture {
    public $modelClass = 'app\models\Items';
    public $depends = ['app\tests\fixtures\CategoryFixture'];
}