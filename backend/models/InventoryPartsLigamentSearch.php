<?php

namespace backend\models;

use Yii;
use yii\base\Model;
use yii\data\ActiveDataProvider;
use backend\models\InventoryPartsLigament;

/**
 * InventoryPartsLigamentSearch represents the model behind the search form about `backend\models\InventoryPartsLigament`.
 */
class InventoryPartsLigamentSearch extends InventoryPartsLigament
{
    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['id', 'amount_ipl'], 'integer'],
            [['invnum_inventory', 'id_inventory_parts'], 'safe'],
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
        $query = InventoryPartsLigament::find();

        $dataProvider = new ActiveDataProvider([
            'query' => $query,
        ]);

        $this->load($params);

        if (!$this->validate()) {
            // uncomment the following line if you do not want to return any records when validation fails
            // $query->where('0=1');
            return $dataProvider;
        }

        $query->joinWith('idInventoryParts');

        $query->andFilterWhere([
            'id' => $this->id,
            'amount_ipl' => $this->amount_ipl,
        ]);

        $query->andFilterWhere(['like', 'invnum_inventory', $this->invnum_inventory])
              ->andFilterWhere(['like', 'inventory_parts.nameparts', $this->id_inventory_parts]);

        return $dataProvider;
    }
}
