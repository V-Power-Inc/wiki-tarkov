<?php

namespace app\controllers;

use app\common\interfaces\ResponseStatusInterface;
use app\common\services\PaginationService;
use app\common\services\redis\RedisVariationsConfig;
use app\components\CookieComponent;
use app\models\Doorkeys;
use app\models\News;
use app\models\Articles;
use app\models\Questions;
use app\models\Currencies;
use app\models\Patrons;
use yii\helpers\Json;
use app\common\controllers\AdvancedController;
use yii\web\HttpException;
use app\common\services\KeysService;
use app\common\services\JsondataService;
use Yii;

/**
 * Основной контроллер сайта (Изначально существующий)
 *
 * Class SiteController
 * @package app\controllers
 */
final class SiteController extends AdvancedController
{
    /** Константы для передачи в маршрутизатор /config/routes.php */
    public const ACTION_INDEX                  = 'index';
    public const ACTION_TABLE_PATRONS          = 'table-patrons';
    public const ACTION_KEYS                   = 'keys';
    public const ACTION_DOORKEYSDETAIL         = 'doorkeysdetail';
    public const ACTION_NEWS                   = 'news';
    public const ACTION_NEWSDETAIL             = 'newsdetail';
    public const ACTION_ARTICLES               = 'articles';
    public const ACTION_ARTICLESARTICLESDETAIL = 'articlesdetail';
    public const ACTION_QUESTIONS              = 'questions';
    public const ACTION_KEYSJSON               = 'keysjson';
    public const ACTION_CURRENCIES             = 'currencies';
    public const ACTION_JSDISABLED             = 'jsdisabled';
    public const ACTION_JSONVALUTE             = 'jsonvalute';
    public const ACTION_CLOSE_OVERLAY          = 'close-overlay';
    public const ACTION_CHANGE_LAYOUT          = 'change-layout';

    /** CSRF валидация POST запросов методов этого контроллера включена по умолачнию */
    public $enableCsrfValidation;

    /**
     * Массив поведения данного контроллера
     * Подключаем REDIS кеширование для большинства страниц из этого контроллера
     *
     * @return array|array[]
     */
    public function behaviors(): array
    {
        return [
            [
                'class' => 'yii\filters\PageCache',
                'duration' => Yii::$app->params['cacheTime']['seven_days'],
                'only' => [
                    self::ACTION_INDEX,
                    self::ACTION_TABLE_PATRONS,
                    self::ACTION_KEYS,
                    self::ACTION_DOORKEYSDETAIL,
                    self::ACTION_NEWS,
                    self::ACTION_NEWSDETAIL,
                    self::ACTION_ARTICLES,
                    self::ACTION_ARTICLESARTICLESDETAIL,
                    self::ACTION_QUESTIONS,
                    self::ACTION_CURRENCIES
                ],
                'variations' => RedisVariationsConfig::getMainControllerVariations()
            ],
        ];
    }

    /**
     * Рендер главной страницы сайта
     *
     * @return string
     */
    public function actionIndex(): string
    {
        /** Рендерим индексную страницу сайта (Главная страница) */
        return $this->render(self::ACTION_INDEX);
    }

    /**
     * Рендер страницы с таблицей патронов
     *
     * @return string
     */
    public function actionTablePatrons(): string
    {
        /** Рендер страницы с информацией о характеристиках патронов */
        return $this->render('/site/patrons', ['patrons' => Patrons::takePatrons()]);
    }

    /**
     * Рендер страницы с наборами ключей
     *
     * @return string
     */
    public function actionKeys(): string
    {
        /** Новый AR Объект */
        $form_model = new Doorkeys();

        /** Если форма загрузила данные через POST */
        if ($form_model->load(Yii::$app->request->post())) {

            /** Рендерим вьюху с учетом полученных данных из POST */
            return $this->render('keys/keyseach.php', [
                    'form_model' => $form_model,
                    'keysearch'  => KeysService::takeResult($form_model),
                    'formValue'  => (string)Doorkeys::KeysCategories()[$form_model->doorkey]
            ]);
        }

        /** Если POST запроса не было, рендерим обычную вьюху со стандартными данными */
        return $this->render('keys/index.php', Doorkeys::KeysDefaultRenderingArray($form_model));
    }

