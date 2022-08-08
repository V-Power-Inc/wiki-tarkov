<?php
/**
 * Created by PhpStorm.
 * User: comp
 * Date: 24.02.2018
 * Time: 12:40
 */

namespace app\controllers;
use app\common\controllers\AdvancedController;
use yii\web\HttpException;
use app\models\Catskills;
use app\models\Skills;
use yii;

/**
 * Class SkillsController
 * @package app\controllers
 */
class SkillsController extends AdvancedController
{
    /** Константы для передачи в маршрутизатор /config/routes.php */
    const ACTION_MAINSKILLS     = 'mainskills';
    const ACTION_SKILLSCATEGORY = 'skillscategory';
    const ACTION_SKILLSDETAIL   = 'skillsdetail';

    /** Кеширование по секундам с различными сроками **/
    const WEEK_CACHE = 604800;
    const TWO_DAYS = 172800;
    const ONE_DAY = 86400;

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
                'duration' => 604800,
                'dependency' => [
                    'class' => 'yii\caching\DbDependency',
                    'sql' => 'SELECT MAX(date_update) from skills limit 1',
                ],
                'variations' => [
                    $_SERVER['SERVER_NAME'],
                    Yii::$app->request->url,
                    Yii::$app->request->get('page')
                ]
            ],
        ];
    }
    
    /** Рендер страницы списка навыков персонажа **/
    public function actionMainskills()
    {
        $catskills = Catskills::find()->where(['enabled' => 1])->cache(self::ONE_DAY)->asArray()->all();
        return $this->render('/skills/list.php', ['catskills' => $catskills,]);
    }

    /** Рендер детальной страницы категории - тут рендерятся как родительские так и дочерние категории */
    public function actionSkillscategory($name)
    {
        $cat = Catskills::find()->where(['url'=>$name])->cache(self::ONE_DAY)->One();
        
        if($cat) {
            // Здесь мы возвращаем и неактивные элементы, т.к. на них стоит проверка во вьюшке
            $items = Skills::find()->andWhere(['category' => $cat->id])->cache(self::ONE_DAY)->asArray()->all();
            return $this->render('/skills/skillscat-page.php', ['cat' => $cat, 'items' => $items]);
        } else {
            throw new HttpException(404 ,'Такая страница не существует');
        }
    }
    
    /*** Рендер детальной страницы умения ***/
    public function actionSkillsdetail($url) {
        $item = Skills::find()->where(['url'=>$url])->andWhere(['enabled' => 1])->cache(self::ONE_DAY)->One();

        if($item) {
            return $this->render('/skills/skill-detail.php', ['item' => $item]);
        } else {
            throw new HttpException(404 ,'Такая страница не существует');
        }
    }
}