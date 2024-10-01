<?php

namespace backend\models;

use yii\base\Model;
use yii\data\ActiveDataProvider;
use backend\models\SpartakiadRating;

/**
 * SpartakiadRatingSearch represents the model behind the search form of `backend\models\SpartakiadRating`.
 */
class SpartakiadRatingSearch extends SpartakiadRating
{
    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['id', 'score1', 'score2', 'score3', 'score4', 'score5', 'score6'], 'integer'],
            [['department_id'], 'safe'],
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
        $query = SpartakiadRating::find()->select(['*, (COALESCE(score1, 0) + COALESCE(score2, 0) + COALESCE(score3, 0) + COALESCE(score4, 0) + COALESCE(score5, 0) + COALESCE(score6, 0)) AS sumScore']);

        // add conditions that should always apply here

        $dataProvider = new ActiveDataProvider([
            'query' => $query,
        ]);

        $query->joinWith('department d');

        $dataProvider->setSort([
            'attributes' => [
                'id',
                'score1',
                'score2',
                'score3',
                'score4',
                'score5',
                'score6',
                'sumScore',
                'department_id' => [
                    'desc' => ['d.name' => SORT_DESC],
                    'asc' => ['d.name' => SORT_ASC]
                ]
            ],
            'defaultOrder' => ['sumScore' => SORT_DESC]
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
            'score1' => $this->score1,
            'score2' => $this->score2,
            'score3' => $this->score3,
            'score4' => $this->score4,
            'score5' => $this->score5,
            'score6' => $this->score6,
        ]);

        $query->andFilterWhere(['ilike', 'd.name', $this->department_id]);

        return $dataProvider;
    }
}
