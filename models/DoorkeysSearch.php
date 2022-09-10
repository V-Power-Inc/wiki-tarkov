<?php

namespace app\models;

use yii\base\Model;
use yii\data\ActiveDataProvider;
use app\common\helpers\validators\IntegerValidator;
use app\common\helpers\validators\SafeValidator;

/**
 * DoorkeysSearch represents the model behind the search form about `app\models\Doorkeys`.
 */
class DoorkeysSearch extends Doorkeys
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

            [static::ATTR_ACTIVE, IntegerValidator::class],

            [static::ATTR_NAME, SafeValidator::class],

            [static::ATTR_CONTENT, SafeValidator::class],

            [static::ATTR_MAPGROUP, SafeValidator::class],

            [static::ATTR_DATE_CREATE, SafeValidator::class]
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
        $query = Doorkeys::find();

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
            'active' => $this->active,
            'date_create' => $this->date_create,
        ]);

        $query->andFilterWhere(['like', 'name', $this->name])
            ->andFilterWhere(['like', 'mapgroup', $this->mapgroup])
            ->andFilterWhere(['like', 'content', $this->content]);

        return $dataProvider;
    }
}
