<?php

namespace backend\models;

use yii\base\Model;
use yii\data\ActiveDataProvider;
use backend\models\SpartakiadMember;

/**
 * SpartakiadMemberSearch represents the model behind the search form of `backend\models\SpartakiadMember`.
 */
class SpartakiadMemberSearch extends SpartakiadMember
{
    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['id'], 'integer'],
            [['name', 'department_id', 'sport_type'], 'safe'],
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
        $query = SpartakiadMember::find();

        // add conditions that should always apply here

        $dataProvider = new ActiveDataProvider([
            'query' => $query,
            'sort' => [
                'defaultOrder' => 
                    ['name' => SORT_ASC]
            ],
        ]);

        $query->joinWith('department d');

        $this->load($params);

        if (!$this->validate()) {
            // uncomment the following line if you do not want to return any records when validation fails
            // $query->where('0=1');
            return $dataProvider;
        }

        // grid filtering conditions
        $query->andFilterWhere([
            'id' => $this->id,
        ]);

        $query->andFilterWhere(['ilike', 'name', $this->name])
              ->andFilterWhere(['ilike', 'd.name', $this->department_id])
              ->andFilterWhere(['ilike', 'sport_type', $this->sport_type]);

        return $dataProvider;
    }
}
