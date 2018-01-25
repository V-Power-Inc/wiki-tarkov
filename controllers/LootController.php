<?php
/**
 * Created by PhpStorm.
 * User: comp
 * Date: 25.01.2018
 * Time: 19:17
 */
/** Этот контроллер отвечает за вывод категорий и лута предметов из Escape from Tarkov  **/
namespace app\controllers;


use yii\web\Controller;


class LootController extends Controller
{
    /**
     * Displays homepage.
     *
     * @return string
     */

    /** Рендер страницы списка категорий и общего списка лута  **/
    public function actionMainloot()
    {
        return $this->render('mainpage.php');
    }
}