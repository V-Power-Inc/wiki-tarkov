<?php

namespace app\controllers;

use app\models\Mehanic;
use Yii;
use app\models\Lyjnic;
use app\models\Terapevt;
use app\models\Prapor;
use app\models\Mirotvorec;
use app\models\Zavod;
use app\models\Forest;
use app\models\Tamojnya;
use app\models\Mapstaticcontent;
use app\models\Doorkeys;
use app\models\News;
use yii\helpers\Json;
use yii\web\Controller;
use yii\web\HttpException;
use yii\data\Pagination;


class SiteController extends Controller
{
    /**
     * Displays homepage.
     *
     * @return string
     */
    
    /** Рендер главной страницы сайта  **/
    public function actionIndex()
    {
        return $this->render('index');
    }

    /** Рендер главной страницы с квестами **/
    public function actionQuests() {
        return $this->render('quests/quests-main.php');
    }

    /** Рендер страницы квестов Прапора **/
    public function actionPraporpage() {
        $query =  Prapor::find();
        $prapor = $query->orderby(['tab_number'=>SORT_ASC])->all();
        return $this->render('quests/prapor-quests.php' ,['prapor'=>$prapor,]);
    }


    /** Рендер страницы квестов Терапевта **/
    public function actionTerapevtpage() {
        $query =  Terapevt::find();
        $terapevt = $query->orderby(['tab_number'=>SORT_ASC])->all();
        return $this->render('quests/terapevt-quests.php',['terapevt'=>$terapevt,]);
    }

    /** Рендер страницы квестов Скупщика **/
    public function actionSkypchikpage() {
        // Пока нет квестов - редирект
        $this->goHome();
      //  return $this->render('quests/skyp-quests.php');
    }

    /** Рендер страницы квестов Лыжника **/
    public function actionLyjnicpage() {
        $query =  Lyjnic::find();
        $lyjnic = $query->orderby(['tab_number'=>SORT_ASC])->all();
        return $this->render('quests/lyjnic-quests.php',['lyjnic'=>$lyjnic,]);
    }

    /** Рендер страницы квестов Миротворца **/
    public function actionMirotvorecpage() {
        $query =  Mirotvorec::find();
        $mirotvorec = $query->orderby(['tab_number'=>SORT_ASC])->all();
        return $this->render('quests/mirotvorec-quests.php', ['mirotvorec'=>$mirotvorec,]);
    }

    /** Рендер страницы квестов Скупщика **/
    public function actionMehanicpage() {
        // Пока нет квестов - редирект
          $this->goHome();

      // Включить строчки что идут ниже, после того как торговец механик появится в игре Escape from Tarkov.  
      //  $query =  Mehanic::find();
      //  $mehanic = $query->orderby(['tab_number'=>SORT_ASC])->all();
      //  return $this->render('quests/mehanic-quests.php', ['mehanic'=>$mehanic,]);
    }

    /** Рендер страницы со списком интерактивных карт **/
    public function actionLocations() {
          return $this->render('maps/maps.php');
    }

    /** Прилетают данные о статичном контенте описаний маркеров **/
    public function actionStatic() {
        $staticcontent = Mapstaticcontent::find()->asArray()->all();
        return Json::encode($staticcontent);
    }

    /** JSON данные с координатами маркеров Завода **/
    public function actionZavodmarkers() {
        $markers = Zavod::find()->asArray()->andWhere(['enabled' => 1])->all();
        return Json::encode($markers);
    }

    /** JSON данные с координатами маркеров Леса **/
    public function actionForestmarkers() {
        $markers = Forest::find()->asArray()->andWhere(['enabled' => 1])->all();
        return Json::encode($markers);
    }

    /** JSON данные с координатами маркеров Таможни **/
    public function actionTamojnyamarkers() {
        $markers = Tamojnya::find()->asArray()->andWhere(['enabled' => 1])->all();
        return Json::encode($markers);
    }

    /** Рендер страницы с картой завода **/
    public function actionZavod() {
        return $this->render('maps/zavod-location.php');
    }

    /** Рендер страницы с картой Леса **/
    public function actionForest() {
        return $this->render('maps/forest-location.php');
    }

    /** Рендер страницы с наборами ключей **/
    public function actionKeys()
    {
        $zavod = Doorkeys::find()->andWhere(['active' => 1])->andWhere(['like', 'mapgroup', ['Завод']])->orderby(['id' => SORT_ASC])->all();
        $forest = Doorkeys::find()->andWhere(['active' => 1])->andWhere(['like', 'mapgroup', ['Лес']])->orderby(['id' => SORT_ASC])->all();
        $bereg = Doorkeys::find()->andWhere(['active' => 1])->andWhere(['like', 'mapgroup', ['Берег']])->orderby(['id' => SORT_ASC])->all();
        $tamojnya = Doorkeys::find()->andWhere(['active' => 1])->andWhere(['like', 'mapgroup', ['Таможня']])->orderby(['id' => SORT_ASC])->all();
        $form_model = new Doorkeys();
        if ($form_model->load(Yii::$app->request->post())) {
            if(isset($_POST['Doorkeys']['doorkey'])){
                $doorkey = $_POST['Doorkeys']['doorkey'];
            }else{
                $doorkey = "Все ключи";
            }
           
            $words = ["Берег","Таможня","Завод","Лес","Все ключи"];
            /** Если пришел Берег через POST **/
            if(in_array($doorkey,$words)) {
                $curentWord =  $words[array_search($doorkey,$words)];
               if($curentWord == "Все ключи"){
                   $result = Doorkeys::find()->where(['active' => 1])->orderby(['id' => SORT_ASC])->all();
               }else{
                   $result = Doorkeys::find()->andWhere(['active' => 1])->andWhere(['like', 'mapgroup', [$curentWord]])->orderby(['id' => SORT_ASC])->all();
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
                    'zavod'=>$zavod,
                    'forest'=>$forest,
                    'bereg'=>$bereg,
                    'tamojnya'=>$tamojnya,
                    'form_model' => $form_model]);
        }
    }
    
    /** Рендер детальной страницы для вывода ключей  **/
    public function actionDoorkeysdetail($id)
    {
        $models = Doorkeys::find()->where(['url'=>$id])->andWhere(['active' => 1])->One();
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
        $news = $query->offset($pagination->offset)->orderby(['date_create'=>SORT_DESC])->limit($pagination->limit)->all();
        $request = \Yii::$app->request;
        return $this->render('news/list.php', ['news'=>$news, 'active_page' => $request->get('page',1),'count_pages' => $pagination->getPageCount(), 'pagination' => $pagination,]);
    }
    
    /** Рендер детальной страницы новости **/
    public function actionNewsdetail($id) {
        $models = News::find()->where(['url'=>$id])->andWhere(['enabled' => 1])->One();
        if($models) {
            return $this->render('news/detail.php',['model' => $models]);
        } else {
            throw new HttpException(404 ,'Такая страница не существует');
        }
    }
    
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
