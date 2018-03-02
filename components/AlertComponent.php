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


class AlertComponent extends Component
{
    /** Компонент бегущей строки, если объект информационная строка, включен - то отобразиться сообщение виджета из таблицы Info **/
    public static function alert()
    {
        $info = Info::find()->where(['id' => 2])->one();
        return $info;
    }
    
    /** Компонент который выводит курс биткоина **/
    public static function bitkoin() {
        $bitkoin = Info::find()->where(['id' => 1])->one();
        return $bitkoin;
    }
    
}