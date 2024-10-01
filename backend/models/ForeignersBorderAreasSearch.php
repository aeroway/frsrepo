<?php

namespace backend\models;

use yii\base\Model;
use yii\data\ActiveDataProvider;
use backend\models\ForeignersBorderAreas;

/**
 * ForeignersBorderAreasSearch represents the model behind the search form of `backend\models\ForeignersBorderAreas`.
 */
class ForeignersBorderAreasSearch extends ForeignersBorderAreas
{
    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['id'], 'integer'],
            [['kn', 'address', 'permit_use', 'num_reg', 'date_reg', 'date_term_right', 'fio', 'citizenship', 'notice_ogv_oms', 
                'notice_prosecutor', 'sent_claims_ogv', 'sent_claims_oms', 'notice_interior_portal'], 'safe'],
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
        $query = ForeignersBorderAreas::find();

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
            'date_reg' => $this->date_reg,
            'date_term_right' => $this->date_term_right,
        ]);

        $query->andFilterWhere(['like', 'kn', $this->kn])
            ->andFilterWhere(['like', 'address', $this->address])
            ->andFilterWhere(['like', 'permit_use', $this->permit_use])
            ->andFilterWhere(['like', 'num_reg', $this->num_reg])
            ->andFilterWhere(['like', 'fio', $this->fio])
            ->andFilterWhere(['like', 'citizenship', $this->citizenship])
            ->andFilterWhere(['like', 'notice_ogv_oms', $this->notice_ogv_oms])
            ->andFilterWhere(['like', 'notice_prosecutor', $this->notice_prosecutor])
            ->andFilterWhere(['like', 'sent_claims_ogv', $this->sent_claims_ogv])
            ->andFilterWhere(['like', 'sent_claims_oms', $this->sent_claims_oms])
            ->andFilterWhere(['like', 'notice_interior_portal', $this->notice_interior_portal]);

        return $dataProvider;
    }
}
