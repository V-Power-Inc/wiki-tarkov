<?php

namespace app\controllers;

use app\models\Mehanic;
use app\models\Razvyazka;
use app\models\Skypshik;
use app\models\Lyjnic;
use app\models\Terapevt;
use app\models\Prapor;
use app\models\Mirotvorec;
use app\models\Baraholshik;
use app\models\Leshy;
use app\models\Warden;
use app\models\Bashkir;
use app\models\Khokhol;
use app\models\Zavod;
use app\models\Forest;
use app\models\Tamojnya;
use app\models\Bereg;
use app\models\Doorkeys;
use app\models\News;
use app\models\Articles;
use app\models\Traders;
use app\models\Questions;
use app\models\Currencies;
use app\models\Barters;
use app\models\Laboratory;
use app\models\Reviews;
use app\models\Patrons;
use Yii;
use yii\helpers\Json;
use yii\web\Controller;
use yii\web\HttpException;
use yii\data\Pagination;
use yii\db\Query;
use yii\web\Cookie;
use yii\web\Response;
use yii\widgets\ActiveForm;
use app\components\MessagesComponent;


class SiteController extends Controller
{

    public function behaviors()
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

    /** Кеширование по секундам с различными сроками **/
    const ONE_HOUR = 3600;

    // CSRF валидация POST запросов методов этого контроллера включена по умолачнию
    public $enableCsrfValidation;

    /** Рендер главной страницы сайта  **/
    public function actionIndex()
    {
        return $this->render('index');
    }

    /** Рендер главной страницы с квестами **/
    public function actionQuests() {
        $traders = Traders::find()->where(['enabled' => 1])->orderby(['sortir'=>SORT_ASC])->cache(self::ONE_HOUR)->asArray()->all();
        return $this->render('quests/quests-main.php', ['traders' => $traders]);
    }

    /*** Заглушка для страницы Traders ***/
    public function actionTraders301() {
        return $this->redirect('/quests-of-traders', 301);
    }

    /** Рендер детальной страницы торговца **/
    public function actionTradersdetail($id) {

        $trader = Traders::find()->where(['url'=>$id])->andWhere(['enabled' => 1])->cache(self::ONE_HOUR)->One();

        if($trader) {
            $barters = Barters::find()->where(['like', 'title', $trader->title])->andWhere(['enabled' => 1])->orderby(['id'=>SORT_ASC])->cache(self::ONE_HOUR)->asArray()->all();
            return $this->render('traders/detail.php',['trader' => $trader, 'barters' => $barters]);
        } else {
            throw new HttpException(404 ,'Такая страница не существует');
        }
    }

    /** Рендер страницы квестов Прапора **/
    public function actionPraporpage() {
        $query =  Prapor::find();
        $prapor = $query->orderby(['tab_number'=>SORT_ASC])->cache(self::ONE_HOUR)->all();
        return $this->render('quests/prapor-quests.php' ,['prapor'=>$prapor,]);
    }
    
    /** Рендер страницы квестов Терапевта **/
    public function actionTerapevtpage() {
        $query =  Terapevt::find();
        $terapevt = $query->orderby(['tab_number'=>SORT_ASC])->cache(self::ONE_HOUR)->all();
        return $this->render('quests/terapevt-quests.php',['terapevt'=>$terapevt,]);
    }

    /** Рендер страницы квестов Скупщика **/
    public function actionSkypchikpage() {
        $query =  Skypshik::find();
        $skypshik = $query->orderby(['tab_number'=>SORT_ASC])->cache(30)->all();
        return $this->render('quests/skypshik-quests.php',['skypshik'=>$skypshik,]);
    }

    /** Рендер страницы квестов Лыжника **/
    public function actionLyjnicpage() {
        $query =  Lyjnic::find();
        $lyjnic = $query->orderby(['tab_number'=>SORT_ASC])->cache(self::ONE_HOUR)->all();
        return $this->render('quests/lyjnic-quests.php',['lyjnic'=>$lyjnic,]);
    }

    /** Рендер страницы квестов Миротворца **/
    public function actionMirotvorecpage() {
        $query =  Mirotvorec::find();
        $mirotvorec = $query->orderby(['tab_number'=>SORT_ASC])->cache(self::ONE_HOUR)->all();
        return $this->render('quests/mirotvorec-quests.php', ['mirotvorec'=>$mirotvorec,]);
    }