    /**
     * Рендер детальной страницы для вывода ключей
     *
     * @param $id - параметр url ключа
     * @return string
     * @throws HttpException
     */
    public function actionDoorkeysdetail($id): string
    {
        /** Если нашли по URL Детальную страницу ключа */
        if (Doorkeys::findActiveKeyByUrl($id)) {

            /** Рендерим страницу с детальной информацией о ключе */
            return $this->render('keys/detail-key.php',['model' => Doorkeys::findActiveKeyByUrl($id)]);
        }

        /** В ином случае выкидываем Exception */
        throw new HttpException(ResponseStatusInterface::NOT_FOUND_CODE ,'Такая страница не существует');
    }

    /**
     * Рендер страницы списка новостей
     *
     * @return string
     */
    public function actionNews(): string
    {
        /** Ищем активные новости */
        $query =  News::find()->andWhere([News::ATTR_ENABLED => News::TRUE]);

        /** Задаем параметры пагинации */
        $data = new PaginationService($query,10);

        /** Рендерим вьюху с пагинацией */
        return $this->render('news/list.php', [
            'news'        => $data->items,
            'active_page' => Yii::$app->request->get('page',1),
            'count_pages' => $data->paginator->getPageCount(),
            'pagination'  => $data->paginator
        ]);
    }

    /**
     * Рендер детальной страницы новости
     *
     * @param $id - параметр url новости
     * @return string
     * @throws HttpException
     */
    public function actionNewsdetail($id): string
    {
        /** Если по урлу нашли детальную новость  */
        if (News::findActiveNewsByUrl($id)) {

            /** Рендерим вьюху */
            return $this->render('news/detail.php',['model' => News::findActiveNewsByUrl($id)]);
        }

        /** В ином случае выкидываем 404 ошибку */
        throw new HttpException(ResponseStatusInterface::NOT_FOUND_CODE ,'Такая страница не существует');
    }

    /**
     * Рендер страницы списка полезных статей
     *
     * @return string
     */
    public function actionArticles(): string
    {
        /** Ищем активные статьи */
        $query = Articles::find()->andWhere([Articles::ATTR_ENABLED => Articles::TRUE]);

        /** Задаем объект с пагинацией */
        $data = new PaginationService($query);

        /** Рендерим вьюху с информацией */
        return $this->render('articles/list.php', [
            'news'        => $data->items,
            'active_page' => Yii::$app->request->get('page',1),
            'count_pages' => $data->paginator->getPageCount(),
            'pagination'  => $data->paginator
        ]);
    }

    /**
     * Рендер детальной страницы полезной статьи
     *
     * @param $url - параметр url статьи
     * @return string
     * @throws HttpException
     */
    public function actionArticledetail($url): string
    {
        /** Если нашли статью по урлу */
        if (Articles::takeActiveArticleByUrl($url)) {

            /** Рендерим вьюху с детальной информацией */
            return $this->render('articles/detail.php',['model' => Articles::takeActiveArticleByUrl($url)]);
        }

        /** 404 ошибка - если не нашли такой статьи по урлу */
        throw new HttpException(ResponseStatusInterface::NOT_FOUND_CODE ,'Такая страница не существует');
    }

    /**
     * Рендер страницы справочника вопрос-ответ
     *
     * @return string
     */
    public function actionQuestions(): string
    {
        /** Ищем активные вопросы */
        $model = Questions::find()->where([Questions::ATTR_ENABLED => Questions::TRUE]);

        /** Задаем объект с пагинацией */
        $data = new PaginationService($model);

        /** Рендерим страницу со списком вопросов */
        return $this->render('questions/list.php', [
            'questions'   => $data->items,
            'active_page' => Yii::$app->request->get('page',1),
            'count_pages' => $data->paginator->getPageCount(),
            'pagination'  => $data->paginator
        ]);
    }

