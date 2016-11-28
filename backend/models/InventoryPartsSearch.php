<?php

namespace backend\models;

use Yii;
use yii\base\Model;
use yii\data\ActiveDataProvider;
use backend\models\InventoryParts;

/**
 * InventoryPartsSearch represents the model behind the search form about `backend\models\InventoryParts`.
 */
class InventoryPartsSearch extends InventoryParts
{
    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['id', 'amount'], 'integer'],
            [['nameparts', 'id_typeparts', 'location', 'comment_parts'], 'safe'],
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
        $query = InventoryParts::find();

        $dataProvider = new ActiveDataProvider([
            'query' => $query,
        ]);

        $this->load($params);

        if (!$this->validate()) {
            // uncomment the following line if you do not want to return any records when validation fails
            // $query->where('0=1');
            return $dataProvider;
        }

        $query->joinWith('idTypeparts');
        $query->andFilterWhere([
            'id' => $this->id,
            'amount' => $this->amount,
        ]);

        $query->andFilterWhere(['like', 'inventory_typeparts.name', $this->id_typeparts])
            ->andFilterWhere(['like', 'nameparts', $this->nameparts])
            ->andFilterWhere(['like', 'location', $this->location])
            ->andFilterWhere(['like', 'comment_parts', $this->comment_parts]);

        return $dataProvider;
    }
}
