<?php

namespace app\models;

use Yii;
use yii\base\Model;
use yii\data\ActiveDataProvider;
use app\models\Skypshik;

/**
 * SkypshikSearch represents the model behind the search form of `app\models\Skypshik`.
 */
class SkypshikSearch extends Skypshik
{
    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['id', 'tab_number'], 'integer'],
            [['title', 'content', 'date_create', 'date_edit', 'preview'], 'safe'],
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
        $query = Skypshik::find();

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
            'tab_number' => $this->tab_number,
            'date_create' => $this->date_create,
            'date_edit' => $this->date_edit,
        ]);

        $query->andFilterWhere(['like', 'title', $this->title])
            ->andFilterWhere(['like', 'content', $this->content])
            ->andFilterWhere(['like', 'preview', $this->preview]);

        return $dataProvider;
    }
}
