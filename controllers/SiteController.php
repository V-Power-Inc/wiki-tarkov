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
use app\common\controllers\AdvancedController;
use yii\web\HttpException;
use yii\data\Pagination;
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

    /** Кеширование по секундам с различными сроками **/
    const ONE_HOUR = 3600;

    /** CSRF валидация POST запросов методов этого контроллера включена по умолачнию */
    public $enableCsrfValidation;

    /**
     * Массив поведения данного контроллера
     *
     * @return array|array[]
     */
    public function behaviors(): array
    {
        return [
            [
                'class' => 'yii\filters\PageCache',
                'duration' => 3600,
                'only' => ['index','table-patrons'],
                'variations' => [
                    $_SERVER['SERVER_NAME'],
                    Yii::$app->request->url,
                    Yii::$app->response->statusCode,
                    Yii::$app->request->get('page')
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
        $pagination = new Pagination(['defaultPageSize' => 10,'totalCount' => $query->count(),]);
        $news = $query->offset($pagination->offset)->orderby(['date_create'=>SORT_DESC])->limit($pagination->limit)->cache(self::ONE_HOUR)->all();
        $request = \Yii::$app->request;
        return $this->render('news/list.php', ['news'=>$news, 'active_page' => $request->get('page',1),'count_pages' => $pagination->getPageCount(), 'pagination' => $pagination,]);
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
        $models = Articles::find()->where(['url'=>$id])->andWhere(['enabled' => 1])->cache(self::ONE_HOUR)->One();
        if($models) {
            return $this->render('articles/detail.php',['model' => $models]);
        } else {
            throw new HttpException(404 ,'Такая страница не существует');
        }
    }

    /**
     * Рендер страницы справочника вопрос-ответ
     *
     * @return string
     */
    public function actionQuestions(): string
    {
        $model = Questions::find()->where(['enabled' => 1]);

        $pagination = new Pagination(['defaultPageSize' => 20,'totalCount' => $model->count(),]);
        $questions = $model->offset($pagination->offset)->orderby(['date_create'=>SORT_DESC])->limit($pagination->limit)->cache(self::ONE_HOUR)->all();
        $request = \Yii::$app->request;

        return $this->render('questions/list.php', ['questions' => $questions, 'active_page' => $request->get('page',1),'count_pages' => $pagination->getPageCount(), 'pagination' => $pagination]);
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
     * Рендер страницы для тех кто отключил использование JavaScript на сайте
     *
     * @return string
     */
    public function actionJsdisabled(): string
    {
        return $this->render('/site/offedjs');
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
