<?php

namespace app\controllers;

use app\models\Lyjnic;
use app\models\Terapevt;
use app\models\Prapor;
use Yii;
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
        $prapor = $query->orderby(['date_edit'=>SORT_ASC])->all();
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
        // Пока нет квестов - редирект
        $this->goHome();
      //  return $this->render('quests/mirotvorec-quests.php');
    }

}
