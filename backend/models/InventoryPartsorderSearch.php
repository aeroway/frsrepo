<?php

namespace backend\models;

use Yii;
use yii\base\Model;
use yii\data\ActiveDataProvider;
use backend\models\InventoryPartsorder;

/**
 * InventoryPartsorderSearch represents the model behind the search form about `backend\models\InventoryPartsorder`.
 */
class InventoryPartsorderSearch extends InventoryPartsorder
{
    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['id', 'count_invpo', 'id_partsorder_invor'], 'integer'],
            [['partsname_invpo'], 'safe'],
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
        $query = InventoryPartsorder::find();

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
            'count_invpo' => $this->count_invpo,
            'id_partsorder_invor' => $this->id_partsorder_invor,
        ]);

        $query->andFilterWhere(['like', 'partsname_invpo', $this->partsname_invpo]);

        return $dataProvider;
    }
}
