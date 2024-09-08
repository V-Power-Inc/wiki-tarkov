<?php

namespace app\modules\admin\controllers;

use app\common\controllers\AdminController;
use app\common\interfaces\CrudInterface;
use app\models\{FeedbackMessages, FeedbackMessagesSearch};
use yii\base\InvalidConfigException;
use yii\web\NotFoundHttpException;
use yii\filters\VerbFilter;
use Yii;

/**
 * Контроллер для маршрутизации формы обратной связи в админке
 *
 * Class FeedbackmessagesController
 * @package app\modules\admin\controllers
 */
final class FeedbackmessagesController extends AdminController implements CrudInterface
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
     * Lists all FeedbackMessages models.
     * @return mixed
     * @throws InvalidConfigException
     */
    public function actionIndex(): string
    {
        $searchModel = new FeedbackMessagesSearch();
        $dataProvider = $searchModel->search(Yii::$app->request->queryParams);

        return $this->render(self::ACTION_INDEX, [
            'searchModel' => $searchModel,
            'dataProvider' => $dataProvider,
        ]);
    }

    /**
     * Displays a single FeedbackMessages model.
     * @param integer $id
     * @return mixed
     * @throws NotFoundHttpException if the model cannot be found
     */
    public function actionView($id): string
    {
        return $this->render(self::ACTION_VIEW, [
            'model' => $this->findModel($id),
        ]);
    }

    /** Создание через CRUD в этом кейсе не нужно */
    public function actionCreate()
    {}

    /** Апдейт через CRUD в этом кейсе не нужно */
    public function actionUpdate(int $id)
    {}

    /** Удаление через CRUD в этом кейсе не нужно */
    public function actionDelete(int $id)
    {}

    /**
     * Finds the FeedbackMessages model based on its primary key value.
     * If the model is not found, a 404 HTTP exception will be thrown.
     * @param integer $id
     * @return FeedbackMessages the loaded model
     * @throws NotFoundHttpException if the model cannot be found
     */
    protected function findModel(int $id)
    {
        if (($model = FeedbackMessages::findOne($id)) !== null) {
            return $model;
        }

        throw new NotFoundHttpException('The requested page does not exist.');
    }
}