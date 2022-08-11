<?php
/**
 * Created by PhpStorm.
 * User: comp
 * Date: 02.03.2018
 * Time: 2:47
 */

namespace app\components;
use yii\base\Component;
use app\models\Info;
use yii\db\ActiveRecord;

/**
 * Класс для вывода информационной строки на страницах сайта
 *
 * Class AlertComponent
 * @package app\components
 */
class AlertComponent extends Component
{
    /**
     * Компонент бегущей строки, если объект информационная строка, включен
     * то отобразится сообщение виджета из таблицы Info
     *
     * @return ActiveRecord
     */
    public static function alert(): ActiveRecord
    {
        $info = Info::find()->where(['id' => 2])->one();
        return $info;
    }

    /**
     * Компонент который выводит курс биткоина
     *
     * @return ActiveRecord
     */
    public static function bitkoin(): ActiveRecord
    {
        $bitkoin = Info::find()->where(['id' => 1])->one();
        return $bitkoin;
    }

    /**
     * Метод проверяет активность компонента, если компонент активен - то будет рендер вьюхи
     * @return bool
     */
    public static function AlertView(): bool
    {
        if((AlertComponent::alert()->enabled !== 0)) {
            return true;
        }

        return false;
    }
}