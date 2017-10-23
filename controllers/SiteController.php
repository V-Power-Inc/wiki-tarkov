<?php

namespace app\controllers;

use Yii;
use yii\filters\AccessControl;
use yii\web\Controller;
use yii\web\Response;
use yii\filters\VerbFilter;
use app\models\LoginForm;
use app\models\ContactForm;

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
        return $this->render('quests/prapor-quests.php');
    }

    /** Рендер страницы квестов Терапевта **/
    public function actionTerapevtpage() {
        return $this->render('quests/terapevt-quests.php');
    }

    /** Рендер страницы квестов Скупщика **/
    public function actionSkypchikpage() {
        return $this->render('quests/skyp-quests.php');
    }

    /** Рендер страницы квестов Лыжника **/
    public function actionLyjnicpage() {
        return $this->render('quests/lyjnic-quests.php');
    }

    /** Рендер страницы квестов Миротворца **/
    public function actionMirotvorecpage() {
        return $this->render('quests/mirotvorec-quests.php');
    }

}
