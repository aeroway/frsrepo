<?php

namespace backend\models;

use Yii;
use yii\base\Model;
use yii\data\ActiveDataProvider;
use backend\models\Inventory;

/**
 * InventorySearch represents the model behind the search form about `backend\models\Inventory`.
 */
class InventorySearch extends Inventory
{
    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['id' /*, 'authority', 'waybill'*/], 'integer'],
            [['invname','id_typetech', 'id_moo', 'id_status', 'invnum', 'location', 'date', 'comment', 'username'], 'safe'],
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
        $query = Inventory::find();

        $dataProvider = new ActiveDataProvider([
            'query' => $query,
            'sort'=> ['defaultOrder' => ['date'=>SORT_DESC]]
        ]);

        $sort = $dataProvider->getSort();
        $sort->attributes = array_merge($sort->attributes, [
            'id' => [
                'asc' => [static::tableName() . '.id' => SORT_ASC],
                'desc' => [static::tableName() .'.id' => SORT_DESC]
            ]
        ]);
        $dataProvider->setSort($sort);

        $this->load($params);

        if (!$this->validate()) {
            // uncomment the following line if you do not want to return any records when validation fails
            // $query->where('0=1');
            return $dataProvider;
        }

        $query->joinWith('idMoo');
        $query->joinWith('idStatus');
        $query->joinWith('idTypetech');

        $query->andFilterWhere([
            'id' => $this->id,
            'date' => $this->date,
            'authority' => $this->authority,
            'waybill' => $this->waybill,
            'username' => $this->username,
        ]);

        $query->andFilterWhere(['ilike', 'invname', $this->invname])
            ->andFilterWhere(['ilike', 'invnum', $this->invnum])
            ->andFilterWhere(['ilike', 'location', $this->location])
            ->andFilterWhere(['ilike', 'comment', $this->comment])
            ->andFilterWhere(['ilike', 'inventory_moo.name', $this->id_moo])
            ->andFilterWhere(['ilike', 'inventory_status.name', $this->id_status])
            ->andFilterWhere(['ilike', 'inventory_typetech.name', $this->id_typetech]);

        if(!in_array("AdminInventory", Yii::$app->user->identity->groups)) {
            $query->andFilterWhere(['!=', 'inventory_status.id', 9]);
        }

        return $dataProvider;
    }
}