    /** Рендер страницы квестов Механика **/
    public function actionMehanicpage() {
        $query =  Mehanic::find();
        $mehanic = $query->orderby(['tab_number'=>SORT_ASC])->cache(self::ONE_HOUR)->all();
        return $this->render('quests/mehanic-quests.php', ['mehanic'=>$mehanic,]);
    }

    /** Рендер страницы квестов Барахольщика **/
    public function actionBaraholshikpage() {
        $query =  Baraholshik::find();
        $baraholshik = $query->orderby(['tab_number'=>SORT_ASC])->cache(self::ONE_HOUR)->all();
        return $this->render('quests/baraholshik-quests.php', ['baraholshik'=>$baraholshik,]);
    }

    /** Рендер страницы квестов Лешего **/
    public function actionLeshypage() {
        $query =  Leshy::find();
        $leshy = $query->orderby(['tab_number'=>SORT_ASC])->cache(self::ONE_HOUR)->all();
        return $this->render('quests/leshy-quests.php', ['leshy'=>$leshy,]);
    }

    /** Рендер страницы квестов Смотрителя (Перевод зависит от локализации разработчиков) **/
    public function actionWardenpage() {
        $query =  Warden::find();
        $warden = $query->orderby(['tab_number'=>SORT_ASC])->cache(self::ONE_HOUR)->all();
        return $this->render('quests/warden-quests.php', ['warden'=>$warden,]);
    }

    /** Рендер страницы квестов Башкира **/
    public function actionBashkirpage() {
        $query =  Bashkir::find();
        $bashkir = $query->orderby(['tab_number'=>SORT_ASC])->cache(self::ONE_HOUR)->all();
        return $this->render('quests/bashkir-quests.php', ['bashkir'=>$bashkir,]);
    }

    /** Рендер страницы квестов Хохла **/
    public function actionKhokholpage() {
        $query =  Khokhol::find();
        $khokhol = $query->orderby(['tab_number'=>SORT_ASC])->cache(self::ONE_HOUR)->all();
        return $this->render('quests/khokhol-quests.php', ['khokhol'=>$khokhol,]);
    }

    /** Рендер страницы со списком интерактивных карт **/
    public function actionLocations() {
          return $this->render('maps/maps.php');
    }

    /** Прилетают данные о статичном контенте описаний маркеров **/
//    public function actionStatic() {
//        if(Yii::$app->request->isAjax) {
//            $staticcontent = Mapstaticcontent::find()->asArray()->all();
//            return Json::encode($staticcontent);
//        } else {
//            throw new HttpException(404 ,'Такая страница не существует');
//        }
//    }

    /** JSON данные с координатами маркеров Завода **/
    public function actionZavodmarkers() {
        if(Yii::$app->request->isAjax) {
          //  $dependency = Zavod::find()->select('date_update')->orderBy(['date_update' => SORT_DESC])->scalar();
            $markers = Zavod::find()->asArray()->andWhere(['enabled' => 1])->cache(self::ONE_HOUR)->all();
            return Json::encode($markers);
        } else {
            throw new HttpException(404 ,'Такая страница не существует');
        }
    }

    /** JSON данные с координатами маркеров Леса **/
    public function actionForestmarkers() {
        if(Yii::$app->request->isAjax) {
          //  $dependency = Forest::find()->select('date_update')->orderBy(['date_update' => SORT_DESC])->scalar();
            $markers = Forest::find()->asArray()->andWhere(['enabled' => 1])->cache(self::ONE_HOUR)->all();
            return Json::encode($markers);
        } else {
            throw new HttpException(404 ,'Такая страница не существует');
        }
    }

    /** JSON данные с координатами маркеров Таможни **/
    public function actionTamojnyamarkers() {
        if(Yii::$app->request->isAjax) {
          //  $dependency = Tamojnya::find()->select('date_update')->orderBy(['date_update' => SORT_DESC])->scalar();
            $markers = Tamojnya::find()->asArray()->andWhere(['enabled' => 1])->cache(self::ONE_HOUR)->all();
            return Json::encode($markers);
        } else {
            throw new HttpException(404 ,'Такая страница не существует');
        }
    }

    /** JSON данные с координатами маркеров Берега **/
    public function actionBeregmarkers() {
        if(Yii::$app->request->isAjax) {
          //  $dependency = Bereg::find()->select('date_update')->orderBy(['date_update' => SORT_DESC])->scalar();
            $markers = Bereg::find()->asArray()->andWhere(['enabled' => 1])->cache(self::ONE_HOUR)->all();
            return Json::encode($markers);
        } else {
            throw new HttpException(404 ,'Такая страница не существует');
        }
    }
    
