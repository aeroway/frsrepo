<?php

namespace backend\models;

use Yii;
use yii\base\Model;
use yii\data\ActiveDataProvider;
use backend\models\VedomostCheckForm;


/**
 * VedomostCheckFormSearch represents the model behind the search form about `backend\models\VedomostCheckForm`.
 */
class VedomostCheckFormSearch extends VedomostCheckForm
{
    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['id', 'vedomost_num', /*'vedomost_res',*/ 'check_type', 'sektors_ip'], 'integer'],
            [[/*'date_in',*/ 'user_in', 'vedomost_date', 'module'], 'safe'],
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
        $query = VedomostCheckForm::find();

        $dataProvider = new ActiveDataProvider([
            'query' => $query,
			'sort'=> ['defaultOrder' => ['id'=>SORT_DESC]]
        ]);

        $this->load($params);

        if (!$this->validate()) {
            // uncomment the following line if you do not want to return any records when validation fails
            // $query->where('0=1');
            return $dataProvider;
        }

        $query->andFilterWhere([
            'id' => $this->id,
            'date_in' => $this->date_in,
            'vedomost_num' => $this->vedomost_num,
            'vedomost_date' => $this->vedomost_date,
            'vedomost_res' => $this->vedomost_res,
            'check_type' => $this->check_type,
        ]);

        $query->andFilterWhere(['like', 'user_in', $this->user_in])
			->andFilterWhere(['like', 'sektors_ip', $this->sektors_ip])
            ->andFilterWhere(['like', 'module', $this->module]);

        return $dataProvider;
    }
}
