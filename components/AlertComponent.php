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
     * @return mixed
     */
    public static function alert()
    {
        $info = Info::find()->where(['id' => 2])->one();
        return $info ?? null;
    }

    /**
     * Метод проверяет активность компонента, если компонент активен - то будет рендер вьюхи
     * @return bool
     */
    public static function AlertView(): bool
    {
        /** Если Алерт компонент не равен null - возвращаем true */
        if((AlertComponent::alert() !== null)) {
            return true;
        }

        /** В противном случае false */
        return false;
    }
}