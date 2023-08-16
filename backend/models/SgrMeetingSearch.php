<?php

namespace backend\models;

use yii\base\Model;
use yii\data\ActiveDataProvider;
use backend\models\SgrMeeting;

/**
 * SgrMeetingSearch represents the model behind the search form of `backend\models\SgrMeeting`.
 */
class SgrMeetingSearch extends SgrMeeting
{
    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['id', 'year'], 'integer'],
            [['date_event', 'status', 'protocol', 'questions', 'questions_file'], 'safe'],
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
        if (!empty($params["prm"])) {
            $query = SgrMeeting::find()->where(['=', 'year', $params["prm"]]);
        } else {
            $query = SgrMeeting::find();
        }

        // add conditions that should always apply here

        $dataProvider = new ActiveDataProvider([
            'query' => $query,
            'sort'=> ['defaultOrder' => ['id' => SORT_DESC]]
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
            'date_event' => $this->date_event,
            'year' => $this->year,
        ]);

        $query->andFilterWhere(['ilike', 'status', $this->status])
            ->andFilterWhere(['ilike', 'protocol', $this->protocol])
            ->andFilterWhere(['ilike', 'questions', $this->questions])
            ->andFilterWhere(['ilike', 'questions_file', $this->questions_file]);

        return $dataProvider;
    }
}
