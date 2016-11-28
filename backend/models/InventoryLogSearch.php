<?php

namespace backend\models;

use Yii;
use yii\base\Model;
use yii\data\ActiveDataProvider;
use backend\models\InventoryLog;

/**
 * InventorySearch represents the model behind the search form about `backend\models\InventoryLog`.
 */
class InventoryLogSearch extends InventoryLog
{
    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['id', 'id_moo', 'id_typetech', 'id_status', 'authority', 'waybill'], 'integer'],
            [['invname', 'invnum', 'location', 'date', 'comment', 'username'], 'safe'],
            [['date'], 'date','format' => 'M.d.yyyy'],
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
        $query = InventoryLog::find();

        $dataProvider = new ActiveDataProvider([
            'query' => $query,
            'sort'=> ['defaultOrder' => ['id'=>SORT_DESC]],
        ]);

        $this->load($params);

        if (!$this->validate()) {
            // uncomment the following line if you do not want to return any records when validation fails
            // $query->where('0=1');
            return $dataProvider;
        }

        $query->where('invnum=\''.$params["invnum"].'\'');

        $query->andFilterWhere([
            'id' => $this->id,
            'id_moo' => $this->id_moo,
            'id_typetech' => $this->id_typetech,
            'date' => $this->date,
            'id_status' => $this->id_status,
            'authority' => $this->authority,
            'waybill' => $this->waybill,
            'username' => $this->username,
        ]);

        $query->andFilterWhere(['like', 'invname', $this->invname])
            ->andFilterWhere(['like', 'invnum', $this->invnum])
            ->andFilterWhere(['like', 'location', $this->location])
            ->andFilterWhere(['like', 'comment', $this->comment]);

        return $dataProvider;
    }
}
