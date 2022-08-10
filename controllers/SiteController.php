<?php

namespace app\controllers;

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
use yii\db\Query;

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

    /** Рендер главной страницы сайта  **/
    public function actionIndex()
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
    
    /** Рендер страницы с наборами ключей **/
    public function actionKeys()
    {
        $zavod = Doorkeys::find()->andWhere(['active' => 1])->andWhere(['like', 'mapgroup', ['Завод']])->asArray()->cache(self::ONE_HOUR)->orderby(['name' => SORT_STRING])->limit(20)->all();
        $forest = Doorkeys::find()->andWhere(['active' => 1])->andWhere(['like', 'mapgroup', ['Лес']])->asArray()->cache(self::ONE_HOUR)->orderby(['name' => SORT_STRING])->limit(20)->all();
        $bereg = Doorkeys::find()->andWhere(['active' => 1])->andWhere(['like', 'mapgroup', ['Берег']])->asArray()->cache(self::ONE_HOUR)->orderby(['name' => SORT_STRING])->limit(20)->all();
        $tamojnya = Doorkeys::find()->andWhere(['active' => 1])->andWhere(['like', 'mapgroup', ['Таможня']])->asArray()->cache(self::ONE_HOUR)->orderby(['name' => SORT_STRING])->limit(20)->all();
        $razvyazka = Doorkeys::find()->andWhere(['active' => 1])->andWhere(['like', 'mapgroup', ['Развязка']])->asArray()->cache(self::ONE_HOUR)->orderby(['name' => SORT_STRING])->limit(20)->all();
        $terralab = Doorkeys::find()->andWhere(['active' => 1])->andWhere(['like', 'mapgroup', ['Лаборатория Terra Group']])->asArray()->cache(60)->orderby(['name' => SORT_STRING])->limit(60)->all();
       
        $form_model = new Doorkeys();
        if ($form_model->load(Yii::$app->request->post())) {
            if(isset($_POST['Doorkeys']['doorkey'])){
                $doorkey = $_POST['Doorkeys']['doorkey'];
            }else{
                $doorkey = "Все ключи";
            }
           
            $words = ["Лаборатория Terra Group","Берег","Таможня","Завод","Лес","Все ключи", "3-х этажная общага на Таможне", "2-х этажная общага на Таможне", "Восточное крыло санатория", "Западное крыло санатория", "Ключи от техники", "Квестовые ключи", "Ключи от сейфов/помещений с сейфами","Развязка"];
            /** Если пришел Берег через POST **/
            if(in_array($doorkey,$words)) {
                $curentWord =  $words[array_search($doorkey,$words)];
               if($curentWord == "Все ключи"){
                   $result = Doorkeys::find()->where(['active' => 1])->orderby(['name' => SORT_STRING])->cache(self::ONE_HOUR)->all();
               }else{
                   $result = Doorkeys::find()->andWhere(['active' => 1])->andWhere(['like', 'mapgroup', [$curentWord]])->orderby(['name' => SORT_STRING])->cache(self::ONE_HOUR)->all();
               }
                
                return $this->render('keys/keyseach.php',
                    [
                        'form_model' => $form_model,
                        'keysearch' => $result,
                        'arr' => $curentWord,]);
            }
        } else {
            return $this->render('keys/index.php',
                [
                    'terralab'=>$terralab,
                    'zavod'=>$zavod,
                    'forest'=>$forest,
                    'bereg'=>$bereg,
                    'tamojnya'=>$tamojnya,
                    'razvyazka' => $razvyazka,
                    'form_model' => $form_model]);
        }
    }
    
    /** Рендер детальной страницы для вывода ключей  **/
    public function actionDoorkeysdetail($id)
    {
        $models = Doorkeys::find()->where(['url'=>$id])->andWhere(['active' => 1])->cache(self::ONE_HOUR)->One();
        if($models) {
        return $this->render('keys/detail-key.php',['model' => $models]);
        } else {
            throw new HttpException(404 ,'Такая страница не существует');
        }
    }
    
    /** Рендер страницы списка новостей **/
    public function actionNews()
    {
        $query =  News::find()->andWhere(['enabled' => 1]);
        $pagination = new Pagination(['defaultPageSize' => 10,'totalCount' => $query->count(),]);
        $news = $query->offset($pagination->offset)->orderby(['date_create'=>SORT_DESC])->limit($pagination->limit)->cache(self::ONE_HOUR)->all();
        $request = \Yii::$app->request;
        return $this->render('news/list.php', ['news'=>$news, 'active_page' => $request->get('page',1),'count_pages' => $pagination->getPageCount(), 'pagination' => $pagination,]);
    }
    
    /** Рендер детальной страницы новости **/
    public function actionNewsdetail($id)
    {
        $models = News::find()->where(['url'=>$id])->andWhere(['enabled' => 1])->cache(self::ONE_HOUR)->One();
        if($models) {
            return $this->render('news/detail.php',['model' => $models]);
        } else {
            throw new HttpException(404 ,'Такая страница не существует');
        }
    }
    
    /** Рендер страницы списка полезных статей  **/
    public function actionArticles()
    {
        $query =  Articles::find()->andWhere(['enabled' => 1]);
        $pagination = new Pagination(['defaultPageSize' => 10,'totalCount' => $query->count(),]);
        $news = $query->offset($pagination->offset)->orderby(['date_create'=>SORT_DESC])->limit($pagination->limit)->cache(self::ONE_HOUR)->all();
        $request = \Yii::$app->request;
        return $this->render('articles/list.php', ['news'=>$news, 'active_page' => $request->get('page',1),'count_pages' => $pagination->getPageCount(), 'pagination' => $pagination,]);
    }

    /** Рендер детальной страницы полезной статьи **/
    public function actionArticledetail($id)
    {
        $models = Articles::find()->where(['url'=>$id])->andWhere(['enabled' => 1])->cache(self::ONE_HOUR)->One();
        if($models) {
            return $this->render('articles/detail.php',['model' => $models]);
        } else {
            throw new HttpException(404 ,'Такая страница не существует');
        }
    }
    
    /*** Рендер страницы справочника вопрос-ответ ***/
    public function actionQuestions()
    {
        $model = Questions::find()->where(['enabled' => 1]);

        $pagination = new Pagination(['defaultPageSize' => 20,'totalCount' => $model->count(),]);
        $questions = $model->offset($pagination->offset)->orderby(['date_create'=>SORT_DESC])->limit($pagination->limit)->cache(self::ONE_HOUR)->all();
        $request = \Yii::$app->request;
        
        return $this->render('questions/list.php', ['questions' => $questions, 'active_page' => $request->get('page',1),'count_pages' => $pagination->getPageCount(), 'pagination' => $pagination]);
    }
    
    /*** Данные о доступных ключах от дверей в формате Json - выборка только по включенным ***/
    public function actionKeysjson($q = null)
    {
        if(Yii::$app->request->isAjax) {
            $query = new Query;

            $query->select('name, mapgroup, preview, url')
                ->from('doorkeys')
                ->where('name LIKE "%' . $q . '%"')
                ->orWhere('keywords LIKE "%' . $q . '%"')
                ->andWhere(['active' => 1])
                ->orderBy('name')
                ->cache(3600);
            $command = $query->createCommand();
            $data = $command->queryAll();

            $out = [];

            /** Цикл составления готовых данных по запросу пользователя в поиске **/
            foreach ($data as $d) {
                $out[] = ['value' => $d['name'], 'name' => $d['name'], 'preview' => $d['preview'], 'url' => $d['url'], 'mapgroup' => $d['mapgroup']];
            }
            return Json::encode($out);
        } else {
            throw new HttpException(404 ,'Такая страница не существует');
        }
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

    /*** Отдаем валюты из базы в JSON формате ***/
    public function actionJsonvalute()
    {
        if(Yii::$app->request->isAjax) {
            $valutes = Currencies::find()->where(['enabled' => 1])->asArray()->all();
            return Json::encode($valutes);
        } else {
            throw new HttpException(404 ,'Такая страница не существует');
        }
    }

    /*** Рендер страницы для тех кто отключил использование JavaScript на сайте ***/
    public function actionJsdisabled()
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