    /** JSON данные с координатами маркеров Развязки **/
    public function actionRazvyazkamarkers() {
        if(Yii::$app->request->isAjax) {
         //   $dependency = Razvyazka::find()->select('date_update')->orderBy(['date_update' => SORT_DESC])->scalar();
            $markers = Razvyazka::find()->asArray()->andWhere(['enabled' => 1])->cache(self::ONE_HOUR)->all();
            return Json::encode($markers);
        } else {
            throw new HttpException(404 ,'Такая страница не существует');
        }
    }

    /** JSON данные с координатами маркеров Лаборатории **/
    public function actionLaboratorymarkers() {
        if(Yii::$app->request->isAjax) {
            //   $dependency = Razvyazka::find()->select('date_update')->orderBy(['date_update' => SORT_DESC])->scalar();
            $markers = Laboratory::find()->asArray()->andWhere(['enabled' => 1])->cache(self::ONE_HOUR)->all();
            return Json::encode($markers);
        } else {
            throw new HttpException(404 ,'Такая страница не существует');
        }
    }

    /** Рендер страницы с картой завода **/
    public function actionZavod() {
        return $this->render('maps/zavod-location.php');
    }

    /** Рендер страницы с картой Леса **/
    public function actionForest() {
        return $this->render('maps/forest-location.php');
    }

    /** Рендер страницы с картой Таможни **/
    public function actionTamojnya() {
        return $this->render('maps/tamojnya-location.php');
    }

    /** Рендер страницы с картой Берега **/
    public function actionBereg() {
        return $this->render('maps/bereg-location.php');
    }
    
    /** Рендер страницы с картой Развязки **/
    public function actionRazvyazka(){
        return $this->render('maps/razvyazka-location.php');
    }

    /** Рендер страницы с картой лаборатории TerraGroup **/
    public function actionLaboratoryterra() {
        return $this->render('maps/laboratory-location.php');
    }

    /** Рендер страницы с картой Резерва **/
    public function actionRezerv() {
        return $this->render('maps/rezerv.php');
    }

    /** Рендер страницы с картой Резерва **/
    public function actionLighthouse() {
        return $this->render('maps/lighthouse.php');
    }

