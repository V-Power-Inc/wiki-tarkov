<?php
/**
 * Created by PhpStorm.
 * User: basil
 * Date: 05.08.2022
 * Time: 22:15
 *
 * Выносим App в константы до инициализации приложения (Актуально только в Yii2 basic)
 */

Yii::setAlias('@app', dirname(__DIR__));
