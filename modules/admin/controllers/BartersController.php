<?php

namespace app\modules\admin\controllers;

use Yii;
use app\models\Barters;
use app\models\BartersSearch;
use yii\web\NotFoundHttpException;
use yii\filters\VerbFilter;
use app\common\interfaces\CrudInterface;
use app\common\controllers\AdminController;

/**
 * BartersController implements the CRUD actions for Barters model.
 */
final class BartersController extends AdminController implements CrudInterface
{
    /** @var string - Константы для обращения к методам */
    const ACTION_INDEX  = 'index';
    const ACTION_VIEW   = 'view';
    const ACTION_CREATE = 'create';
    const ACTION_UPDATE = 'update';
    const ACTION_DELETE = 'delete';

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
     * Lists all Barters models.
     * @return string
     */
    public function actionIndex(): string
    {
        $searchModel = new BartersSearch();
        $dataProvider = $searchModel->search(Yii::$app->request->queryParams);

        return $this->render(static::ACTION_INDEX, [
            'searchModel' => $searchModel,
            'dataProvider' => $dataProvider,
        ]);
    }

    /**
     * Displays a single Barters model.
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
     * Creates a new Barters model.
     * If creation is successful, the browser will be redirected to the 'view' page.
     * @return mixed
     */
    public function actionCreate()
    {
        $model = new Barters();

        if ($model->load(Yii::$app->request->post()) && $model->save()) {
            return $this->redirect([static::ACTION_VIEW, static::PARAM_ID => $model->id]);
        }

        return $this->render(static::ACTION_CREATE, [
            'model' => $model,
        ]);
    }

    /**
     * Updates an existing Barters model.
     * If update is successful, the browser will be redirected to the 'view' page.
     * @param int $id - id параметр
     * @return mixed
     * @throws NotFoundHttpException if the model cannot be found
     */
    public function actionUpdate(int $id)
    {
        $model = $this->findModel($id);

        if ($model->load(Yii::$app->request->post()) && $model->save()) {
            return $this->redirect([static::ACTION_VIEW, static::PARAM_ID => $model->id]);
        }

        return $this->render(static::ACTION_UPDATE, [
            'model' => $model,
        ]);
    }

    /**
     * Deletes an existing Barters model.
     * If deletion is successful, the browser will be redirected to the 'index' page.
     * @param int $id - id параметр
     * @return mixed
     * @throws
     */
    public function actionDelete(int $id)
    {
        $this->findModel($id)->delete();
        return $this->redirect(['index']);
    }

    /**
     * Finds the Barters model based on its primary key value.
     * If the model is not found, a 404 HTTP exception will be thrown.
     * @param int $id - id параметр
     * @return Barters the loaded model
     * @throws NotFoundHttpException if the model cannot be found
     */
    protected function findModel(int $id)
    {
        if (($model = Barters::findOne($id)) !== null) {
            return $model;
        }

        throw new NotFoundHttpException('The requested page does not exist.');
    }
}
