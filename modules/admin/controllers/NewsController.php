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
     * Lists all News models.
     * @return string
     */
    public function actionIndex(): string
    {
        $searchModel = new NewsSearch();
        $dataProvider = $searchModel->search(Yii::$app->request->queryParams);

        return $this->render(static::ACTION_INDEX, [
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
        return $this->render(static::ACTION_VIEW, [
            'model' => $this->findModel($id),
        ]);
    }

    /**
     * При сохранении нового объекта новости, должен происходить
     * Push в Discord канал waki-tarkov через веб-хук дискорда
     *
     * UDP 25_12_2023г. - Функционал пуша в дискорд отключен (Смотреть историю коммитов)
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

            /** Отправка уведомления в дискорд канал (Если боевой сервак) - Сейчас отключено за ненадобностью
             * Подробнее об интеграции в этом файле: /components/ClientdiscordComponent.php
             */
//            if($_SERVER['SERVER_NAME'] !== 'dev' . $_ENV['DOMAIN']) {
//                $webhook = new ClientdiscordComponent(Yii::$app->params['discordHookNewsUrl']);
//                $embed = new Embeddiscord();
//                $embed->image('https://'.$_SERVER['SERVER_NAME'].$model->preview);
//                $embed->description($model->shortdesc."\r\n".'Подробнее: https://'.$_SERVER['SERVER_NAME'].'/news/'.$model->url);
//                $embed->url('https://'.$_SERVER['SERVER_NAME'].'/news/'.$model->url);
//                $webhook->username('Новости Таркова')->message($model->title)->embed($embed)->send();
//            }

            /** Редирект на страницу детального просмотра новости */
            return $this->redirect([static::ACTION_VIEW, static::PARAM_ID => $model->id]);

        } else { /** В ином случае */

            /** Рендер вьюхи создания новости */
            return $this->render(static::ACTION_CREATE, [
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
            return $this->redirect([static::ACTION_VIEW, static::PARAM_ID => $model->id]);
        } else {
            return $this->render( static::ACTION_UPDATE, [
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
        return $this->redirect([static::ACTION_INDEX]);
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
