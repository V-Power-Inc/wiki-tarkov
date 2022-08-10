<?php

namespace app\models;

use yii\base\Model;
use yii\data\ActiveDataProvider;

/**
 * TradersSearch represents the model behind the search form about `app\models\Traders`.
 */
class TradersSearch extends Traders
{
    /**
     * @inheritdoc
     */
    public function rules(): array
    {
        return [
            [['id', 'enabled'], 'integer'],
            [['title', 'preview', 'urltoquets', 'button_quests', 'button_detail', 'bg_style'], 'safe'],
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
            'id' => $this->id,
            'enabled' => $this->enabled,
        ]);

        $query->andFilterWhere(['like', 'title', $this->title])
            ->andFilterWhere(['like', 'preview', $this->preview])
            ->andFilterWhere(['like', 'urltoquets', $this->urltoquets])
            ->andFilterWhere(['like', 'button_quests', $this->button_quests])
            ->andFilterWhere(['like', 'button_detail', $this->button_detail])
            ->andFilterWhere(['like', 'bg_style', $this->bg_style]);

        return $dataProvider;
    }
}