    /**
     * Данные о доступных ключах от дверей в формате Json - выборка только по включенным
     *
     * @param null $q - ключевое слово запроса
     *
     * @return string
     * @throws HttpException
     * @throws \yii\db\Exception
     */
    public function actionKeysjson($q = null): string
    {
        /** Если запрос пришел через Ajax */
        if (Yii::$app->request->isAjax) {

            /** Возвращаем информацию в JSON формате о ключе по запросу */
            return JsondataService::getKeysJson($q);
        }

        /** 404 - если сюда не AJAX запрос прилетел */
        throw new HttpException(ResponseStatusInterface::NOT_FOUND_CODE ,'Такая страница не существует');
    }

    /**
     * Рендер страницы справочника валют
     *
     * @return string
     */
    public function actionCurrencies(): string
    {
        /** Рендерим страницу с информацией о курсах валют */
        return $this->render('currencies/index.php', [
            'dollar'  => Currencies::takeDollar(),
            'euro'    => Currencies::takeEuro(),
            'bitkoin' => Currencies::takeBitkoin()
        ]);
    }

    /**
     * Отдаем валюты из базы в JSON формате
     *
     * @return string
     * @throws HttpException
     */
    public function actionJsonvalute(): string
    {
        /** Если запрос пришел как AJAX */
        if (Yii::$app->request->isAjax) {

            /** Возвращаем JSON информацию о курсах валют */
            return Json::encode(Currencies::takeActiveValutes());
        }

        /** 404 - Если запрос прилетел не по AJAX */
        throw new HttpException(ResponseStatusInterface::NOT_FOUND_CODE ,'Такая страница не существует');
    }

    /**
     * Этот метод вешает куку overlay - которая скрывает рекламный блок overlay на всех страницах
     * сайта на 6 часов (Попадаем сюда с помощью Ajax при клике на кнопку "Закрыть" рекламного блока)
     *
     * @return mixed
     * @throws HttpException - Если без AJAX пытаются сюда лезть прямым запросом
     */
    public function actionCloseOverlay(): bool
    {
        /** Если запрос отправлен через AJAX */
        if (Yii::$app->request->isAjax) {

            /** Сетапим куки из запроса на сервак в переменную */
            $cookies = Yii::$app->request->cookies;

            /** Если у поступающего сюда запроса не определена кука Overlay */
            if ($cookies->get(CookieComponent::NAME_OVERLAY) == null) {

                /** Создаем ее и задаем срок истечения 6 часов, в течении этого времени блок overlay будет скрыт у посетителя */
                return CookieComponent::setOverlay();
            }
        }

        /** Исключение - в случае если сюда пытались залезть прямым запросом */
        throw new HttpException(ResponseStatusInterface::NOT_FOUND_CODE ,'Такая страница не существует');
    }

    /**
     * Метод определяет, какую тему необходимо отобразить пользователю, в зависимости
     * от наличия определенного кукиса - либо удаляет существующую куку, либо сетапит ее
     * Всегда возвращает строку
     *
     * @return string
     * @throws HttpException - Если запрос сюда без Ajax
     */
    public function actionChangeLayout(): string
    {
        /** Если запрос прилетел как AJAX */
        if (Yii::$app->request->isAjax) {

            /** Переменная с куками пользователя, которые нам известны */
            $cookies = Yii::$app->request->cookies;

            /** Если у пользователя нет куки - dark_theme, т.е. темной темы */
            if ($cookies->get(CookieComponent::NAME_DARK_THEME) == null) {

                /** Сетапим кукис с темной темой сайта на 1 год */
                CookieComponent::setDarkTheme();

                /** Указываем во вьюхе сделать темную тему */
                return CookieComponent::NAME_DARK_THEME;
            }

            /** Удаляем кукис темной темы, если он был при запросе сюда */
            Yii::$app->response->cookies->remove(CookieComponent::NAME_DARK_THEME);

            /** Указываем во вьюхе сделать светлую тему */
            return CookieComponent::NAME_LIGHT_THEME;
        }

        /** Эксепшн, для тех кто пытается сюда без AJAX попасть */
        throw new HttpException(ResponseStatusInterface::NOT_FOUND_CODE ,'Такая страница не существует');
    }
}