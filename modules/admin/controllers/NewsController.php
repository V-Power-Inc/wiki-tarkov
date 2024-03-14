<?php

namespace app\modules\admin\controllers;

use Yii;
use app\models\News;
use app\models\NewsSearch;
use yii\web\NotFoundHttpException;
use yii\filters\VerbFilter;
use app\common\interfaces\CrudInterface;
use app\common\controllers\AdminController;

/**
 * NewsController implements the CRUD actions for News model.
 */
final class NewsController extends AdminController implements CrudInterface
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
     * Lists all News models.
     * @return string
     */
    public function actionIndex(): string
    {
        $searchModel = new NewsSearch();
        $dataProvider = $searchModel->search(Yii::$app->request->queryParams);

        return $this->render(self::ACTION_INDEX, [
            'searchModel' => $searchModel,
            'dataProvider' => $dataProvider,
        ]);
    }

    /**
     * Displays a single News model.
     * @param integer $id
     * @return string
     * @throws NotFoundHttpException if the model cannot be found
     */
    public function actionView($id): string
    {
        return $this->render(self::ACTION_VIEW, [
            'model' => $this->findModel($id),
        ]);
    }

    /**
     * Метод для сохранения нового AR объекта новости
     *
     * UDP 25_12_2023г. - Функционал пуша в дискорд отключен (Смотреть историю коммитов)
     * UPD 04_03_2024г. - Функционал полностью убран из проекта (Смотреть историю коммитов)
     *
     * @return mixed
     * @throws
     */
    public function actionCreate()
    {
        /** Создаем AR Объект новости */
        $model = new News();

        /** Грузим превью */
        $model->uploadPreview();

        /** Если данные в модель из POST'a прогрузились и сохранились */
        if ($model->load(Yii::$app->request->post()) && $model->save()) {

            /** Редирект на страницу детального просмотра новости */
            return $this->redirect([self::ACTION_VIEW, self::PARAM_ID => $model->id]);

        } else { /** В ином случае */

            /** Рендер вьюхи создания новости */
            return $this->render(self::ACTION_CREATE, [
                'model' => $model,
            ]);
        }
    }

    /**
     * Updates an existing News model.
     * If update is successful, the browser will be redirected to the 'view' page.
     * @param int $id - id параметр
     * @return mixed
     * @throws NotFoundHttpException if the model cannot be found
     */
    public function actionUpdate(int $id)
    {
        $model = $this->findModel($id);
        $model->uploadPreview();

        if ($model->load(Yii::$app->request->post()) && $model->save()) {
            return $this->redirect([self::ACTION_VIEW, self::PARAM_ID => $model->id]);
        } else {
            return $this->render( self::ACTION_UPDATE, [
                'model' => $model,
            ]);
        }
    }

    /**
     * Deletes an existing News model.
     * If deletion is successful, the browser will be redirected to the 'index' page.
     * @param int $id - id параметр
     * @return mixed
     * @throws
     */
    public function actionDelete(int $id)
    {
        $this->findModel($id)->delete();
        return $this->redirect([self::ACTION_INDEX]);
    }

    /**
     * Finds the News model based on its primary key value.
     * If the model is not found, a 404 HTTP exception will be thrown.
     * @param int $id - id параметр
     * @return News the loaded model
     * @throws NotFoundHttpException if the model cannot be found
     */
    protected function findModel(int $id)
    {
        if (($model = News::findOne($id)) !== null) {
            return $model;
        } else {
            throw new NotFoundHttpException('The requested page does not exist.');
        }
    }
}
