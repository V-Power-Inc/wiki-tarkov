<?php
/**
 * Created by PhpStorm.
 * User: PC_Principal
 * Date: 03.11.2022
 * Time: 7:52
 */

namespace app\controllers;

use app\common\constants\sql\SqlQueryCommands;
use app\common\exceptions\http\controllers\app\BossesControllerHttpException;
use app\common\interfaces\ResponseStatusInterface;
use app\common\controllers\AdvancedController;
use app\common\services\{ApiService, ArrayService};
use app\common\services\redis\RedisVariationsConfig;
use app\models\Bosses;
use yii\base\InvalidConfigException;
use yii\db\StaleObjectException;
use Yii;

/**
 * Контроллер обеспечивает работоспособность API по получению информации о боссах со стороннего источника tarkov.dev
 * Маршрутизация до страниц, получающих данные по API для боссов на локациях
 *
 * Class BossesController
 * @package app\controllers
 */
final class BossesController extends AdvancedController
{
    /** Константы для передачи в маршрутизатор /config/routes.php */
    public const ACTION_INDEX = 'boss-list';
    public const ACTION_VIEW  = 'view';

    /**
     * Массив поведения данного контроллера
     * Подключаем REDIS кеширование для страниц этого контроллера
     *
     * Кеш на 7 дней (Если дата создания записей изменится - кеш сбросится досрочно
     *
     * @return array|array[]
     * @throws InvalidConfigException
     */
    public function behaviors(): array
    {
        return [
            [
                'class' => 'yii\filters\PageCache',
                'duration' => Yii::$app->params['cacheTime']['seven_days'],
                'only' => [
                    self::ACTION_INDEX,
                    self::ACTION_VIEW
                ],
                'dependency' => [
                    'class' => 'yii\caching\DbDependency',
                    'sql' => SqlQueryCommands::MAX_BOSSES_DATE_CREATE,
                ],
                'variations' => RedisVariationsConfig::getMainControllerVariations()
            ],
        ];
    }

    /**
     * Метод выводит список карт и отображает все атрибуты о боссах, которые известны
     *
     * @throws StaleObjectException if [[optimisticLock|optimistic locking]] is enabled and the data
     * being deleted is outdated.
     * @throws \Throwable in case delete failed.
     * @return string
     */
    public function actionBossList(): string
    {
        /** Создаем объект класса ApiService */
        $api = new ApiService();

        /** Дергаем метод, который без параметров вернет нам список карт из Bosses */
        $maps = $api->getBosses();

        /** Рендерим вьюху */
        return $this->render(self::ACTION_INDEX, ['maps' => $maps]);
    }

    /**
     * Метод рендерит конкретную карту и выводит всю доступную информацию о боссах
     *
     * @param string $url - URL адрес до детальной странице с боссами на конкретной карте
     * @throws StaleObjectException if [[optimisticLock|optimistic locking]] is enabled and the data
     * being deleted is outdated.
     * @throws \Throwable in case delete failed.
     * @throws BossesControllerHttpException
     * @return mixed
     */
    public function actionView(string $url)
    {
        /** Создаем объект класса ApiService */
        $api = new ApiService();

        /** Проверяем есть ли в БД страница с таким URL адресом */
        if ($url && Bosses::isExists($url)) {

            /** Дергаем метод, который вернет нам детальную страницу Боссов */
            $bosses = $api->getBosses($url);

            /** Рендерим вьюху */
            return $this->render(self::ACTION_VIEW, [
                'bosses' => $bosses,
                'map_title' => Bosses::findMapTitleByUrl($url)
            ]);
        }

        /** Проверяем в статичном массиве, был ли такой Url адрес раньше */
        if (in_array($url, ArrayService::existingMapNames())) {

            /** Дергаем метод по обновлению боссов */
            $api->getBosses($url);

            /** Рефрешим страницу, после загрузки боссов */
            return $this->refresh();
        }

        /** Exception на всякий случай */
        throw new BossesControllerHttpException(ResponseStatusInterface::NOT_FOUND_CODE, 'Такая страница не существует');
    }
}