<?php

namespace app\models;

use yii\base\Model;
use yii\data\ActiveDataProvider;
use app\common\helpers\validators\IntegerValidator;
use app\common\helpers\validators\SafeValidator;

/**
 * NewsSearch represents the model behind the search form about `app\models\News`.
 */
final class NewsSearch extends News
{
    /**
     * Массив валидаций этой модели
     *
     * @return array|array[]
     */
    public function rules(): array
    {
        return [
            [self::ATTR_ID, IntegerValidator::class],

            [self::ATTR_ENABLED, IntegerValidator::class],

            [self::ATTR_TITLE, SafeValidator::class],

            [self::ATTR_URL, SafeValidator::class],

            [self::ATTR_PREVIEW, SafeValidator::class],

            [self::ATTR_CONTENT, SafeValidator::class],

            [self::ATTR_DATE_CREATE, SafeValidator::class]
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
        $query = News::find();

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
            self::ATTR_ID => $this->id,
            self::ATTR_DATE_CREATE => $this->date_create,
            self::ATTR_ENABLED => $this->enabled,
        ]);

        $query->andFilterWhere(['like', self::ATTR_TITLE, $this->title])
            ->andFilterWhere(['like', self::ATTR_URL, $this->url])
            ->andFilterWhere(['like', self::ATTR_PREVIEW, $this->preview])
            ->andFilterWhere(['like', self::ATTR_CONTENT, $this->content]);

        return $dataProvider;
    }
}