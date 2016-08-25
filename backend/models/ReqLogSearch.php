<?php

namespace backend\models;

use Yii;
use yii\base\Model;
use yii\data\ActiveDataProvider;
use backend\models\ReqLog;

/**
 * ReqLogSearch represents the model behind the search form about `backend\models\ReqLog`.
 */
class ReqLogSearch extends ReqLog
{
	public $findOrg, $fullAddress;
    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['id', 'obj_id', 'kuvd_id', 'status', 'type', 'otdel', 'cel', 'fast', 'vedomost_num', 'vedomost_unform', 'area_id'], 'integer'],
            [['obj_addr', 'zayavitel_num', 'zayavitel_fio', 'kuvd', 'user_text',   'user_to', 'kn', 'coment', 'cur_user', 'date_end', 'phone', 'user_last', 'srok', 'user_print', 'print_date', 'code_mesto', 'date_v', 'org', 'inn', 'findOrg', 'fullAddress'], 'safe'],
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
		if(in_array("alvl1", Yii::$app->user->identity->groups))
		{
			$query = ReqLog::find()->where(['user_text'=>'23UPR\\'.Yii::$app->user->identity->username]);
		}
		else
		{
			$query = ReqLog::find();
		}

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

		$query->where('log_id=\''.$params["logid"].'\'');

        $query->andFilterWhere([
            'id' => $this->id,
            'obj_id' => $this->obj_id,
            'kuvd_id' => $this->kuvd_id,
            'status' => $this->status,
            //'date_in' => $this->date_in,
            'type' => $this->type,
            'otdel' => $this->otdel,
            'cel' => $this->cel,
            'date_end' => $this->date_end,
            'fast' => $this->fast,
            'vedomost_num' => $this->vedomost_num,
            'vedomost_unform' => $this->vedomost_unform,
            'srok' => $this->srok,
            'print_date' => $this->print_date,
            'date_v' => $this->date_v,
            'area_id' => $this->area_id,
        ]);

        $query->andFilterWhere(['like', 'obj_addr', $this->obj_addr])
            ->andFilterWhere(['like', 'zayavitel_num', $this->zayavitel_num])
            ->andFilterWhere(['like', 'zayavitel_fio', $this->zayavitel_fio])
            ->andFilterWhere(['like', 'kuvd', $this->kuvd])
            ->andFilterWhere(['like', 'user_text', $this->user_text])
            ->andFilterWhere(['like', 'user_to', $this->user_to])
            ->andFilterWhere(['like', 'kn', $this->kn])
            ->andFilterWhere(['like', 'coment', $this->coment])
            ->andFilterWhere(['like', 'cur_user', $this->cur_user])
            ->andFilterWhere(['like', 'phone', $this->phone])
            ->andFilterWhere(['like', 'user_last', $this->user_last])
            ->andFilterWhere(['like', 'user_print', $this->user_print])
            ->andFilterWhere(['like', 'code_mesto', $this->code_mesto])
            ->andFilterWhere(['like', 'org', $this->org])
            ->andFilterWhere(['like', 'inn', $this->inn])
			->andFilterWhere(['or',	['like', 'zayavitel_fio', $this->findOrg], ['like', 'org', $this->findOrg]])
			->andFilterWhere(['like', 'obj_addr', $this->fullAddress]);

        return $dataProvider;
    }
}
