<?php

namespace backend\models;

use Yii;
use yii\base\Model;
use yii\data\ActiveDataProvider;
use backend\models\InventoryOrder;
use backend\models\InventoryStatusOrder;

/**
 * InventoryOrderSearch represents the model behind the search form about `backend\models\InventoryOrder`.
 */
class InventoryOrderSearch extends InventoryOrder
{
    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['id', 'active_invor'], 'integer'],
            [['invnum_invor', 'invname_invor', 'ip_invor', 'user_invor', 'demanding_invor', 'date_invor', 'status_id_invor'], 'safe'],
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
        $query = InventoryOrder::find()->where(['active_invor'=>'1']);

        // add conditions that should always apply here

        $dataProvider = new ActiveDataProvider([
            'query' => $query,
            'sort'=> ['defaultOrder' => ['date_invor'=>SORT_DESC]]
        ]);

        $this->load($params);

        if (!$this->validate()) {
            // uncomment the following line if you do not want to return any records when validation fails
            // $query->where('0=1');
            return $dataProvider;
        }

        $query->joinWith('idStatusorderInvor');

        // grid filtering conditions
        $query->andFilterWhere([
            'id' => $this->id,
            'active_invor' => $this->active_invor,
        ]);

        $query->andFilterWhere(['like', 'invnum_invor', $this->invnum_invor])
            ->andFilterWhere(['like', 'invname_invor', $this->invname_invor])
            ->andFilterWhere(['like', 'ip_invor', $this->ip_invor])
            ->andFilterWhere(['like', 'user_invor', $this->user_invor])
            ->andFilterWhere(['like', 'demanding_invor', $this->demanding_invor])
            ->andFilterWhere(['like', 'status_invor', $this->status_id_invor])
            ->andFilterWhere(['like', 'date_invor', $this->date_invor]);
            

        return $dataProvider;
    }
}
