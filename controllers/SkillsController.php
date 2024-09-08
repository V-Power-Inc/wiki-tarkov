<?php
/**
 * Created by PhpStorm.
 * User: comp
 * Date: 24.02.2018
 * Time: 12:40
 */

namespace app\controllers;

use app\common\exceptions\http\controllers\app\SkillsControllerHttpException;
use app\common\interfaces\ResponseStatusInterface;
use app\common\controllers\AdvancedController;
use app\common\services\redis\RedisVariationsConfig;
use app\models\{Catskills, Skills};
use yii;

/**
 * Class SkillsController
 * @package app\controllers
 */
final class SkillsController extends AdvancedController
{
    /** Константы для передачи в маршрутизатор /config/routes.php */
    public const ACTION_MAINSKILLS     = 'mainskills';
    public const ACTION_SKILLSCATEGORY = 'skillscategory';
    public const ACTION_SKILLSDETAIL   = 'skillsdetail';

    /**
     * Массив поведения контроллера
     *
     * @return array|array[]
     */
    public function behaviors(): array
    {
        return [
            [
                'class' => 'yii\filters\PageCache',
                'duration' => Yii::$app->params['cacheTime']['seven_days'],
                'dependency' => [
                    'class' => 'yii\caching\DbDependency',
                    'sql' => 'SELECT MAX(date_update) from skills limit 1',
                ],
                'variations' => RedisVariationsConfig::getMainControllerVariations()
            ],
        ];
    }

    /**
     * Рендер страницы списка навыков персонажа
     *
     * @return string
     */
    public function actionMainskills(): string
    {
        /** Рендер вьюхи со списком умений персонажа */
        return $this->render('/skills/list.php', ['catskills' => Catskills::takeActiveCatSkills()]);
    }

    /**
     * Рендер детальной страницы категории - тут рендерятся как родительские так и дочерние категории
     *
     * @param string $name - url адрес
     * @return string
     * @throws SkillsControllerHttpException
     */
    public function actionSkillscategory(string $name): string
    {
        /** Если нашли по урлу активную категорию умений */
        if (Catskills::takeActiveCategoryByUrl($name)) {

            /** Рендерим вьюху с категорией */
            return $this->render('/skills/skillscat-page.php', [
                'cat' => Catskills::takeActiveCategoryByUrl($name),
                'items' => Skills::takeSkillByCategoryId(Catskills::takeActiveCategoryByUrl($name)->id)
            ]);
        }

        /** 404 - Если не нашли страницу с активной категорией */
        throw new SkillsControllerHttpException(ResponseStatusInterface::NOT_FOUND_CODE ,'Такая страница не существует');
    }

    /**
     * Рендер детальной страницы умения
     *
     * @param string $url - url адрес
     * @return string
     * @throws SkillsControllerHttpException
     */
    public function actionSkillsdetail(string $url): string
    {
        /** Если нашли активное умение по URL адресу */
        if (Skills::takeSkillByUrl($url)) {

            /** Рендерим вьюху умения */
            return $this->render('/skills/skill-detail.php', ['item' => Skills::takeSkillByUrl($url)]);
        }

        /** 404 - Если не нашли страницу с умением */
        throw new SkillsControllerHttpException(ResponseStatusInterface::NOT_FOUND_CODE ,'Такая страница не существует');
    }
}