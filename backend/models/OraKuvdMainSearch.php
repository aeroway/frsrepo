<?php

namespace backend\models;

use Yii;
use yii\base\Model;
use yii\data\ActiveDataProvider;
use backend\models\OraKuvdMain;

/**
 * OraKuvdMainSearch represents the model behind the search form about `backend\models\OraKuvdMain`.
 */
class OraKuvdMainSearch extends OraKuvdMain
{
    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['id', 'is_top', 'kuvd_id'], 'integer'],
            [['otdel', 'fio', 'kuvd', 'date_receipt', 'version', 'date_version', 'status', 'date_issue', 'date_load'], 'safe'],
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
        $query = OraKuvdMain::find();

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
            'date_receipt' => $this->date_receipt,
            'is_top' => $this->is_top,
            'date_version' => $this->date_version,
            'date_issue' => $this->date_issue,
            'kuvd_id' => $this->kuvd_id,
            'date_load' => $this->date_load,
        ]);

        $query->andFilterWhere(['like', 'otdel', $this->otdel])
            ->andFilterWhere(['like', 'fio', $this->fio])
            ->andFilterWhere(['like', 'kuvd', $this->kuvd])
            ->andFilterWhere(['like', 'version', $this->version])
            ->andFilterWhere(['like', 'status', $this->status]);

        return $dataProvider;
    }
}
