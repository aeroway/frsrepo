<?php

namespace backend\models;

use yii\base\Model;
use yii\data\ActiveDataProvider;
use backend\models\Regist;

/**
 * RegistSearch represents the model behind the search form of `backend\models\Regist`.
 */
class RegistSearch extends Regist
{
    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['id'], 'integer'],
            [['developer', 'object', 'registered_object', 'commission', 'permission', 'registrar', 'file_name'], 'safe'],
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
        $query = Regist::find();

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
        ]);

        $query->andFilterWhere(['like', 'developer', $this->developer])
            ->andFilterWhere(['like', 'object', $this->object])
            ->andFilterWhere(['like', 'registered_object', $this->registered_object])
            ->andFilterWhere(['like', 'commission', $this->commission])
            ->andFilterWhere(['like', 'permission', $this->permission])
            ->andFilterWhere(['like', 'registrar', $this->registrar])
            ->andFilterWhere(['like', 'file_name', $this->file_name]);

        return $dataProvider;
    }
}
