<?php

namespace app\models;

use app\common\helpers\validators\IntegerValidator;
use app\common\helpers\validators\NumberValidator;
use app\common\helpers\validators\StringValidator;
use app\common\helpers\validators\SafeValidator;
use yii\base\Model;
use yii\data\ActiveDataProvider;

/**
 * Поисковая модель для AR модели маркеров интерактивных карт
 *
 * Class MapsSearch
 * @package app\models
 */
class MapsSearch extends Maps
{
    /**
     * Массив валидаций этой модели
     *
     * @return array|array[]
     */
    public function rules(): array
    {
        return [
            [static::ATTR_ID, IntegerValidator::class],

            [static::ATTR_ENABLED, IntegerValidator::class],

            [static::ATTR_EXIT_ANYWAY, IntegerValidator::class],

            [static::ATTR_NAME, SafeValidator::class],

            [static::ATTR_MAP, StringValidator::class, StringValidator::ATTR_MAX => StringValidator::VARCHAR_LENGTH],

            [static::ATTR_MARKER_GROUP, SafeValidator::class],

            [static::ATTR_CONTENT, SafeValidator::class],

            [static::ATTR_CUSTOMICON, SafeValidator::class],

            [static::ATTR_EXITS_GROUP, SafeValidator::class],

            [static::ATTR_COORDS_X, NumberValidator::class],

            [static::ATTR_COORDS_Y, NumberValidator::class]
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function scenarios()
    {
        // bypass scenarios() implementation in the parent class
        return Model::scenarios();
    }

    /**
     * Creates data provider instance with search query applied
     *
     * @param array $params
     *
     * @return ActiveDataProvider
     */
    public function search($params)
    {
        /** Базовый запрос */
        $query = Maps::find();

        /** Объявляем DataProvider */
        $dataProvider = new ActiveDataProvider([
            'query' => $query,
        ]);

        /** Грузим данные в модель */
        $this->load($params);

        /** Если валидация не прошла */
        if (!$this->validate()) {
            // uncomment the following line if you do not want to return any records when validation fails
            // $query->where('0=1');

            /** Возвращаем дефолтный провайдер данных */
            return $dataProvider;
        }

        /** Фильрациия для Grid */
        $query->andFilterWhere([
            static::ATTR_ID => $this->id,
            static::ATTR_COORDS_X => $this->coords_x,
            static::ATTR_COORDS_Y => $this->coords_y,
            static::ATTR_ENABLED => $this->enabled,
            static::ATTR_EXIT_ANYWAY => $this->exit_anyway,
            static::ATTR_DATE_UPDATE => $this->date_update,
        ]);

        /** Фильрациия для Grid */
        $query->andFilterWhere(['like', static::ATTR_NAME, $this->name])
            ->andFilterWhere(['like', static::ATTR_MAP, $this->map])
            ->andFilterWhere(['like', static::ATTR_MARKER_GROUP, $this->marker_group])
            ->andFilterWhere(['like', static::ATTR_CONTENT, $this->content])
            ->andFilterWhere(['like', static::ATTR_CUSTOMICON, $this->customicon])
            ->andFilterWhere(['like', static::ATTR_EXITS_GROUP, $this->exits_group]);

        /** Возвращаем $dataProvider */
        return $dataProvider;
    }
}