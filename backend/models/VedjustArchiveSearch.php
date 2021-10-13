<?php

namespace backend\models;

use yii\base\Model;
use yii\data\ActiveDataProvider;
use backend\models\VedomostCheckForm;

/**
 * VedjustArchiveSearch represents the model behind the search form of `backend\models\VedomostCheckForm`.
 */
class VedjustArchiveSearch extends VedomostCheckForm
{
    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['id', 'vedomost_num', 'vedomost_res', 'check_type', 'sektors_ip'], 'integer'],
            [['date_in', 'user_in', 'vedomost_date', 'module', 'ip', 'dt_fr'], 'safe'],
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
        $query = VedomostCheckForm::find();

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
            'date_in' => $this->date_in,
            'vedomost_num' => $this->vedomost_num,
            'vedomost_date' => $this->vedomost_date,
            'vedomost_res' => $this->vedomost_res,
            'check_type' => $this->check_type,
            'sektors_ip' => $this->sektors_ip,
            'dt_fr' => $this->dt_fr,
        ]);

        $query->andFilterWhere(['like', 'user_in', $this->user_in])
            ->andFilterWhere(['like', 'module', $this->module])
            ->andFilterWhere(['like', 'ip', $this->ip]);

        return $dataProvider;
    }
}
