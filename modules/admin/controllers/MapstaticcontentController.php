<?php

namespace app\modules\admin\controllers;

use Yii;
use app\models\Mapstaticcontent;
use app\models\MapstaticcontentSearch;
use yii\web\Controller;
use yii\web\NotFoundHttpException;
use yii\filters\VerbFilter;

/**
 * MapstaticcontentController implements the CRUD actions for Mapstaticcontent model.
 */
class MapstaticcontentController extends Controller
{

    /** Подключаем отдельный layout для CRUD моделей **/
    public $layout = 'admin';

    /** Проверка пользователя на гостя  **/
    public function beforeAction($action)
    {
        if (Yii::$app->user->isGuest && Yii::$app->request->url !== '/admin/login') {
            return $this->redirect('/admin/login');
        } else {
            return self::actionIndex();
        }
    }
    
    public function behaviors()
    {
        return [
            'verbs' => [
                'class' => VerbFilter::className(),
                'actions' => [
                ],
            ],
        ];
        
        
    }

    
    /**
     * Lists all Mapstaticcontent models.
     * @return mixed
     */
    public function actionIndex()
    {
        $searchModel = new MapstaticcontentSearch();
        $dataProvider = $searchModel->search(Yii::$app->request->queryParams);

        return $this->render('index', [
            'searchModel' => $searchModel,
            'dataProvider' => $dataProvider,
        ]);
    }

    /**
     * Displays a single Mapstaticcontent model.
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
     * Creates a new Mapstaticcontent model.
     * If creation is successful, the browser will be redirected to the 'view' page.
     * @return mixed
     */
    public function actionCreate()
    {
        $model = new Mapstaticcontent();

        if ($model->load(Yii::$app->request->post()) && $model->save()) {
            return $this->redirect(['view', 'id' => $model->id]);
        } else {
            return $this->render('create', [
                'model' => $model,
            ]);
        }
    }

    /**
     * Updates an existing Mapstaticcontent model.
     * If update is successful, the browser will be redirected to the 'view' page.
     * @param integer $id
     * @return mixed
     */
    public function actionUpdate($id)
    {
        $model = $this->findModel($id);

        if ($model->load(Yii::$app->request->post()) && $model->save()) {
            return $this->redirect(['view', 'id' => $model->id]);
        } else {
            return $this->render('update', [
                'model' => $model,
            ]);
        }
    }

    /**
     * Finds the Mapstaticcontent model based on its primary key value.
     * If the model is not found, a 404 HTTP exception will be thrown.
     * @param integer $id
     * @return Mapstaticcontent the loaded model
     * @throws NotFoundHttpException if the model cannot be found
     */
    protected function findModel($id)
    {
        if (($model = Mapstaticcontent::findOne($id)) !== null) {
            return $model;
        } else {
            throw new NotFoundHttpException('The requested page does not exist.');
        }
    }
}
