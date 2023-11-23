<?php

namespace app\models;

use app\common\helpers\validators\IntegerValidator;
use app\common\helpers\validators\SafeValidator;
use yii\base\InvalidConfigException;
use yii\base\Model;
use yii\data\ActiveDataProvider;
use yii\db\Expression;
use Yii;

/**
 * Поисковая модель сообщений со стороны пользователь (CRUD в админке это использует)
 *
 * Class FeedbackMessagesSearch
 * @package app\models
 */
class FeedbackMessagesSearch extends FeedbackMessages
{
    /**
     * Массив валидаций атрибутов текущей модели
     *
     * @return array
     */
    public function rules(): array
    {
        return [
            [static::ATTR_ID, IntegerValidator::class],

            [static::ATTR_DATE_CREATE, SafeValidator::class]
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
     * @param array $params - массив GET параметров
     *
     * @return ActiveDataProvider
     * @throws InvalidConfigException
     */
    public function search($params): ActiveDataProvider
    {
        /** Ищем записи в фидбеке посетителей */
        $query = FeedbackMessages::find();

        /** Создаем объект датапровайдера */
        $dataProvider = new ActiveDataProvider([
            'query' => $query,
        ]);

        /** Грузим в текущую форму атрибуты */
        $this->load($params);

        /** Если атрибуты не прошли валидацию */
        if (!$this->validate()) {

            /** Возвращаем дефолтный датапровайдер */
            return $dataProvider;
        }

        /** Ищем данные в соответствии с ID */
        $query->andFilterWhere([
            static::ATTR_ID => $this->id,
        ]);

        /** Если в атрибуте есть дата создания */
        if (!empty($this->date_create)) {

            /** Форматируем дату, чтобы по ней можно было искать без времени */
            $date = Yii::$app->formatter->asDate($this->date_create, 'php: Y-m-d');

            /** Ищем данные в связке с датой */
            $query->andWhere(new Expression("date(" . static::TABLE_NAME .".". static::ATTR_DATE_CREATE . ") = '$date'"));
        }

        /** Контент ищем через like */
        $query->andFilterWhere(['ilike', static::ATTR_CONTENT, $this->content]);

        /** Возвращаем объект дата-провайдера */
        return $dataProvider;
    }
}