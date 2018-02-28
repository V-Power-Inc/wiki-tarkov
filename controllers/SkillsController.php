<?php
/**
 * Created by PhpStorm.
 * User: comp
 * Date: 24.02.2018
 * Time: 12:40
 */

namespace app\controllers;
use yii\web\Controller;
use yii\web\HttpException;
use app\models\Catskills;
use app\models\Skills;


class SkillsController extends Controller
{
    
    /** Рендер страницы списка навыков персонажа **/
    public function actionMainskills()
    {
        $catskills = Catskills::find()->where(['enabled' => 1])->asArray()->all();
        return $this->render('/skills/list.php', ['catskills' => $catskills,]);
    }

    /** Рендер детальной страницы категории - тут рендерятся как родительские так и дочерние категории */
    public function actionSkillscategory($name)
    {
        $cat = Catskills::find()->where(['url'=>$name])->One();
        
        if($cat) {
            // Здесь мы возвращаем и неактивные элементы, т.к. на них стоит проверка во вьюшке
            $items = Skills::find()->andWhere(['category' => $cat->id])->asArray()->all();
            return $this->render('/skills/skillscat-page.php', ['cat' => $cat, 'items' => $items]);
        } else {
            throw new HttpException(404 ,'Такая страница не существует');
        }
    }
    
    /*** Рендер детальной страницы умения ***/
    public function actionSkillsdetail($url) {
        $item = Skills::find()->where(['url'=>$url])->andWhere(['enabled' => 1])->One();

        if($item) {
            return $this->render('/skills/skill-detail.php', ['item' => $item]);
        } else {
            throw new HttpException(404 ,'Такая страница не существует');
        }
    }
}