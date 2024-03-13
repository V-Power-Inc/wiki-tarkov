<?php
/**
 * Created by PhpStorm.
 * User: basil
 * Date: 03.08.2022
 * Time: 20:50
 */

namespace app\common\controllers;

use yii\web\Controller;

/**
 * Контроллер для наследования контроллеров, отвечающих за отображение основного контента сайта
 *
 * Class AdvancedController
 * @package app\common\controllers
 */
class AdvancedController extends Controller
{
    /** Используем трейт для множественного наследования */
    use ControllerRoutesTrait;

    /** @var string - Параметр ID */
    public const PARAM_ID = 'id';
}