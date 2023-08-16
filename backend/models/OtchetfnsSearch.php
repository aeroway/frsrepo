<?php

namespace backend\models;

use yii\base\Model;
use yii\data\ActiveDataProvider;
use backend\models\Otchetfns;

/**
 * OtchetfnsSearch represents the model behind the search form of `backend\models\Otchetfns`.
 */
class OtchetfnsSearch extends Otchetfns
{
    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['id', 'flag'], 'integer'],
            [['area', 'type_obj', 'kn', 'address', 'category', 'permit_use', 'square', 'date_reg', 'info_tax', 'info_gfd', 'in_process', 'remove_reg', 'identified', 'comment', 'date', 'username', 'status', 'status2', 'filename', 'date_update', 'date_load'], 'safe'],
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
        $query = Otchetfns::find();

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
            'flag' => $this->flag,
            'date' => $this->date,
            'date_update' => $this->date_update,
            'date_load' => $this->date_load,
        ]);

        $query->andFilterWhere(['like', 'area', $this->area])
            ->andFilterWhere(['like', 'type_obj', $this->type_obj])
            ->andFilterWhere(['like', 'kn', $this->kn])
            ->andFilterWhere(['like', 'address', $this->address])
            ->andFilterWhere(['like', 'category', $this->category])
            ->andFilterWhere(['like', 'permit_use', $this->permit_use])
            ->andFilterWhere(['like', 'square', $this->square])
            ->andFilterWhere(['like', 'info_tax', $this->info_tax])
            ->andFilterWhere(['like', 'info_gfd', $this->info_gfd])
            ->andFilterWhere(['like', 'in_process', $this->in_process])
            ->andFilterWhere(['like', 'remove_reg', $this->remove_reg])
            ->andFilterWhere(['like', 'identified', $this->identified])
            ->andFilterWhere(['like', 'comment', $this->comment])
            ->andFilterWhere(['like', 'username', $this->username])
            ->andFilterWhere(['like', 'status', $this->status])
            ->andFilterWhere(['like', 'status2', $this->status2])
            ->andFilterWhere(['like', 'filename', $this->filename]);

        return $dataProvider;
    }
}
