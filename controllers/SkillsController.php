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
            return $this->render('/skills/skillscat-page.php', ['cat' => $cat]);
        } else {
            throw new HttpException(404 ,'Такая страница не существует');
        }

    }


}