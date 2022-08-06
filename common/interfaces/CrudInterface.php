<?php
/**
 * Created by PhpStorm.
 * User: basil
 * Date: 06.08.2022
 * Time: 18:15
 */

namespace app\common\interfaces;

use yii\data\ActiveDataProvider;

/** Интерфейс описывающий какие методы должны быть обязательно реализованы в проекте для CRUD */
interface CrudInterface
{
    /** Описание индексной странички со списком объектов
     *  Должен возвращать ActiveDataProvider для адекватной работы
     *  с объектами в виде удобных таблиц с фильтрацией
     *  @return ActiveDataProvider
     */
    public function actionIndex(): ActiveDataProvider;

    /** Описание метода возвращающего конкретный объект по параметру
     * @param string $id - id параметр
     * @return string
     */
    public function actionView($id);

    /** Описание метода для создания нового объекта
     *  @return mixed
     */
    public function actionCreate();

    /**
     * Описание метода для обновления объектов по параметру
     * @param string $id - id параметр
     * @return mixed
     */
    public function actionUpdate($id);

    /**
     * Описание метода, удаляющего объекты по параметру
     * @param string $id - id параметр
     * @return mixed
     */
    public function actionDelete($id);

}