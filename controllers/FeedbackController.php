<?php
/**
 * Created by PhpStorm.
 * User: PC_Principal
 * Date: 23.11.2023
 * Time: 18:38
 */

namespace app\controllers;

use app\common\controllers\AdvancedController;
use app\common\models\forms\FeedbackForm;
use app\components\MessagesComponent;
use Yii;

/**
 * Контроллер для рендера и обработки результата получения формы обратной связи
 *
 * Class FeedbackController
 * @package app\controllers
 */
final class FeedbackController extends AdvancedController
{
    /** @var string - Константы экшенов */
    const ACTION_INDEX = 'index';

    /**
     * Рендер страницы с формой обратной связи
     * Если сюда прилетит POST и провалидируется, сохраним новый объект обратной связи
     *
     * @return string
     */
    public function actionIndex()
    {
        /** Данные из POST */
        $post = Yii::$app->request->post();

        /** Создаем объект формы обратной связи */
        $model = new FeedbackForm();

        /** Если прилетели данные из POST'a */
        if (!empty($post)) {

            /** Если данные прогрузились в модель и сохранились */
            if ($model->load($post) && $model->save()) {

                /** Сетапим flash сообщение */
                MessagesComponent::setMessages("<p class='alert alert-success size-16 margin-top-20'><b>Сообщение успешно отправлено, спасибо!</b></p>");
            }
        }

        /** Сбрасываем атрибут рекапчи, чтобы не словить Exception */
        $model->reCaptcha = false;

        /** Рендерим страницу с формой обратной связи */
        return $this->render(static::ACTION_INDEX, [
            'model' => $model
        ]);
    }
}