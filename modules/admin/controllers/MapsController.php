<?php

namespace app\modules\admin\controllers;

use Yii;
use app\models\{Maps, MapsSearch};
use app\common\controllers\AdminController;
use app\common\interfaces\CrudInterface;
use yii\web\NotFoundHttpException;
use yii\filters\VerbFilter;

/**
 * Контроллер CRUD для администрирования маркеров на интерактивных картах локации Завод
 *
 * Class MapsController
 * @package app\modules\admin\controllers
 */
final class MapsController extends AdminController implements CrudInterface
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
     * Экшен индексной страницы с маркерами интерактивных карт локаций
     *
     * @return string
     */
    public function actionIndex(): string
    {
        /** Создаем объект поисковой модели маркеров */
        $searchModel = new MapsSearch();

        /** Создаем датапровайдер на основе GET параметров */
        $dataProvider = $searchModel->search(Yii::$app->request->queryParams);

        /** Рендерим вьюху */
        return $this->render(self::ACTION_INDEX, [
            'searchModel' => $searchModel,
            'dataProvider' => $dataProvider,
        ]);
    }

    /**
     * Экшен страницы детального просмотра данных о маркерах
     *
     * @param $id - ID записи в БД
     *
     * @return string
     */
    public function actionView($id): string
    {
        /** Рендерим вьюху с детальной информацией по маркеру */
        return $this->render(self::ACTION_VIEW, [
            'model' => $this->findModel($id),
        ]);
    }

    /**
     * Экшен создания нового маркера на интерактивных картах локаций
     *
     * @return mixed|string|\yii\web\Response
     */
    public function actionCreate()
    {
        /** Создаем новый AR объект маркера */
        $model = new Maps();

        /** Загружаем изображение, если есть */
        $model->uploadPreview();

        /** Если смогли загрузить данные из POST'a в модель и сохранить */
        if ($model->load(Yii::$app->request->post()) && $model->save()) {

            /** Редирект на страницу детального просмотра данных о маркере */
            return $this->redirect([self::ACTION_VIEW, self::PARAM_ID => $model->id]);

        } else { /** В ином случае */

            /** Рендер вьюхи создания маркера */
            return $this->render(self::ACTION_CREATE, [
                'model' => $model,
            ]);
        }
    }

    /**
     * Экшен обновления данных по маркеру
     *
     * @param int $id - ID записи из БД
     *
     * @return mixed|string|\yii\web\Response
     */
    public function actionUpdate($id)
    {
        /** Ищем AR объект по ID из БД */
        $model = $this->findModel($id);

        /** Грузим изображение, если есть */
        $model->uploadPreview();

        /** Если удалось загрузить данные в модель и сохранить их */
        if ($model->load(Yii::$app->request->post()) && $model->save()) {

            /** Редиректим пользователя на страницу детального просмотра данных по маркеру */
            return $this->redirect([self::ACTION_VIEW, self::PARAM_ID => $model->id]);

        } else { /** В ином случае */

            /** Рендерим вьюху редактирования */
            return $this->render(self::ACTION_UPDATE, [
                'model' => $model,
            ]);
        }
    }

    /**
     * Метод удаления записи маркера из БД
     *
     * @param int $id - ID записи из БД
     *
     * @return mixed|\yii\web\Response
     * @throws \Throwable
     * @throws \yii\db\StaleObjectException
     */
    public function actionDelete(int $id)
    {
        $this->findModel($id)->delete();
        return $this->redirect([self::ACTION_INDEX]);
    }

    /**
     * Метод с помощью параметра ID ищет AR модель в БД и возращает ее, либо NotFound
     *
     * @param int $id - ID записи из БД
     *
     * @return Maps|null
     */
    protected function findModel(int $id)
    {
        /** Если смогли найти AR объект маркера */
        if (($model = Maps::findOne($id)) !== null) {

            /** Возвращаем AR объект */
            return $model;

        } else { /** В ином случае */

            /** Выкидываем 404 ошибку */
            throw new NotFoundHttpException('The requested page does not exist.');
        }
    }
}