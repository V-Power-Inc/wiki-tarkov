<?php
/**
 * Created by PhpStorm.
 * User: basil
 * Date: 03.08.2022
 * Time: 20:50
 *
 * Кастомный контроллер для удобных маршрутизаций для публичной части сайта
 */

namespace app\common\controllers;

class AdvancedController extends \yii\web\Controller
{
    use ControllerRoutesTrait;

    /**
     * Обработчик ошибок - отображает статусы ответа сервера
     *
     * @return array
     */
    public function actions(): array
    {
        return [
            'error' => [
                'class' => 'yii\web\ErrorAction',
            ],
            'captcha' => [
                'class' => 'yii\captcha\CaptchaAction',
                'fixedVerifyCode' => YII_ENV_TEST ? 'testme' : null,
            ],
        ];
    }

}
