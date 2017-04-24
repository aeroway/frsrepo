<?php

namespace backend\models;

use Yii;
use yii\base\Model;
use yii\data\ActiveDataProvider;
use backend\models\PurchasePlan;

/**
 * PurchaseplanSearch represents the model behind the search form about `backend\models\PurchasePlan`.
 */
class PurchaseplanSearch extends PurchasePlan
{
    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['id'], 'integer'],
            [['type', 'okpd', 'econom', 'name_object'], 'safe'],
            [['outlay', 'p_year', 'c_year', 'special', 'sum'], 'number'],
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
        $query = PurchasePlan::find()->where(["st_id" => $params["id"]])->andWhere(['is_top' => 1]);

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
            'outlay' => $this->outlay,
            'p_year' => $this->p_year,
            'c_year' => $this->c_year,
            'special' => $this->special,
            'sum' => $this->sum,
        ]);

        $query->andFilterWhere(['like', 'type', $this->type])
            ->andFilterWhere(['like', 'okpd', $this->okpd])
            ->andFilterWhere(['like', 'econom', $this->econom])
            ->andFilterWhere(['like', 'name_object', $this->name_object]);

        return $dataProvider;
    }
}