    /** Рендер страницы с картой Резерва **/
    public function actionTablePatrons() {
        $patrons = Patrons::find()->orderBy(['id' => SORT_DESC])->asArray()->cache(self::ONE_HOUR)->all();
        return $this->render('/site/patrons', ['patrons' => $patrons]);
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
    public function actionNews() {
        $query =  News::find()->andWhere(['enabled' => 1]);
        $pagination = new Pagination(['defaultPageSize' => 10,'totalCount' => $query->count(),]);
        $news = $query->offset($pagination->offset)->orderby(['date_create'=>SORT_DESC])->limit($pagination->limit)->cache(self::ONE_HOUR)->all();
        $request = \Yii::$app->request;
        return $this->render('news/list.php', ['news'=>$news, 'active_page' => $request->get('page',1),'count_pages' => $pagination->getPageCount(), 'pagination' => $pagination,]);
    }
    
    /** Рендер детальной страницы новости **/
    public function actionNewsdetail($id) {
        $models = News::find()->where(['url'=>$id])->andWhere(['enabled' => 1])->cache(self::ONE_HOUR)->One();
        if($models) {
            return $this->render('news/detail.php',['model' => $models]);
        } else {
            throw new HttpException(404 ,'Такая страница не существует');
        }
    }
    
    /** Рендер страницы списка полезных статей  **/
    public function actionArticles() {
        $query =  Articles::find()->andWhere(['enabled' => 1]);
        $pagination = new Pagination(['defaultPageSize' => 10,'totalCount' => $query->count(),]);
        $news = $query->offset($pagination->offset)->orderby(['date_create'=>SORT_DESC])->limit($pagination->limit)->cache(self::ONE_HOUR)->all();
        $request = \Yii::$app->request;
        return $this->render('articles/list.php', ['news'=>$news, 'active_page' => $request->get('page',1),'count_pages' => $pagination->getPageCount(), 'pagination' => $pagination,]);
    }

    /** Рендер детальной страницы полезной статьи **/
    public function actionArticledetail($id) {
        $models = Articles::find()->where(['url'=>$id])->andWhere(['enabled' => 1])->cache(self::ONE_HOUR)->One();
        if($models) {
            return $this->render('articles/detail.php',['model' => $models]);
        } else {
            throw new HttpException(404 ,'Такая страница не существует');
        }
    }
    
    /*** Рендер страницы справочника вопрос-ответ ***/
    public function actionQuestions() {
        $model = Questions::find()->where(['enabled' => 1]);

        $pagination = new Pagination(['defaultPageSize' => 20,'totalCount' => $model->count(),]);
        $questions = $model->offset($pagination->offset)->orderby(['date_create'=>SORT_DESC])->limit($pagination->limit)->cache(self::ONE_HOUR)->all();
        $request = \Yii::$app->request;
        
        return $this->render('questions/list.php', ['questions' => $questions, 'active_page' => $request->get('page',1),'count_pages' => $pagination->getPageCount(), 'pagination' => $pagination]);
    }
    
    /*** Данные о доступных ключах от дверей в формате Json - выборка только по включенным ***/
    public function actionKeysjson($q = null) {
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
    public function actionCurrencies() {
        $dollar = Currencies::find()->where(['title' => 'Доллар'])->cache(self::ONE_HOUR)->One();
        $euro = Currencies::find()->where(['title' => 'Евро'])->cache(self::ONE_HOUR)->One();
        $bitkoin = Currencies::find()->where(['title' => 'Биткоин'])->cache(self::ONE_HOUR)->One();
        
        return $this->render('currencies/index.php', ['dollar' => $dollar, 'euro' => $euro, 'bitkoin' => $bitkoin]);
    }
    
    /*** Отдаем валюты из базы в JSON формате ***/
    public function actionJsonvalute() {
        if(Yii::$app->request->isAjax) {
            $valutes = Currencies::find()->where(['enabled' => 1])->asArray()->all();
            return Json::encode($valutes);
        } else {
            throw new HttpException(404 ,'Такая страница не существует');
        }
    }

    /** Рендер страницы предпросмотра детальной страницы торговца **/
    public function actionPreviewtrader() {
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
    public function actionBartersPreview() {
        if(Yii::$app->user->isGuest !== true) {
            $barter = new Barters;
            $barter->load(Yii::$app->request->post());

            $id = Barters::find()->select('id')->where(['title' => $barter->title])->scalar();

            return $this->render('traders/barter-preview.php', ['barter' => $barter, 'id' => $id]);
        } else {
            throw new HttpException(404 ,'Такая страница не существует');
        }
    }

    /*** Устанавливаем кукис отключающий появление уведомления в нижней части экрана ***/
    public function actionClsalert() {
        if(Yii::$app->request->isAjax) {
            $cookies = Yii::$app->request->cookies;
            $addcook = Yii::$app->response->cookies;

            if(!isset($cookies['as-remind'])) {
                $addcook->add(new Cookie([
                    'name' => 'as-remind',
                    'value' => 1,
                    'expire' => time() + (10 * 365 * 24 * 60 * 60),
                    'secure' => true,
                ]));
            } else {
                throw new HttpException(404 ,'Такая страница не существует');
            }
        } else {
            throw new HttpException(404 ,'Такая страница не существует');
        }
    }

    /*** Рендер страницы для тех кто отключил использование JavaScript на сайте ***/
    public function actionJsdisabled() {
        return $this->render('/site/offedjs');
    }

    /*** Рендер страницы сделок с отзывами об онлайн торговце - отключено на продакшене от 13_02_2019 - редиректим на главную ***/
    public function actionReviews() {
        // Сделки не могут проводиться на сайте - теперь редирект на главную страницу
        return $this->goHome();
    }

    /*** Обработчик сохранения нового отзыва, отправленного пользователем - отключено на продакшене от 13_02_2019 ***/
    public function actionSavereview() {
        // Сделки не могут проводиться на сайте - теперь редирект на главную страницу
        return $this->goHome();
    }

    /*** Рендер страницы с информацией о донатах - включить при необходимости ***/
//    public function actionDonates() {
//        return $this->render('/site/donates');
//    }

    /**
     * Метод запускает git pull на текущую ветку проекта (Вебхук для битбакета)
     *
     * @return string
     */
//    public function actionBitbucketHook(): string
//    {
//        // Задержка перед git pull reborn
//        sleep(40);
//
//        // todo: Логировать все это
//        // git pull after events on bitbucket (git push, git merge)
//        system('cd /var/www/wiki-tarkov/html && git pull origin reborn');
//
//        return 'ОК';
//    }

    
    /** Обработчик ошибок - отображает статусы ответа сервера **/
    public function actions()
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
