<?php

namespace app\modules\admin\controllers;

use Yii;
use app\models\News;
use app\models\NewsSearch;
use yii\web\NotFoundHttpException;
use yii\filters\VerbFilter;
use app\components\ClientdiscordComponent;
use app\components\Embeddiscord;
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

        return $this->render('index', [
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
        return $this->render('view', [
            'model' => $this->findModel($id),
        ]);
    }

    /**
     * При сохранении нового объекта новости, должен происходить
     * Push в Discord канал waki-tarkov через веб-хук дискорда
     *
     * @return mixed
     * @throws
     */
    public function actionCreate()
    {
        $model = new News();
        $model->uploadPreview();

        if ($model->load(Yii::$app->request->post()) && $model->save()) {

            /** Отправка уведомления в дискорд канал */
            if($_SERVER['SERVER_NAME'] !== 'dev.kfc-it.ru') {
                $webhook = new ClientdiscordComponent(Yii::$app->params['discordHookNewsUrl']);
                $embed = new Embeddiscord();
                $embed->image('https://'.$_SERVER['SERVER_NAME'].$model->preview);
                $embed->description($model->shortdesc."\r\n".'Подробнее: https://'.$_SERVER['SERVER_NAME'].'/news/'.$model->url);
                $embed->url('https://'.$_SERVER['SERVER_NAME'].'/news/'.$model->url);
                $webhook->username('Новости Таркова')->message($model->title)->embed($embed)->send();
            }
            return $this->redirect(['view', 'id' => $model->id]);
        } else {
            return $this->render('create', [
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
            return $this->redirect(['view', 'id' => $model->id]);
        } else {
            return $this->render('update', [
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
        return $this->redirect(['index']);
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
