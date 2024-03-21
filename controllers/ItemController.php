<?php
/**
 * Created by PhpStorm.
 * User: comp
 * Date: 30.01.2018
 * Time: 21:17
 */

namespace app\controllers;
use app\common\controllers\AdvancedController;
use app\common\interfaces\ResponseStatusInterface;
use app\common\services\redis\RedisVariationsConfig;
use yii\web\HttpException;
use app\models\Items;
use Yii;

/**
 * Class ItemController
 * @package app\controllers
 */
final class ItemController extends AdvancedController
{
    /** Константы для передачи в маршрутизатор /config/routes.php */
    public const ACTION_DETAILLOOT = 'detailloot';
    public const ACTION_PREVIEWLOOT = 'previewloot';

    /** CSRF валидация POST запросов методов этого контроллера включена */
    public $enableCsrfValidation;

    /**
     * Кешируем все запросы из БД - храним их в кеше (Массив поведения контроллера)
     *
     * @return array|array[]
     */
    public function behaviors(): array
    {
        return [
            [
                'class' => 'yii\filters\PageCache',
                'duration' => Yii::$app->params['cacheTime']['seven_days'],
                'only' => [self::ACTION_DETAILLOOT],
                'dependency' => [
                    'class' => 'yii\caching\DbDependency',
                    'sql' => 'SELECT MAX(date_update) FROM items',
                ],
                'variations' => RedisVariationsConfig::getMainControllerVariations()
            ],
        ];
    }

    /**
     * Рендер детальной страницы лута
     *
     * @param $item - url адрес
     * @return string
     * @throws HttpException
     */
    public function actionDetailloot($item): string
    {
        /** Если смогли по урлу найти лут в БД */
        if (Items::takeActiveItemByUrl($item)) {

            /** Рендерим страницу с детальной информацией об этом луте */
            return $this->render('/loot/item-detail.php', ['item' => Items::takeActiveItemByUrl($item)]);
        }

        /** Выкидываем 404 - если не нашли такой лут в базе */
        throw new HttpException(ResponseStatusInterface::NOT_FOUND_CODE ,'Такая страница не существует');
    }

    /**
     * Рендер страницы предпросмотра детальной страницы лута
     *
     * @return string
     * @throws HttpException
     */
    public function actionPreviewloot(): string
    {
        /** Отключаем CSRF валидации, в этом кейсе она мешает */
        $this->enableCsrfValidation = false;

        /** Если пользователь авторизован */
        if(Yii::$app->user->isGuest !== true) {

            /** Создаем AR объект Items */
            $item = new Items();

            /** Грузим в него данные из POST для предпросмотра */
            $item->load(Yii::$app->request->post());

            /** Рендерим вьюху предпросмотра */
            return $this->render('/loot/item-preview.php', ['item' => $item]);
        }

        /** Если на эту страницу пытается попасть неавторизованный пользователь - выкидываем 404 ошибку */
        throw new HttpException(ResponseStatusInterface::NOT_FOUND_CODE ,'Такая страница не существует');
    }
}