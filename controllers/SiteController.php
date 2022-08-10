<?php

namespace app\controllers;

use app\models\Mehanic;
use app\models\Skypshik;
use app\models\Lyjnic;
use app\models\Terapevt;
use app\models\Prapor;
use app\models\Mirotvorec;
use app\models\Baraholshik;
use app\models\Doorkeys;
use app\models\News;
use app\models\Articles;
use app\models\Traders;
use app\models\Questions;
use app\models\Currencies;
use app\models\Barters;
use app\models\Patrons;
use Yii;
use yii\helpers\Json;
use app\common\controllers\AdvancedController;
use yii\web\HttpException;
use yii\data\Pagination;
use yii\db\Query;

/**
 * todo: Рефакторинг этого контроллера уже на подходе
 *
 * Class SiteController
 * @package app\controllers
 */
class SiteController extends AdvancedController
{
    /** Константы для передачи в маршрутизатор /config/routes.php */
    const ACTION_INDEX                  = 'index';
    const ACTION_QUESTS                 = 'quests';
    const ACTION_TRADERSDETAIL          = 'tradersdetail';
    const ACTION_PRAPORPAGE             = 'praporpage';
    const ACTION_TERAPEVTPAGE           = 'terapevtpage';
    const ACTION_SKYPCHIKPAGE           = 'skypchikpage';
    const ACTION_LYJNICPAGE             = 'lyjnicpage';
    const ACTION_MIROTVORECPAGE         = 'mirotvorecpage';
    const ACTION_MEHANICPAGE            = 'mehanicpage';
    const ACTION_BARAHOLSHIKPAGE        = 'baraholshikpage';
    const ACTION_TABLE_PATRONS          = 'table-patrons';
    const ACTION_KEYS                   = 'keys';
    const ACTION_DOORKEYSDETAIL         = 'doorkeysdetail';
    const ACTION_NEWS                   = 'news';
    const ACTION_NEWSDETAIL             = 'newsdetail';
    const ACTION_ARTICLES               = 'articlers';
    const ACTION_ARTICLESARTICLESDETAIL = 'articlesdetail';
    const ACTION_QUESTIONS              = 'questions';
    const ACTION_KEYSJSON               = 'keysjson';
    const ACTION_CURRENCIES             = 'currencies';
    const ACTION_JSONVALUTE             = 'jsonvalute';
    const ACTION_BARTERS_PREVIEW        = 'barters-preview';
    const ACTION_PREVIEWTRADER          = 'previewtrader';
    const ACTION_JSDISABLED             = 'jsdisabled';

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

    /** Рендер главной страницы с квестами **/
    public function actionQuests(): string
    {
        return $this->render('quests/quests-main.php', ['traders' => Traders::takeTraders()]);
    }

    /**
     * Рендер детальной страницы торговца
     *
     * @param $id - url адрес торговца
     * @return string
     * @throws HttpException
     */
    public function actionTradersdetail($id): string
    {
        // Traders::takeTraderByUrl($url)
        $trader = Traders::find()->where(['url'=>$id])->andWhere(['enabled' => 1])->cache(self::ONE_HOUR)->One();

        if($trader) {
            // takeBartersByTitle(Traders::takeTraderByUrl($url)->title)
            $barters = Barters::find()->where(['like', 'title', $trader->title])->andWhere(['enabled' => 1])->orderby(['id'=>SORT_ASC])->cache(self::ONE_HOUR)->asArray()->all();
            return $this->render('traders/detail.php',['trader' => $trader, 'barters' => $barters]);
        } else {
            throw new HttpException(404 ,'Такая страница не существует');
        }
    }

    /**
     * Рендер страницы квестов Прапора
     *
     * @return string
     */
    public function actionPraporpage(): string
    {
        return $this->render('quests/prapor-quests.php', ['prapor'=>Prapor::takeQuests()]);
    }

    /**
     * Рендер страницы квестов Терапевта
     *
     * @return string
     */
    public function actionTerapevtpage(): string
    {
        return $this->render('quests/terapevt-quests.php', ['terapevt'=>Terapevt::takeQuests()]);
    }

    /**
     * Рендер страницы квестов Скупщика
     *
     * @return string
     */
    public function actionSkypchikpage(): string
    {
        return $this->render('quests/skypshik-quests.php', ['skypshik'=>Skypshik::takeQuests()]);
    }

    /**
     * Рендер страницы квестов Лыжника
     *
     * @return string
     */
    public function actionLyjnicpage(): string
    {
        return $this->render('quests/lyjnic-quests.php', ['lyjnic'=>Lyjnic::takeQuests()]);
    }

    /**
     * Рендер страницы квестов Миротворца
     *
     * @return string
     */
    public function actionMirotvorecpage(): string
    {
        return $this->render('quests/mirotvorec-quests.php', ['mirotvorec'=>Mirotvorec::takeQuests()]);
    }

    /**
     * Рендер страницы квестов Механика
     *
     * @return string
     */
    public function actionMehanicpage(): string
    {
        return $this->render('quests/mehanic-quests.php', ['mehanic'=>Mehanic::takeQuests()]);
    }

    /**
     * Рендер страницы квестов Барахольщика
     *
     * @return string
     */
    public function actionBaraholshikpage(): string
    {
        return $this->render('quests/baraholshik-quests.php', ['baraholshik'=>Baraholshik::takeQuests()]);
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

    /*** Рендер страницы справочника валют ***/
    public function actionCurrencies()
    {
        $dollar = Currencies::find()->where(['title' => 'Доллар'])->cache(self::ONE_HOUR)->One();
        $euro = Currencies::find()->where(['title' => 'Евро'])->cache(self::ONE_HOUR)->One();
        $bitkoin = Currencies::find()->where(['title' => 'Биткоин'])->cache(self::ONE_HOUR)->One();
        
        return $this->render('currencies/index.php', ['dollar' => $dollar, 'euro' => $euro, 'bitkoin' => $bitkoin]);
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

    /** Рендер страницы предпросмотра детальной страницы торговца **/
    public function actionPreviewtrader()
    {
        if(Yii::$app->user->isGuest !== true) {
            // Отключаем CSRF валидацию POST запросов
            $this->enableCsrfValidation=false;
            $trader = new Traders;
            $trader->load(Yii::$app->request->post());
            return $this->render('traders/trader-preview.php', ['trader' => $trader]);
        } else {
            throw new HttpException(404 ,'Такая страница не существует');
        }
    }

    /*** Рендер страницы предпросмотра бартера торговцев ***/
    public function actionBartersPreview()
    {
        if(Yii::$app->user->isGuest !== true) {
            $barter = new Barters;
            $barter->load(Yii::$app->request->post());
            $id = Barters::find()->select('id')->where(['title' => $barter->title])->scalar();

            return $this->render('traders/barter-preview.php', ['barter' => $barter, 'id' => $id]);
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
