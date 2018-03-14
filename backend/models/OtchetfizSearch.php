<?php

namespace backend\models;

use Yii;
use yii\base\Model;
use yii\data\ActiveDataProvider;
use backend\models\Otchetfiz;

/**
 * OtchetfizSearch represents the model behind the search form of `backend\models\Otchetfiz`.
 */
class OtchetfizSearch extends Otchetfiz
{
    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['id', 'flag'], 'integer'],
            [['number_book', 'full_name', 'birth_date', 'name', 'kn', 'adr_txt', 'name1', 'name2', 'name3', 'fl', 'status', 'comment', 'date', 'username', 'filename', 'date_update', 'date_load'], 'safe'],
            [['cost'], 'number'],
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
        $query = Otchetfiz::find();

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
            'birth_date' => $this->birth_date,
            'date' => $this->date,
            'flag' => $this->flag,
            'date_update' => $this->date_update,
            'date_load' => $this->date_load,
            'cost' => $this->cost,
        ]);

        $query->andFilterWhere(['like', 'number_book', $this->number_book])
            ->andFilterWhere(['like', 'full_name', $this->full_name])
            ->andFilterWhere(['like', 'name', $this->name])
            ->andFilterWhere(['like', 'kn', $this->kn])
            ->andFilterWhere(['like', 'adr_txt', $this->adr_txt])
            ->andFilterWhere(['like', 'name1', $this->name1])
            ->andFilterWhere(['like', 'name2', $this->name2])
            ->andFilterWhere(['like', 'name3', $this->name3])
            ->andFilterWhere(['like', 'fl', $this->fl])
            ->andFilterWhere(['like', 'status', $this->status])
            ->andFilterWhere(['like', 'comment', $this->comment])
            ->andFilterWhere(['like', 'username', $this->username])
            ->andFilterWhere(['like', 'filename', $this->filename]);

        return $dataProvider;
    }
}
