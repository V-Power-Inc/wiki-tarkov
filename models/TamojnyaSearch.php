<?php

namespace app\models;

use yii\base\Model;
use yii\data\ActiveDataProvider;

/**
 * TamojnyaSearch represents the model behind the search form about `app\models\Tamojnya`.
 */
class TamojnyaSearch extends Tamojnya
{
    /**
     * @inheritdoc
     */
    public function rules(): array
    {
        return [
            [['id', 'enabled', 'exit_anyway'], 'integer'],
            [['name', 'marker_group', 'content', 'customicon', 'exits_group'], 'safe'],
            [['coords_x', 'coords_y'], 'number'],
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
        $query = Tamojnya::find();

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
            'coords_x' => $this->coords_x,
            'coords_y' => $this->coords_y,
            'enabled' => $this->enabled,
            'exit_anyway' => $this->exit_anyway,
        ]);

        $query->andFilterWhere(['like', 'name', $this->name])
            ->andFilterWhere(['like', 'marker_group', $this->marker_group])
            ->andFilterWhere(['like', 'content', $this->content])
            ->andFilterWhere(['like', 'customicon', $this->customicon])
            ->andFilterWhere(['like', 'exits_group', $this->exits_group]);

        return $dataProvider;
    }
}
