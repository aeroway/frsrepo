<?php

namespace backend\models;

use yii\base\Model;
use yii\data\ActiveDataProvider;
use backend\models\Otcheterl;

/**
 * OtcheterlSearch represents the model behind the search form of `backend\models\Otcheterl`.
 */
class OtcheterlSearch extends Otcheterl
{
    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['id', 'area_id', 'send'], 'integer'],
            [['kuvd', 'application_date', 'kn', 'coordinates', 'address', 'draft_number', 'draft_date', 'outgoing_number', 'outgoing_date', 'fio_reg', 'email_reg'], 'safe'],
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
        $query = Otcheterl::find();

        // add conditions that should always apply here

        $dataProvider = new ActiveDataProvider([
            'query' => $query,
            'sort'=> ['defaultOrder' => ['id' => SORT_DESC]]
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
            'area_id' => $this->area_id,
            'send' => $this->send,
            'application_date' => $this->application_date,
            'draft_date' => $this->draft_date,
            'outgoing_date' => $this->outgoing_date,
        ]);

        $query->andFilterWhere(['like', 'kuvd', $this->kuvd])
            ->andFilterWhere(['like', 'fio_reg', $this->fio_reg])
            ->andFilterWhere(['like', 'email_reg', $this->email_reg])
            ->andFilterWhere(['like', 'kn', $this->kn])
            ->andFilterWhere(['like', 'coordinates', $this->coordinates])
            ->andFilterWhere(['like', 'address', $this->address])
            ->andFilterWhere(['like', 'draft_number', $this->draft_number])
            ->andFilterWhere(['like', 'outgoing_number', $this->outgoing_number]);

        return $dataProvider;
    }
}
