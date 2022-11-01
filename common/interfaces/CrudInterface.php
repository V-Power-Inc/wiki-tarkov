<?php
/**
 * Created by PhpStorm.
 * User: basil
 * Date: 06.08.2022
 * Time: 18:15
 */

namespace app\common\interfaces;

use yii\web\NotFoundHttpException;

/**
 * Интерфейс описывающий какие методы должны быть обязательно реализованы в проекте для CRUD функционала
 *
 * Interface CrudInterface
 * @package app\common\interfaces
 */
interface CrudInterface
{
    /**
     * Описание метода указывающего разрешения (Наследуется от Yii)
     * @return array
     */
    public function behaviors(): array;

    /** Описание индексной странички со списком объектов
     *  Должен возвращать ActiveDataProvider для адекватной работы
     *  с объектами в виде удобных таблиц с фильтрацией
     *  @return string
     */
    public function actionIndex(): string;

    /** Описание метода возвращающего конкретный объект по параметру
     * @param $id - id параметр
     * @return string
     * @throws NotFoundHttpException if the model cannot be found
     */
    public function actionView($id): string;

    /** Описание метода для создания нового объекта
     * @return mixed
     */
    public function actionCreate();

    /**
     * Описание метода для обновления объектов по параметру
     * @param int $id - id параметр
     * @return mixed
     * @throws NotFoundHttpException if the model cannot be found
     */
    public function actionUpdate(int $id);

    /**
     * Описание метода, удаляющего объекты по параметру
     * @param int $id - id параметр
     * @return mixed
     * @throws
     */
    public function actionDelete(int $id);
}