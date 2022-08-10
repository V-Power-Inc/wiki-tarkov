<?php

namespace app\models;

use yii\base\Model;
use yii\data\ActiveDataProvider;

/**
 * InfoSearch represents the model behind the search form about `app\models\Info`.
 */
class InfoSearch extends Info
{
    /**
     * @inheritdoc
     */
    public function rules(): array
    {
        return [
            [['id', 'enabled'], 'integer'],
            [['title', 'content', 'preview', 'course', 'bgstyle'], 'safe'],
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
        $query = Info::find();

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
            ->andFilterWhere(['like', 'content', $this->content])
            ->andFilterWhere(['like', 'preview', $this->preview])
            ->andFilterWhere(['like', 'course', $this->course])
            ->andFilterWhere(['like', 'bgstyle', $this->bgstyle]);

        return $dataProvider;
    }
}
