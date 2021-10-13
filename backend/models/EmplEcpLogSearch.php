<?php

namespace backend\models;

use Yii;
use yii\base\Model;
use yii\data\ActiveDataProvider;
use backend\models\EmplEcpLog;

/**
 * EmplEcpLogSearch represents the model behind the search form about `backend\models\EmplEcpLog`.
 */
class EmplEcpLogSearch extends EmplEcpLog
{
	public $fullName, $Statustxt, $otdels;

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['id', 'idm_empl', 'status', 'nositel_type'], 'integer'],
            [[ 'ecp_org_id', 'nositel_num', 'date_in', 'req_date', 'ecpmodify_date', 'user_in', 'comment_ecp', 'fullName', 'invent_num', 'Statustxt', 'otdels', 'empl_ecp_id', 'username'], 'safe'],
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
		$query = EmplEcpLog::find();
		$query->joinWith(['statusStatus', 'ecporgsEcporg', 'otdelsOtdel']);

        $dataProvider = new ActiveDataProvider([
            'query' => $query,
			'sort' => ['defaultOrder' => ['ecpmodify_date' => SORT_DESC]],
        ]);

        $this->load($params);

        if (!$this->validate()) {
            // uncomment the following line if you do not want to return any records when validation fails
            // $query->where('0=1');
            return $dataProvider;
        }

        $query->where('empl_ecp_id=\'' . $params["ecpid"] . '\'')->orderBy(['ecpmodify_date' => SORT_DESC]);

        $query->andFilterWhere([
            'id' => $this->id,
            'idm_empl' => $this->idm_empl,
            'ecp_start' => $this->ecp_start,
            'ecp_stop' => $this->ecp_stop,
            'status' => $this->status,
            'nositel_type' => $this->nositel_type,
            'date_in' => $this->date_in,
            'req_date' => $this->req_date,
            'ecpmodify_date' => $this->ecpmodify_date,
        ]);

		$pieces = explode(" ", $this->fullName);

		if(empty($pieces[0])){$fam='';} else{$fam  = trim($pieces[0]);}
		if(empty($pieces[1])){$name='';}else{$name = trim($pieces[1]);}
		if(empty($pieces[2])){$otch='';}else{$otch = trim($pieces[2]);}

        $query->andFilterWhere(['like', 'nositel_num', $this->nositel_num])
            ->andFilterWhere(['like', 'user_in', $this->user_in])
            //->andFilterWhere(['like', 'empl_ecp_id', $this->empl_ecp_id])
            ->andFilterWhere(['like', 'comment_ecp', $this->comment_ecp])
			->andFilterWhere(['like', 'invent_num', $this->invent_num])
			->andFilterWhere(['and', ['like', 'fam', $fam], ['like', 'name', $name], ['like', 'otch', $otch]])
			->andFilterWhere(['like', 'empl_ecp_status.text', $this->Statustxt])
			->andFilterWhere(['like', 'ecp_org.text', $this->ecp_org_id])
			->andFilterWhere(['like', 'username', $this->username])
			->andFilterWhere(['like', 'otdel.text', $this->otdels]);

        return $dataProvider;
    }
}
