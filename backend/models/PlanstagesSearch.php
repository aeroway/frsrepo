<?php

namespace backend\models;

use Yii;
use yii\base\Model;
use yii\data\ActiveDataProvider;
use backend\models\Planstages;

/**
 * PlanstagesSearch represents the model behind the search form of `backend\models\Planstages`.
 */
class PlanstagesSearch extends Planstages
{
    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['id', 'ptask_id'], 'integer'],
            [['name', 'executor'], 'safe'],
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
        $query = Planstages::find();

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

        if(!empty($_GET['id']))
            $this->ptask_id = $_GET['id'];

        // grid filtering conditions
        $query->andFilterWhere([
            'id' => $this->id,
            'ptask_id' => $this->ptask_id,
        ]);

        $query->andFilterWhere(['like', 'name', $this->name])
            ->andFilterWhere(['like', 'executor', $this->executor]);

        return $dataProvider;
    }
}
