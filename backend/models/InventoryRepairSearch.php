<?php

namespace backend\models;

use yii;
use yii\base\Model;
use yii\data\ActiveDataProvider;
use backend\models\InventoryRepair;

/**
 * InventoryRepairSearch represents the model behind the search form of `backend\models\InventoryRepair`.
 */
class InventoryRepairSearch extends InventoryRepair
{
    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['id'], 'integer'],
            [['area', 'name', 'invnum', 'inventory_moo', 'inventory_status', 'note'], 'safe'],
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
        if(!in_array("ИТО", Yii::$app->user->identity->groups)) {
            $query = InventoryRepair::find()->where(['and', ['<>', 'inventory_status', 'Отремонтирован'], ['>=', 'date_edit', '2020-01-01']]);
        } else {
            $query = InventoryRepair::find();
        }

        // add conditions that should always apply here

        $dataProvider = new ActiveDataProvider([
            'query' => $query,
            'sort' => ['defaultOrder' => ['date_edit' => SORT_DESC]],
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
        ]);

        $query->andFilterWhere(['ilike', 'area', $this->area])
            ->andFilterWhere(['ilike', 'name', $this->name])
            ->andFilterWhere(['ilike', 'invnum', $this->invnum])
            ->andFilterWhere(['ilike', 'inventory_moo', $this->inventory_moo])
            ->andFilterWhere(['ilike', 'inventory_status', $this->inventory_status])
            ->andFilterWhere(['ilike', 'note', $this->note]);

        return $dataProvider;
    }
}
