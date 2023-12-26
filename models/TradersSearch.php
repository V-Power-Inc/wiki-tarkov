<?php

namespace app\models;

use yii\base\Model;
use yii\data\ActiveDataProvider;
use app\common\helpers\validators\IntegerValidator;
use app\common\helpers\validators\SafeValidator;

/**
 * TradersSearch represents the model behind the search form about `app\models\Traders`.
 */
class TradersSearch extends Traders
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

            [static::ATTR_TITLE, SafeValidator::class],

            [static::ATTR_PREVIEW, SafeValidator::class],

            [static::ATTR_URLTOQUETS, SafeValidator::class],

            [static::ATTR_BUTTON_QUESTS, SafeValidator::class],

            [static::ATTR_BUTTON_DETAIL, SafeValidator::class],

            [static::ATTR_BG_STYLE, SafeValidator::class]
        ];
    }

    /**
     * @inheritdoc
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
        $query = Traders::find();

        // add conditions that should always apply here

        $dataProvider = new ActiveDataProvider([
            'query' => $query,
        ]);

        $this->load($params);

        if (!$this->validate()) {
            // uncomment the following line if you do not want to return any records when validation fails
            // $query->where('0=1');
            return $dataProvider;
        }

        // grid filtering conditions
        $query->andFilterWhere([
            static::ATTR_ID => $this->id,
            static::ATTR_ENABLED => $this->enabled,
        ]);

        $query->andFilterWhere(['like', static::ATTR_TITLE, $this->title])
            ->andFilterWhere(['like', static::ATTR_PREVIEW, $this->preview])
            ->andFilterWhere(['like', static::ATTR_URLTOQUETS, $this->urltoquets])
            ->andFilterWhere(['like', static::ATTR_BUTTON_QUESTS, $this->button_quests])
            ->andFilterWhere(['like', static::ATTR_BUTTON_DETAIL, $this->button_detail])
            ->andFilterWhere(['like', static::ATTR_BG_STYLE, $this->bg_style]);

        return $dataProvider;
    }
}
