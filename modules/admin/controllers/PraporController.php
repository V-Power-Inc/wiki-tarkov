<?php

namespace app\modules\admin\controllers;

use Yii;
use app\models\Prapor;
use app\models\PraporSearch;
use yii\web\Controller;
use yii\web\NotFoundHttpException;
use yii\filters\VerbFilter;
use yii\web\UploadedFile;
use yii\imagine\Image;
use Imagine\Gd;
use Imagine\Image\Box;

/**
 * PraporController implements the CRUD actions for Prapor model.
 */
class PraporController extends Controller
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
     * Lists all Prapor models.
     * @return mixed
     */
    public function actionIndex()
    {
        $searchModel = new PraporSearch();
        $dataProvider = $searchModel->search(Yii::$app->request->queryParams);

        return $this->render('index', [
            'searchModel' => $searchModel,
            'dataProvider' => $dataProvider,
        ]);
    }

    /**
     * Displays a single Prapor model.
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
     * Creates a new Prapor model.
     * If creation is successful, the browser will be redirected to the 'view' page.
     * @return mixed
     */
    public function actionCreate()
    {
        $model = new Prapor();
        $fileImg = UploadedFile::getInstance($model, 'file');
        if ($model->load(\Yii::$app->request->post())) {
            if ($fileImg !== null) {
                $catalog = 'img/admin/' . $fileImg->baseName . '.' . $fileImg->extension;
                // Путь до отресайзенной картинки **/
                $middle = 'img/admin/' . $fileImg->baseName . '_min.' . $fileImg->extension;
                $fileImg->saveAs($catalog);
                $model->preview = '/' . $catalog;
                Image::getImagine()->open($catalog)->thumbnail(new Box(300, 150))->save($middle, ['quality' => 90]);
                if (!$model->save()) {
                    echo "<pre>";
                    print_r($model->getErrors());
                    echo "</pre>";
                    exit();
                } else {
                    return $this->redirect(['view', 'id' => $model->id]);
                }
            }
        } else {
            return $this->render('create', [
                'model' => $model,
            ]);
        }
    }

    /**
     * Updates an existing Prapor model.
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
     * Deletes an existing Prapor model.
     * If deletion is successful, the browser will be redirected to the 'index' page.
     * @param integer $id
     * @return mixed
     */
    public function actionDelete($id)
    {
        $this->findModel($id)->delete();

        return $this->redirect(['index']);
    }

    /**
     * Finds the Prapor model based on its primary key value.
     * If the model is not found, a 404 HTTP exception will be thrown.
     * @param integer $id
     * @return Prapor the loaded model
     * @throws NotFoundHttpException if the model cannot be found
     */
    protected function findModel($id)
    {
        if (($model = Prapor::findOne($id)) !== null) {
            return $model;
        } else {
            throw new NotFoundHttpException('The requested page does not exist.');
        }
    }
}
