<?php
/**
 * Created by PhpStorm.
 * User: PC_Principal
 * Date: 03.11.2022
 * Time: 22:21
 */

namespace app\controllers;

use app\common\controllers\AdvancedController;
use app\common\services\ApiService;
use app\models\ApiLoot;
use app\models\forms\ApiForm;
use Yii;
use yii\web\HttpException;
use yii\web\ServerErrorHttpException;

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
    const ACTION_ITEM = 'item';

    /**
     * Метод рендерит главную страницу API справочника
     *
     * @throws ServerErrorHttpException
     * @return string
     */
    public function actionList(): string
    {
        /** Объект формы ApiForm */
        $form_model = new ApiForm();

        /** Проверяем - если запрос пришел через POST и загружен в модель - создаем объект API и дальнейшие дела */
        if (Yii::$app->request->isPost && $form_model->load(Yii::$app->request->post())) {

            /** Валидируем загруженные в форму данные */
            if ($form_model->validate()) {

                /** Создаем объект класса API */
                $api = new ApiService();

                /** Присваиваем переменной результат работы APIшки */
                $items = $api->proccessSearchItem($form_model);
            } else {
                /** Выкидываем ошибку сервера, если модель не прошла валидацию */
                throw new ServerErrorHttpException('Error - try again later');
            }
        } else {
            /** Если массив не $_POST - вернем 30 актуальных записей из нашей базы */
            $items = ApiLoot::findActualItems();
        }

        /** Рендер страницы со списком предметов */
        return $this->render('list', [
            'form_model' => $form_model,
            'items' => $items
        ]);
    }

    /**
     * Экшен для рендеринга страницы с детальной информацией о предмете
     *
     * @param string $url - строка с Url адресом
     * @return string
     * @throws HttpException
     */
    public function actionItem(string $url): string
    {
        /** Создаем переменную с объектом ApiLoot по параметру url адреса */
        $item = ApiLoot::findItemByUrl($url);

        /** Пробуем найти, если нашли - рендеринг вьюхи */
        if ($item) {

            /** Ренденирг данных */
            return $this->render('item', ['item' => $item]);
        }

        /** Если в базе нет предмета - возвращаем 404 ошибку */
        throw new HttpException(404, 'Такая страница не существует');
    }
}