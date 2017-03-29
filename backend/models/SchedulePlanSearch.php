<?php

namespace backend\models;

use Yii;
use yii\base\Model;
use yii\data\ActiveDataProvider;
use backend\models\SchedulePlan;

/**
 * SchedulePlanSearch represents the model behind the search form about `backend\models\SchedulePlan`.
 */
class SchedulePlanSearch extends SchedulePlan
{
    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['id', 'pm_id', 'pp_id'], 'integer'],
            [['name', 'comment', 'name_doc'], 'safe'],
            [['sum', 'sum_fact', 'sum_contract'], 'number'],
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
        $query = SchedulePlan::find()->where(["pp_id" => $params["id"]]);

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
            'sum' => $this->sum,
            'sum_fact' => $this->sum_fact,
            'sum_contract' => $this->sum_contract,
            'name_doc' => $this->name_doc,
            'pm_id' => $this->pm_id,
            'pp_id' => $this->pp_id,
        ]);

        $query->andFilterWhere(['like', 'name', $this->name])
            ->andFilterWhere(['like', 'comment', $this->comment]);

        return $dataProvider;
    }
}
