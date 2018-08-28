<?php

namespace app\modules\admin\controllers;

use Yii;
use app\models\Zavod;
use app\models\ZavodSearch;
use yii\web\Controller;
use yii\web\NotFoundHttpException;
use yii\filters\VerbFilter;

/**
 * ZavodController implements the CRUD actions for Zavod model.
 */
class ZavodController extends Controller
{

    /** Подключаем отдельный layout для CRUD моделей **/
    public $layout = 'admin';

    /** Проверка пользователя на гостя  **/
    public function beforeAction($action)
    {
        // Проверяем в том числе - если пользователь является вакантным участником, то редиректим его в админку
        if (Yii::$app->user->isGuest && Yii::$app->request->url !== '/admin/login') {
            return $this->redirect('/admin/login');
        } elseif(Yii::$app->user->identity->id === 5) {
            return $this->redirect('/admin');
        } else {
            return self::actionIndex();
        }
    }
    
    /**
     * @inheritdoc
     */
    public function behaviors()
    {
        return [
            'verbs' => [
                'class' => VerbFilter::className(),
                'actions' => [
                    'delete' => ['POST'],
                ],
            ],
        ];
    }

    /**
     * Lists all Zavod models.
     * @return mixed
     */
    public function actionIndex()
    {
        $searchModel = new ZavodSearch();
        $dataProvider = $searchModel->search(Yii::$app->request->queryParams);

        return $this->render('index', [
            'searchModel' => $searchModel,
            'dataProvider' => $dataProvider,
        ]);
    }

    /**
     * Displays a single Zavod model.
     * @param integer $id
     * @return mixed
     */
    public function actionView($id)
    {
        return $this->render('view', [
            'model' => $this->findModel($id),
        ]);
    }

    /**
     * Creates a new Zavod model.
     * If creation is successful, the browser will be redirected to the 'view' page.
     * @return mixed
     */
    public function actionCreate()
    {
        $model = new Zavod();
        $model->uploadPreview();
        
        if ($model->load(Yii::$app->request->post()) && $model->save()) {
            return $this->redirect(['view', 'id' => $model->id]);
        } else {
            return $this->render('create', [
                'model' => $model,
            ]);
        }
    }

    /**
     * Updates an existing Zavod model.
     * If update is successful, the browser will be redirected to the 'view' page.
     * @param integer $id
     * @return mixed
     */
    public function actionUpdate($id)
    {
        $model = $this->findModel($id);
        $model->uploadPreview();

        if ($model->load(Yii::$app->request->post())) {
            json_encode($model);
            $model->save();
            return $this->redirect(['view', 'id' => $model->id]);
        } else {
            json_decode(json_encode($model), true);
            return $this->render('update', [
                'model' => $model,
            ]);
        }
    }

    /**
     * Deletes an existing Zavod model.
     * If deletion is successful, the browser will be redirected to the 'index' page.
     * @param integer $id
     * @return mixed
     */
    public function actionDelete($id)
    {
        if(Yii::$app->user->identity->id !== 3) {

            $this->findModel($id)->delete();

            return $this->redirect(['index']);
        }
    }

    /**
     * Finds the Zavod model based on its primary key value.
     * If the model is not found, a 404 HTTP exception will be thrown.
     * @param integer $id
     * @return Zavod the loaded model
     * @throws NotFoundHttpException if the model cannot be found
     */
    protected function findModel($id)
    {
        if (($model = Zavod::findOne($id)) !== null) {
            return $model;
        } else {
            throw new NotFoundHttpException('The requested page does not exist.');
        }
    }
}
