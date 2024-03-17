<?php

namespace app\models;

use yii\base\Model;
use yii\data\ActiveDataProvider;
use app\common\helpers\validators\IntegerValidator;
use app\common\helpers\validators\SafeValidator;

/**
 * SkillsSearch represents the model behind the search form about `app\models\Skills`.
 */
final class SkillsSearch extends Skills
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

            [self::ATTR_CATEGORY, IntegerValidator::class],

            [self::ATTR_ENABLED, IntegerValidator::class],

            [self::ATTR_TITLE, SafeValidator::class],

            [self::ATTR_URL, SafeValidator::class],

            [self::ATTR_DESCRIPTION, SafeValidator::class],

            [self::ATTR_KEYWORDS, SafeValidator::class],

            [self::ATTR_PREVIEW, SafeValidator::class]
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
        $query = Skills::find();

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
            self::ATTR_CATEGORY => $this->category,
            self::ATTR_ENABLED => $this->enabled,
        ]);

        $query->andFilterWhere(['like', self::ATTR_TITLE, $this->title])
            ->andFilterWhere(['like', self::ATTR_URL, $this->url])
            ->andFilterWhere(['like', self::ATTR_DESCRIPTION, $this->description])
            ->andFilterWhere(['like', self::ATTR_KEYWORDS, $this->keywords])
            ->andFilterWhere(['like', self::ATTR_PREVIEW, $this->preview]);

        return $dataProvider;
    }
}
