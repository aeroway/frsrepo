<?php

namespace backend\models;

use Yii;
use yii\base\Model;
use yii\data\ActiveDataProvider;
use backend\models\GznInjunction;

/**
 * GznInjunctionSearch represents the model behind the search form of `backend\models\GznInjunction`.
 */
class GznInjunctionSearch extends GznInjunction
{
    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['id', 'gzn_violations_id'], 'integer'],
            [['act_checking', 'not_done', 'repeated', 'decision_judge', 'date_protocol', 'decision_judge_j', 'disobedience', 'count_term_execution'], 'safe'],
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
        $query = GznInjunction::find()->where(['gzn_violations_id' => !empty($_GET['id']) ? $_GET['id'] : '']);

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
            'date_protocol' => $this->date_protocol,
            'gzn_violations_id' => $this->gzn_violations_id,
        ]);

        $query->andFilterWhere(['like', 'act_checking', $this->act_checking])
            ->andFilterWhere(['like', 'not_done', $this->not_done])
            ->andFilterWhere(['like', 'repeated', $this->repeated])
            ->andFilterWhere(['like', 'decision_judge', $this->decision_judge])
            ->andFilterWhere(['like', 'decision_judge_j', $this->decision_judge_j])
            ->andFilterWhere(['like', 'count_term_execution', $this->count_term_execution])
            ->andFilterWhere(['like', 'disobedience', $this->disobedience]);

        return $dataProvider;
    }
}
