<?php

namespace app\models;

use yii\base\Model;
use yii\data\ActiveDataProvider;
use app\common\helpers\validators\IntegerValidator;
use app\common\helpers\validators\SafeValidator;

/**
 * ArticlesSearch represents the model behind the search form about `app\models\Articles`.
 */
class ArticlesSearch extends Articles
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

            [static::ATTR_URL, SafeValidator::class],

            [static::ATTR_PREVIEW, SafeValidator::class],

            [static::ATTR_CONTENT, SafeValidator::class],

            [static::ATTR_DATE_CREATE, SafeValidator::class],

            [static::ATTR_DESCRIPTION, SafeValidator::class],

            [static::ATTR_KEYWORDS, SafeValidator::class],

            [static::ATTR_SHORTDESC, SafeValidator::class]
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
        $query = Articles::find();

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
            'date_create' => $this->date_create,
            'enabled' => $this->enabled,
        ]);

        $query->andFilterWhere(['like', static::ATTR_TITLE, $this->title])
            ->andFilterWhere(['like', static::ATTR_URL, $this->url])
            ->andFilterWhere(['like', static::ATTR_PREVIEW, $this->preview])
            ->andFilterWhere(['like', static::ATTR_CONTENT, $this->content])
            ->andFilterWhere(['like', static::ATTR_DESCRIPTION, $this->description])
            ->andFilterWhere(['like', static::ATTR_KEYWORDS, $this->keywords])
            ->andFilterWhere(['like', static::ATTR_SHORTDESC, $this->shortdesc]);

        return $dataProvider;
    }
}
