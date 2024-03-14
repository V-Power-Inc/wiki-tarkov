<?php

namespace app\modules\admin;

use yii\web\ErrorHandler;
use Yii;

/**
 * admin module definition class
 *
 * Class Admin
 * @package app\modules\admin
 */
class Admin extends \yii\base\Module
{
    /** @var string - Константа, название обработчика ошибок */
    private const ID_ERROR_HANDLER = 'errorHandler';

    /**
     * @inheritdoc
     */
    public $controllerNamespace = 'app\modules\admin\controllers';

    /**
     * Не существует такой вещи, как обработчик ошибок модуля, поэтому нам придется перезаписать обработчик ошибок приложения.
     *
     * @inheritdoc
     */
    public function init()
    {
        /** Возвращаем родительский конструктор */
        parent::init();

        /** На лету переопределяем обработчик ошибок, у админки он свой, со своей страницей ошибок */
        Yii::configure($this, [
            'components' => [
                'errorHandler' => [
                    'class' => ErrorHandler::class,
                    'errorAction' => 'admin/default/error'
                ]
            ],
        ]);

        /** Получаем созданный обработчик ошибок */
        $handler = $this->get(self::ID_ERROR_HANDLER);

        /** Перезаписываем обработчик событий тем, что создали только что */
        Yii::$app->set(self::ID_ERROR_HANDLER, $handler);

        /** Регистрируем его */
        $handler->register();
    }
}
