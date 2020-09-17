<?php

namespace backend\models;

use yii\base\Model;
use yii\data\ActiveDataProvider;
use backend\models\RstEnfProc;

/**
 * RstEnfProcSearch represents the model behind the search form of `backend\models\RstEnfProc`.
 */
class RstEnfProcSearch extends RstEnfProc
{
    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['id', 'otdel_id'], 'integer'],
            [['num_req', 'agency', 'num_enf_proc', 'decision', 'num_notice', 'num_appeal', 'date_edit', 'username', 'result', 'comment'], 'safe'],
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
        $query = RstEnfProc::find();

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
            'otdel_id' => $this->otdel_id,
            'date_edit' => $this->date_edit,
        ]);

        $query->andFilterWhere(['like', 'num_req', $this->num_req])
            ->andFilterWhere(['like', 'agency', $this->agency])
            ->andFilterWhere(['like', 'num_enf_proc', $this->num_enf_proc])
            ->andFilterWhere(['like', 'decision', $this->decision])
            ->andFilterWhere(['like', 'num_notice', $this->num_notice])
            ->andFilterWhere(['like', 'num_appeal', $this->num_appeal])
            ->andFilterWhere(['like', 'username', $this->username])
            ->andFilterWhere(['like', 'result', $this->result])
            ->andFilterWhere(['like', 'comment', $this->comment]);

        return $dataProvider;
    }
}
