<?php
/**
 * Created by PhpStorm.
 * User: PC_Principal
 * Date: 03.11.2022
 * Time: 22:21
 */

namespace app\controllers;

use app\common\exceptions\http\controllers\app\ApiControllerHttpException;
use app\common\interfaces\ResponseStatusInterface;
use app\common\controllers\AdvancedController;
use app\common\services\ApiService;
use app\common\services\JsondataService;
use app\common\services\PaginationService;
use app\models\ApiLoot;
use app\models\ApiSearchLogs;
use app\models\forms\ApiForm;
use yii\web\HttpException;
use yii\web\ServerErrorHttpException;
use yii\db\Exception;
use Yii;

/**
 * Контроллер обеспечивает работоспособность API по получению лута со стороннего источника tarkov.dev
 * Маршрутизация до страниц, получающих данные по API для предметов
 *
 * Важно! Это отдельный класс, он не имеет никакого отношения к старым контроллерам Loot и Item
 *
 * Class ApiController
 * @package app\controllers
 */
final class ApiController extends AdvancedController
{
    /** Константы для передачи в маршрутизатор /config/routes.php */
    public const ACTION_LIST       = 'list';
    public const ACTION_ITEM       = 'item';
    public const ACTION_SEARCH     = 'search';
    public const ACTION_GET_GRAPHS = 'get-graphs';

    /**
     * Метод рендерит главную страницу API справочника
     *
     * @throws ServerErrorHttpException
     * @throws \Exception
     * @throws \Throwable in case delete failed.
     * @return mixed
     */
    public function actionList()
    {
        /** Создаем объект формы ApiForm */
        $form_model = new ApiForm();

        /** Проверяем - если запрос пришел через POST и загружен в модель - создаем объект API и дальнейшие дела */
        if (Yii::$app->request->isPost && $form_model->load(Yii::$app->request->post())) {

            /** Если кто-то пытается 2 раза пролезть с 1-им кодом рекапчи, рефрешим страницу */
            if (ApiSearchLogs::findCaptchaCode($form_model->recaptcha)) {

                /** Перезагружаем страницу */
                return $this->refresh();
            }

            /** Валидируем загруженные в форму данные */
            if ($form_model->validate()) {

                /** Создаем объект класса API */
                $api = new ApiService();

                /** Присваиваем переменной результат работы APIшки */
                $items = $api->proccessSearchItem($form_model);

                /** Если $items не пустой - тогда логируем запрос с флагом */
                if ($items) {

                    /** Логируем поисковый запрос пользователя в таблицу логов с флагом найденных предметов */
                    $api->setSearchLog($form_model, ApiSearchLogs::TRUE);

                } else { /** Если предметы не были найдены, логируем запрос без флага */

                    /** Если $items пустой - устанавливаем логирование запроса без флага */
                    $api->setSearchLog($form_model);
                }
            }
        } else {

            /** Рендерим вьюху с дефолтным набором данных и пагинацией */
            return $this->defaultRender();
        }

        /** Создаем объект формы ApiForm */
        $form_model = new ApiForm();

        /** Рендер страницы со списком предметов - стандартный, без пагинации */
        return $this->render(self::ACTION_LIST, [
            'form_model' => $form_model,
            'items' => $items
        ]);
    }

    /**
     * Экшен для рендеринга страницы с детальной информацией о предмете
     *
     * @param string $url - строка с Url адресом
     * @return mixed
     * @throws HttpException
     */
    public function actionItem(string $url)
    {
        /** Создаем переменную с объектом ApiLoot по параметру url адреса */
        $item = ApiLoot::findItemByUrl($url);

        /** Пробуем найти, если нашли - обновление данных и рендеринг вьюхи */
        if ($item) {

            /** Инициализируем API */
            $api = new ApiService();

            /** Обновляем данные о предмете через API */
            $api->renewItemData($item);

            /** Ренденирг данных */
            return $this->render(self::ACTION_ITEM, ['item' => $item]);
        }

        /** Если в базе нет предмета - редиректим с временным кодом на страницу со списком актуального лута */
        return $this->redirect('/items', ResponseStatusInterface::REDIRECT_TEMPORARILY_CODE);
    }

    /**
     * Метод для возврата поисковых подсказок по луту из API
     *
     * @param string $q - поисковый запрос
     * @return string
     * @throws ApiControllerHttpException
     * @throws Exception
     */
    public function actionSearch(string $q): string
    {
        /** Если запрос пришел через AJAX */
        if (Yii::$app->request->isAjax) {

            /** Возвращаем JSON закодированную подсказку по поиску актуального лута */
            return JsondataService::getSearchApiLogItem($q);
        }

        /** Если сюда пытаются зайти прямым запросом - выкидываем 404 ошибку */
        throw new ApiControllerHttpException(ResponseStatusInterface::NOT_FOUND_CODE, 'Такая страница не существует');
    }

    /**
     * Метод возвращает JSON с графиками состояния цен на предмет в прошлых сделках
     *
     * @param string $id - id предмета из API tarkov.dev
     * @return string
     * @throws ApiControllerHttpException
     */
    public function actionGetGraphs(string $id): string
    {
        /** Если запрос сюда прилетел AJAXом */
        if (Yii::$app->request->isAjax) {

            /** Инициализируем Api сервис */
            $api = new ApiService();

            /** Возвращаем данные о графиках стоимости предмета в прошлых сделках (JSON) */
            return $api->getGraphsById($id);
        }

        /** Выкидываем 404 ошибку, если кто-то сюда ломится помимо Ajax */
        throw new ApiControllerHttpException(ResponseStatusInterface::NOT_FOUND_CODE, 'Такая страница не существует.');
    }

    /**
     * Метод рендерит дефолтный набор данных для страницы списка лута API
     * Вызывается другим методом в случае соблюдения ряда условий
     *
     * @return string
     */
    public function defaultRender(): string
    {
        /** Выбираем все объекты лута из БД */
        $items = ApiLoot::findActualItems();

        /** Создаем объект поисковой формы по API луту */
        $form_model = new ApiForm();

        /** Сетапим пагинацию для дефолтной страницы с лутом */
        $data = new PaginationService($items);

        /** Рендерим вьюху */
        return $this->render(self::ACTION_LIST, [
            'items' => $data->items,
            'active_page' => Yii::$app->request->get('page',1),
            'count_pages' => $data->paginator->getPageCount(),
            'pagination' => $data->paginator,
            'form_model' => $form_model
        ]);
    }
}