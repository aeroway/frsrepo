<?php

namespace backend\models;

use Yii;
use yii\base\Model;
use yii\data\ActiveDataProvider;
use backend\models\GznViolations;

/**
 * GznViolationsSearch represents the model behind the search form about `backend\models\GznViolations`.
 */
class GznViolationsSearch extends GznViolations
{
    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['id'], 'integer'],
            [['decision_punishment', 'date_due', 'note', 'payment_doc', 'place_proceeding', 'date_check', 'adm_affairs', 'decision_cancellation', 'decision_appeal', 'gzn_obj_id', 'date_outgoing',
              'date_performance', 'violation_decision_end', 'violation_protocol', 'adm_punishment_id', 'types_punishment_id'], 'safe'],
            [['amount_fine', 'amount_fine_collected', 'violation_area'], 'number'],
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
        if(!empty($_GET['id']))
            $query = GznViolations::find()->where(['gzn_obj_id' => $_GET['id']]);
        else
            $query = GznViolations::find();

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

        //$query->joinWith('gznObj.landUserCategory');
        $query->joinWith('admPunishment');

        // grid filtering conditions
        $query->andFilterWhere([
            'id' => $this->id,
            'date_due' => $this->date_due,
            'amount_fine' => $this->amount_fine,
            'amount_fine_collected' => $this->amount_fine_collected,
            'date_outgoing' => $this->date_outgoing,
            'violation_area' => $this->violation_area,
            'date_performance' => $this->date_performance,
            'gzn_obj_id' => $this->gzn_obj_id,
        ]);

        $query->andFilterWhere(['like', 'decision_punishment', $this->decision_punishment])
            ->andFilterWhere(['like', 'note', $this->note])
            ->andFilterWhere(['like', 'payment_doc', $this->payment_doc])
            ->andFilterWhere(['like', 'place_proceeding', $this->place_proceeding])
            ->andFilterWhere(['like', 'date_check', $this->date_check])
            ->andFilterWhere(['like', 'adm_affairs', $this->adm_affairs])
            ->andFilterWhere(['like', 'decision_cancellation', $this->decision_cancellation])
            ->andFilterWhere(['like', 'decision_appeal', $this->decision_appeal])
            ->andFilterWhere(['like', 'name', $this->adm_punishment_id])
            ->andFilterWhere(['like', 'types_punishment_id', $this->types_punishment_id])
            ->andFilterWhere(['like', 'violation_decision_end', $this->violation_decision_end])
            ->andFilterWhere(['like', 'violation_protocol', $this->violation_protocol]);

        return $dataProvider;
    }
}
