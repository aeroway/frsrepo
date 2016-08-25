<?php

namespace backend\models;

use Yii;
use yii\base\Model;
use yii\data\ActiveDataProvider;
use backend\models\Otchet;

/**
 * OtchetSearch represents the model behind the search form about `backend\models\Otchet`.
 */
class OtchetSearch extends Otchet
{
    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['id', 'id_dpt', 'id_egrp'], 'integer'],
            [['kn', 'description', 'status', 'comment', 'date', 'username', 'area', 'flag', 'filename', 'date_update', 'date_load'], 'safe'],
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
        $query = Otchet::find();

        $dataProvider = new ActiveDataProvider([
            'query' => $query,
        ]);

        $this->load($params);

        if (!$this->validate()) {
            // uncomment the following line if you do not want to return any records when validation fails
            // $query->where('0=1');
            return $dataProvider;
        }

        $query->andFilterWhere([
            'id' => $this->id,
            'date' => $this->date,
			'date_update' => $this->date_update,
			'date_load' => $this->date_load,
        ]);

        $query->andFilterWhere(['like', 'kn', $this->kn])
            ->andFilterWhere(['like', 'description', $this->description])
            ->andFilterWhere(['like', 'status', $this->status])
            ->andFilterWhere(['like', 'comment', $this->comment])
			->andFilterWhere(['like', 'area', $this->area])
			->andFilterWhere(['like', 'flag', $this->flag])
			->andFilterWhere(['like', 'filename', $this->filename])
			->andFilterWhere(['like', 'id_dpt', $this->id_dpt])
			->andFilterWhere(['like', 'id_egrp', $this->id_egrp])
            ->andFilterWhere(['like', 'username', $this->username]);

        return $dataProvider;
    }
}
