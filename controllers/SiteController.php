<?php

namespace app\controllers;

use app\common\services\PaginationService;
use app\models\Doorkeys;
use app\models\News;
use app\models\Articles;
use app\models\Questions;
use app\models\Currencies;
use app\models\Patrons;
use Yii;
use yii\helpers\Json;
use yii\web\Cookie;
use app\common\controllers\AdvancedController;
use yii\web\HttpException;
use app\common\services\KeysService;
use app\common\services\JsondataService;

/**
 * Основной контроллер сайта (Изначально существующий)
 *
 * Class SiteController
 * @package app\controllers
 */
class SiteController extends AdvancedController
{
    /** Константы для передачи в маршрутизатор /config/routes.php */
    const ACTION_INDEX                  = 'index';
    const ACTION_TABLE_PATRONS          = 'table-patrons';
    const ACTION_KEYS                   = 'keys';
    const ACTION_DOORKEYSDETAIL         = 'doorkeysdetail';
    const ACTION_NEWS                   = 'news';
    const ACTION_NEWSDETAIL             = 'newsdetail';
    const ACTION_ARTICLES               = 'articles';
    const ACTION_ARTICLESARTICLESDETAIL = 'articlesdetail';
    const ACTION_QUESTIONS              = 'questions';
    const ACTION_KEYSJSON               = 'keysjson';
    const ACTION_CURRENCIES             = 'currencies';
    const ACTION_JSDISABLED             = 'jsdisabled';
    const ACTION_JSONVALUTE             = 'jsonvalute';
    const ACTION_CLOSE_OVERLAY          = 'close-overlay';
    const ACTION_CHANGE_LAYOUT          = 'change-layout';

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
                    'index',
                    'table-patrons',
                    'keys',
                    'doorkeysdetail',
                    'news',
                    'newsdetail',
                    'articles',
                    'articledetail',
                    'questions',
                    'currencies'
                ],
                'variations' => [
                    $_SERVER['SERVER_NAME'],
                    Yii::$app->request->url,
                    Yii::$app->response->statusCode,
                    Yii::$app->request->get('page'),
                    Yii::$app->request->cookies->get('overlay'),
                    Yii::$app->request->cookies->get('dark_theme')
                ]
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
        return $this->render('index');
    }

    /**
     * Рендер страницы с таблицей патронов
     *
     * @return string
     */
    public function actionTablePatrons(): string
    {
        return $this->render('/site/patrons', ['patrons' => Patrons::takePatrons()]);
    }

    /**
     * Рендер страницы с наборами ключей
     *
     * @return string
     */
    public function actionKeys(): string
    {
        $form_model = new Doorkeys();

        if ($form_model->load(Yii::$app->request->post())) {

            return $this->render('keys/keyseach.php', [
                    'form_model' => $form_model,
                    'keysearch' => KeysService::takeResult($form_model),
                    'formValue' => (string)Doorkeys::KeysCategories()[$form_model->doorkey]
            ]);
        }

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
        if(Doorkeys::findActiveKeyByUrl($id)) {
            return $this->render('keys/detail-key.php',['model' => Doorkeys::findActiveKeyByUrl($id)]);
        }

        throw new HttpException(404 ,'Такая страница не существует');
    }

    /**
     * Рендер страницы списка новостей
     *
     * @return string
     */
    public function actionNews(): string
    {
        $query =  News::find()->andWhere(['enabled' => 1]);
        $data = new PaginationService($query,10);
        return $this->render('news/list.php', [
            'news'=>$data->items,
            'active_page' => Yii::$app->request->get('page',1),
            'count_pages' => $data->paginator->getPageCount(),
            'pagination' => $data->paginator
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
        if(News::findActiveNewsByUrl($id)) {
            return $this->render('news/detail.php',['model' => News::findActiveNewsByUrl($id)]);
        }

        throw new HttpException(404 ,'Такая страница не существует');
    }

    /**
     * Рендер страницы списка полезных статей
     *
     * @return string
     */
    public function actionArticles(): string
    {
        $query = Articles::find()->andWhere(['enabled' => 1]);
        $data = new PaginationService($query);
        return $this->render('articles/list.php', [
            'news'=> $data->items,
            'active_page' => Yii::$app->request->get('page',1),
            'count_pages' => $data->paginator->getPageCount(),
            'pagination' => $data->paginator
        ]);
    }

    /**
     * Рендер детальной страницы полезной статьи
     *
     * @param $id - параметр url статьи
     * @return string
     * @throws HttpException
     */
    public function actionArticledetail($id): string
    {
        if(Articles::takeActiveArticleById($id)) {
            return $this->render('articles/detail.php',['model' => Articles::takeActiveArticleById($id)]);
        }

        throw new HttpException(404 ,'Такая страница не существует');
    }

    /**
     * Рендер страницы справочника вопрос-ответ
     *
     * @return string
     */
    public function actionQuestions(): string
    {
        $model = Questions::find()->where(['enabled' => 1]);
        $data = new PaginationService($model);
        return $this->render('questions/list.php', [
            'questions' => $data->items,
            'active_page' => Yii::$app->request->get('page',1),
            'count_pages' => $data->paginator->getPageCount(),
            'pagination' => $data->paginator
        ]);
    }

    /**
     * Данные о доступных ключах от дверей в формате Json - выборка только по включенным
     *
     * @param null $q - ключевое слово запроса
     * @return string
     * @throws HttpException
     * @throws \yii\db\Exception
     */
    public function actionKeysjson($q = null): string
    {
        if(Yii::$app->request->isAjax) {
            return JsondataService::getKeysJson($q);
        }

        throw new HttpException(404 ,'Такая страница не существует');
    }

    /**
     * Рендер страницы справочника валют
     *
     * @return string
     */
    public function actionCurrencies(): string
    {
        return $this->render('currencies/index.php', [
            'dollar' => Currencies::takeDollar(),
            'euro' => Currencies::takeEuro(),
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
        if(Yii::$app->request->isAjax) {
            return Json::encode(Currencies::takeActiveValutes());
        }

        throw new HttpException(404 ,'Такая страница не существует');
    }

    /**
     * Этот метод вешает куку overlay - которая скрывает рекламный блок overlay на всех страницах
     * сайта на один день (Попадаем сюда с помощью Ajax при клике на кнопку "Закрыть" рекламного блока)
     *
     * time() + (60 * 60 * 24) - 1 день
     * time() + (60 * 60 * 12) - 12 часов
     *
     * @return mixed
     * @throws HttpException - Если без AJAX пытаются сюда лезть прямым запросом
     */
    public function actionCloseOverlay()
    {
        /** Если запрос отправлен через AJAX */
        if (Yii::$app->request->isAjax) {

            /** Сетапим куки из запроса на сервак в переменную */
            $cookies = Yii::$app->request->cookies;

            /** Если у поступающего сюда запроса не определена кука Overlay */
            if($cookies->get('overlay') == null) {

                /** Создаем ее и задаем срок истечения 12 часов, в течении этого времени блок overlay будет скрыт у посетителя */
                return Yii::$app->response->cookies->add(new Cookie([
                    'name' => 'overlay',
                    'value' => 1,
                    'expire' => time() + (60 * 60 * 12),
                ]));
            }
        }

        /** Исключение - в случае если сюда пытались залезть прямым запросом */
        throw new HttpException(404 ,'Такая страница не существует');
    }

    /**
     * Метод определяет, какую тему необходимо отобразить пользователю, в зависимости
     * от наличия определенного кукиса - либо удаляет существующую куку, либо сетапит ее
     *
     * time() + 3600 * 24 * 365 - 1 год, срок жизни куки
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
            if ($cookies->get('dark_theme') == null) {

                /** Сетапим кукис на 1 год */
                Yii::$app->response->cookies->add(new Cookie([
                    'name' => 'dark_theme',
                    'value' => 1,
                    'expire' => time() + 3600 * 24 * 365
                ]));

                /** Указываем во вьюхе сделать темную тему */
                return 'dark-theme';
            }

            /** Удаляем кукис темной темы, если он был при запросе сюда */
            Yii::$app->response->cookies->remove('dark_theme');

            /** Указываем во вьюхе сделать светлую тему */
            return 'light-theme';
        }

        /** Эксепшн, для тех кто пытается сюда без AJAX попасть */
        throw new HttpException(404 ,'Такая страница не существует');
    }

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