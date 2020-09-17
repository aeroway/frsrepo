<?php

namespace backend\models;

use yii\base\Model;
use yii\data\ActiveDataProvider;
use backend\models\DocSrchReq;

/**
 * DocSrchReqSearch represents the model behind the search form of `backend\models\DocSrchReq`.
 */
class DocSrchReqSearch extends DocSrchReq
{
    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['id'], 'integer'],
            [['full_name', 'email', 'date_update', 'username', 'answer', 'req_num', 'subdivision_id'], 'safe'],
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
        $query = DocSrchReq::find();

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

        $query->innerJoinWith('subdivision');

        // grid filtering conditions
        $query->andFilterWhere([
            'id' => $this->id,
            'date_update' => $this->date_update,
        ]);

        $query->andFilterWhere(['ilike', 'full_name', $this->full_name])
            ->andFilterWhere(['ilike', 'email', $this->email])
            ->andFilterWhere(['ilike', 'subdivision.name', $this->subdivision_id])
            ->andFilterWhere(['ilike', 'username', $this->username])
            ->andFilterWhere(['ilike', 'req_num', $this->req_num])
            ->andFilterWhere(['ilike', 'answer', $this->answer]);

        return $dataProvider;
    }
}
