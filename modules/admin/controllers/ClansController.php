<?php

namespace app\modules\admin\controllers;

use Yii;
use app\models\Clans;
use app\models\ClansSearch;
use yii\web\NotFoundHttpException;
use yii\filters\VerbFilter;
use app\common\interfaces\CrudInterface;
use app\common\controllers\AdminController;

/**
 * ClansController implements the CRUD actions for Clans model.
 */
final class ClansController extends AdminController implements CrudInterface
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
     * Lists all Clans models.
     * @return string
     */
    public function actionIndex(): string
    {
        $searchModel = new ClansSearch();
        $dataProvider = $searchModel->search(Yii::$app->request->queryParams);

        return $this->render(static::ACTION_INDEX, [
            'searchModel' => $searchModel,
            'dataProvider' => $dataProvider,
        ]);
    }

    /**
     * Displays a single Clans model.
     * @param integer $id
     * @return mixed
     * @throws NotFoundHttpException if the model cannot be found
     */
    public function actionView($id): string
    {
        return $this->render(static::ACTION_VIEW, [
            'model' => $this->findModel($id),
        ]);
    }

    /**
     * Creates a new Clans model.
     * If creation is successful, the browser will be redirected to the 'view' page.
     * @return mixed
     */
    public function actionCreate()
    {
        $model = new Clans();

        if ($model->load(Yii::$app->request->post()) && $model->save()) {
            return $this->redirect([static::ACTION_VIEW, static::PARAM_ID => $model->id]);
        }

        return $this->render(static::ACTION_CREATE, [
            'model' => $model,
        ]);
    }

    /**
     * Updates an existing Clans model.
     * If update is successful, the browser will be redirected to the 'view' page.
     * @param int $id - id параметр
     * @return mixed
     * @throws NotFoundHttpException if the model cannot be found
     */
    public function actionUpdate(int $id)
    {
        $model = $this->findModel($id);
        $model->uploadPreview();

        if ($model->load(Yii::$app->request->post()) && $model->save(false)) {
            return $this->redirect([static::ACTION_VIEW, static::PARAM_ID => $model->id]);
        }

        return $this->render(static::ACTION_UPDATE, [
            'model' => $model,
        ]);
    }

    /**
     * Deletes an existing Clans model.
     * If deletion is successful, the browser will be redirected to the 'index' page.
     * @param int $id - id параметр
     * @return mixed
     * @throws
     */
    public function actionDelete(int $id)
    {
        $this->findModel($id)->delete();
        return $this->redirect([static::ACTION_INDEX]);
    }

    /**
     * Finds the Clans model based on its primary key value.
     * If the model is not found, a 404 HTTP exception will be thrown.
     * @param int $id - id параметр
     * @return Clans the loaded model
     * @throws NotFoundHttpException if the model cannot be found
     */
    protected function findModel(int $id)
    {
        if (($model = Clans::findOne($id)) !== null) {
            return $model;
        }

        throw new NotFoundHttpException('The requested page does not exist.');
    }
}
