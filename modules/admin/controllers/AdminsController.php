<?php

namespace app\modules\admin\controllers;

use Yii;
use app\models\Admins;
use yii\data\ActiveDataProvider;
use yii\web\ForbiddenHttpException;
use yii\web\NotFoundHttpException;
use yii\filters\VerbFilter;
use app\common\interfaces\CrudInterface;
use app\common\controllers\AdminController;

/**
 * Управление администраторами сайта: список, создание, редактирование (в том числе смена пароля)
 * Удаление отключено - для отключения доступа используется бан
 *
 * Class AdminsController
 * @package app\modules\admin\controllers
 */
final class AdminsController extends AdminController implements CrudInterface
{
    /**
     * Описание метода указывающего разрешения (Наследуется от Yii)
     * @return array
     */
    public function behaviors(): array
    {
        return [
            'verbs' => [
                'class' => VerbFilter::class,
                'actions' => [
                    'delete' => ['POST'],
                ],
            ],
        ];
    }

    /**
     * Список администраторов
     * @return string
     */
    public function actionIndex(): string
    {
        $dataProvider = new ActiveDataProvider([
            'query' => Admins::find(),
            'sort' => ['defaultOrder' => [Admins::ATTR_ID => SORT_ASC]],
        ]);

        return $this->render(self::ACTION_INDEX, [
            'dataProvider' => $dataProvider,
        ]);
    }

    /**
     * Просмотр одного администратора
     * @param integer $id
     * @return string
     * @throws NotFoundHttpException if the model cannot be found
     */
    public function actionView($id): string
    {
        return $this->render(self::ACTION_VIEW, [
            'model' => $this->findModel((int) $id),
        ]);
    }

    /**
     * Создание нового администратора - пароль хешируется в модели при сохранении
     * @return mixed
     */
    public function actionCreate()
    {
        $model = new Admins(['scenario' => Admins::SCENARIO_CREATE]);

        if ($model->load(Yii::$app->request->post()) && $model->save()) {
            Yii::$app->session->setFlash('success', 'Администратор создан.');
            return $this->redirect([self::ACTION_VIEW, self::PARAM_ID => $model->id]);
        }

        /** Пароль в открытом виде обратно в форму не отдаем */
        $model->newPassword = null;

        return $this->render(self::ACTION_CREATE, [
            'model' => $model,
        ]);
    }

    /**
     * Редактирование администратора, пустой "Новый пароль" - пароль не меняется
     * @param int $id - id параметр
     * @return mixed
     * @throws NotFoundHttpException if the model cannot be found
     */
    public function actionUpdate(int $id)
    {
        $model = $this->findModel($id);
        $model->scenario = Admins::SCENARIO_UPDATE;

        if ($model->load(Yii::$app->request->post())) {

            if ($this->isSelfBan($model)) {

                /** Нельзя забанить самого себя - иначе можно случайно потерять доступ в админку */
                $model->addError(Admins::ATTR_BANNED, 'Нельзя забанить самого себя.');
            } elseif ($model->save()) {
                Yii::$app->session->setFlash('success', 'Изменения сохранены.');
                return $this->redirect([self::ACTION_VIEW, self::PARAM_ID => $model->id]);
            }
        }

        /** Пароль в открытом виде обратно в форму не отдаем */
        $model->newPassword = null;

        return $this->render(self::ACTION_UPDATE, [
            'model' => $model,
        ]);
    }

    /**
     * Удаление отключено - вместо удаления используйте бан (метод обязателен по CrudInterface)
     * @param int $id - id параметр
     * @return mixed
     * @throws ForbiddenHttpException
     */
    public function actionDelete(int $id)
    {
        throw new ForbiddenHttpException('Удаление администраторов отключено - используйте бан.');
    }

    /**
     * Пытается ли текущий пользователь забанить сам себя
     * @param Admins $model
     * @return bool
     */
    private function isSelfBan(Admins $model): bool
    {
        return (int) $model->id === (int) Yii::$app->user->id && !empty($model->banned);
    }

    /**
     * Поиск администратора по первичному ключу
     * @param int $id - id параметр
     * @return Admins
     * @throws NotFoundHttpException if the model cannot be found
     */
    protected function findModel(int $id): Admins
    {
        if (($model = Admins::findOne($id)) !== null) {
            return $model;
        }

        throw new NotFoundHttpException('The requested page does not exist.');
    }
}
