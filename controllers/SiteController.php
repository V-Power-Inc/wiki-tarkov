<?php

namespace app\controllers;

use app\models\Lyjnic;
use app\models\Terapevt;
use app\models\Prapor;
use app\models\Mirotvorec;
use app\models\Zavod;
use app\models\Forest;
use app\models\Mapstaticcontent;
use Yii;
use yii\helpers\Json;
use yii\web\Controller;


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

    /** Рендер страницы со списком интерактивных карт **/
    public function actionLocations() {
          return $this->render('maps/maps.php');
    }

    /** Прилетают данные о статичном контенте описаний маркеров **/
    public function actionStatic() {
        $staticcontent = Mapstaticcontent::find()->asArray()->all();
        return Json::encode($staticcontent);
    }

    /** JSON данные с координатами маркеров Завода */
    public function actionZavodmarkers() {
        $markers = Zavod::find()->asArray()->andWhere(['enabled' => 1])->all();
        return Json::encode($markers);
    }

    /** JSON данные с координатами маркеров Завода */
    public function actionForestmarkers() {
        $markers = Forest::find()->asArray()->andWhere(['enabled' => 1])->all();
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
    public function actionKeys() {
        return $this->render('keys/index.php');
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
