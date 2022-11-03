<?php
/**
 * Created by PhpStorm.
 * User: PC_Principal
 * Date: 03.11.2022
 * Time: 22:21
 */

namespace app\controllers;

use app\common\controllers\AdvancedController;
use app\models\forms\ApiForm;

/**
 * Контроллер обеспечивает работоспособность API по получению лута со стороннего источника tarkov.dev
 * Маршрутизация до страниц, получающих данные по API для предметов
 *
 * Важно! Это отдельный класс, он не имеет никакого отношения к старым контроллерам Loot и Item
 *
 * Class ApiController
 * @package app\controllers
 */
class ApiController extends AdvancedController
{
    /** Константы для передачи в маршрутизатор /config/routes.php */
    const ACTION_LIST = 'list';
    const ACTION_RESULT = 'result';
    const ACTION_DETAIL_ITEM = 'detail-item';

    /**
     * Метод рендерит главную страницу API справочника
     *
     * todo: Метод подлежит доработке
     *
     * @return string
     */
    public function actionList(): string
    {
        /** Объект формы ApiForm */
        $form = new ApiForm();

        /** Рендер страницы со списком предметов */
        return $this->render('list', ['form' => $form]);
    }

}