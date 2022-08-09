<?php

namespace app\models;

/**
 * This is the model class for table "patrons".
 *
 * @property int $id
 * @property string $caliber
 * @property string $type
 * @property string $damage
 * @property string $probitie
 * @property string $damage_per_defence
 * @property string $speed
 * @property string $count
 * @property string $tochn
 * @property string $otdacha
 * @property string $fragmentation
 * @property string $iznos
 * @property string $blood_1
 * @property string $blood_2
 * @property string $rikochet
 * @property string $traccer
 */
class Patrons extends \yii\db\ActiveRecord
{
    /** Константы атрибутов Active Record модели */
    const ATTR_ID                 = 'id';
    const ATTR_CALIBER            = 'caliber';
    const ATTR_TYPE               = 'type';
    const ATTR_DAMAGE             = 'damage';
    const ATTR_PROBITIE           = 'probitie';
    const ATTR_DAMAGE_PER_DEFENCE = 'damage_per_defence';
    const ATTR_SPEED              = 'speed';
    const ATTR_COUNT              = 'count';
    const ATTR_TOCHN              = 'tochn';
    const ATTR_OTDACHA            = 'otdacha';
    const ATTR_FRAGMENTATION      = 'fragmentation';
    const ATTR_IZNOS              = 'iznos';
    const ATTR_BLOOD_1            = 'blood_1';
    const ATTR_BLOOD_2            = 'blood_2';
    const ATTR_RIKOCHET           = 'rikochet';
    const ATTR_TRACCER            = 'traccer';

    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'patrons';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['caliber', 'type', 'damage', 'probitie', 'damage_per_defence', 'speed', 'count', 'tochn', 'otdacha', 'fragmentation', 'iznos', 'blood_1', 'blood_2', 'rikochet', 'traccer'], 'string', 'max' => 255],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'caliber' => 'Калибр',
            'type' => 'Вид патрона',
            'damage' => 'Урон',
            'probitie' => 'Пробитие',
            'damage_per_defence' => 'Урон по броне',
            'speed' => 'Скорость м/с',
            'count' => 'Снаряды кол-во',
            'tochn' => 'Точность %',
            'otdacha' => 'Отдача %',
            'fragmentation' => 'Шанс фрагментации %',
            'iznos' => 'Доп. износ оружия',
            'blood_1' => 'Тяжелое кровотечение %',
            'blood_2' => 'Легкое кровотечение %',
            'rikochet' => 'Шанс рикошета',
            'traccer' => 'Трассер',
        ];
    }
}
