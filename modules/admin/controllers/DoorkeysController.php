<?php

namespace app\modules\admin\controllers;

use Yii;
use app\models\{Doorkeys, DoorkeysSearch};
use yii\web\NotFoundHttpException;
use yii\filters\VerbFilter;
use app\common\interfaces\CrudInterface;
use app\common\controllers\AdminController;

/**
 * DoorkeysController implements the CRUD actions for Doorkeys model.
 */
final class DoorkeysController extends AdminController implements CrudInterface
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
     * Lists all Doorkeys models.
     * @return string
     */
    public function actionIndex(): string
    {
        $searchModel = new DoorkeysSearch();
        $dataProvider = $searchModel->search(Yii::$app->request->queryParams);

        return $this->render(self::ACTION_INDEX, [
            'searchModel' => $searchModel,
            'dataProvider' => $dataProvider,
        ]);
    }

    /**
     * Displays a single Doorkeys model.
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
     * Creates a new Doorkeys model.
     * If creation is successful, the browser will be redirected to the 'view' page.
     * @return mixed
     */
    public function actionCreate()
    {
        $model = new Doorkeys();
        $model->uploadPreview();
        
        if ($model->load(Yii::$app->request->post()) && $model->save()) {
            return $this->redirect([self::ACTION_VIEW, self::PARAM_ID => $model->id]);
        } else {
            return $this->render(self::ACTION_CREATE, [
                'model' => $model,
            ]);
        }
    }

    /**
     * Updates an existing Doorkeys model.
     * If update is successful, the browser will be redirected to the 'view' page.
     * @param int $id - id параметр
     * @return mixed
     * @throws NotFoundHttpException if the model cannot be found
     */
    public function actionUpdate(int $id)
    {
        $model = $this->findModel($id);
        $model->uploadPreview();
        
        /** Преобразуем строку с группой карт в массив */
        $nn=preg_split('/\s*,\s*/',trim($model->mapgroup),-1,PREG_SPLIT_NO_EMPTY);
        $mapgroup=array();
        foreach ($nn as $pr) {
            $mapgroup[]=$pr;
        }
        $model->mapgroup=$mapgroup;

        if ($model->load(Yii::$app->request->post()) && $model->save()) {
            return $this->redirect([self::ACTION_VIEW, self::PARAM_ID => $model->id]);
        } else {
            return $this->render(self::ACTION_UPDATE, [
                'model' => $model,
            ]);
        }
    }

    /**
     * Deletes an existing Doorkeys model.
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
     * Finds the Doorkeys model based on its primary key value.
     * If the model is not found, a 404 HTTP exception will be thrown.
     * @param int $id - id параметр
     * @return Doorkeys the loaded model
     * @throws NotFoundHttpException if the model cannot be found
     */
    protected function findModel(int $id)
    {
        if (($model = Doorkeys::findOne($id)) !== null) {
            return $model;
        } else {
            throw new NotFoundHttpException('The requested page does not exist.');
        }
    }
}