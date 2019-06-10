<?php

namespace backend\models;

use Yii;
use yii\base\Model;
use yii\data\ActiveDataProvider;
use backend\models\EmplEcp;
use backend\models\Employee;

/**
 * EmplEcpSearch represents the model behind the search form about `backend\models\EmplEcp`.
 */
class EmplEcpSearch extends EmplEcp
{
	public $fullName, $Statustxt, $otdels;

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['id', 'idm_empl', 'status', 'nositel_type'], 'integer'],
            [[ 'ecp_org_id', /*'ecp_start', 'ecp_stop',*/ 'nositel_num', 'date_in', 'req_date', 'ecpmodify_date', 'user_in', 'comment_ecp', 'fullName', 'invent_num', 'Statustxt', 'otdels'], 'safe'],
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
		$query = EmplEcp::find();
		$query->joinWith(['statusStatus', 'ecporgsEcporg', 'otdelsOtdel']);

        $dataProvider = new ActiveDataProvider([
            'query' => $query,
			//'sort'=> ['defaultOrder' => ['id'=>SORT_DESC]]
        ]);

		$dataProvider->setSort([
			'attributes' => [
				'id',
				'fullName' => [
					'asc' => ['fam' => SORT_ASC, 'name' => SORT_ASC, 'otch' => SORT_ASC],
					'desc' => ['fam' => SORT_DESC, 'name' => SORT_DESC, 'otch' => SORT_DESC],
					'label' => 'Full Name',
					'default' => SORT_ASC
				],
				'otdels' => [
					'asc' => ['idm_otdel' => SORT_ASC],
					'desc' => ['idm_otdel' => SORT_DESC],
					'label' => 'Отдел',
					'default' => SORT_ASC
				],
				'ecpmodify_date' => [
					'asc' => ['ecpmodify_date' => SORT_ASC],
					'desc' => ['ecpmodify_date' => SORT_DESC],
					'label' => 'Модификация',
					'default' => SORT_ASC
				],
				'invent_num' => [
					'asc' => ['invent_num' => SORT_ASC],
					'desc' => ['invent_num' => SORT_DESC],
					'label' => 'Инвент. номер',
					'default' => SORT_ASC
				],
				'comment_ecp' => [
					'asc' => ['comment_ecp' => SORT_ASC],
					'desc' => ['comment_ecp' => SORT_DESC],
					'label' => 'Комментарий',
					'default' => SORT_ASC
				],
				'ecp_stop' => [
					'asc' => ['ecp_stop' => SORT_ASC],
					'desc' => ['ecp_stop' => SORT_DESC],
					'label' => 'Окончание',
					'default' => SORT_ASC
				],
			]
		]);

        $this->load($params);

        if (!$this->validate()) {
            // uncomment the following line if you do not want to return any records when validation fails
            // $query->where('0=1');
            return $dataProvider;
        }

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

	/* может кому пригодится
	'SELECT fam, employee.name, otch, doljn.name as doljnost, otdel.text as otdels, ecp_org.text as EcpOrgName, ecp_start, ecp_stop, nositel_num, invent_num, empl_ecp_status.text as Statustxt ' . 
	'FROM empl_ecp ' .
	'INNER JOIN employee ON (empl_ecp.idm_empl = employee.id) ' .
	'INNER JOIN ecp_org ON (empl_ecp.ecp_org_id = ecp_org.id) ' .
	'INNER JOIN doljn ON (employee.idm_doljn = doljn.id) ' .
	'INNER JOIN otdel ON (employee.idm_otdel = otdel.id) ' .
	'INNER JOIN empl_ecp_status ON (empl_ecp.status = empl_ecp_status.id) '
	*/

		if(empty($pieces[0])){$fam='';} else{$fam  = trim($pieces[0]);}
		if(empty($pieces[1])){$name='';}else{$name = trim($pieces[1]);}
		if(empty($pieces[2])){$otch='';}else{$otch = trim($pieces[2]);}

        $query->andFilterWhere(['like', 'nositel_num', $this->nositel_num])
            ->andFilterWhere(['like', 'user_in', $this->user_in])
            ->andFilterWhere(['like', 'comment_ecp', $this->comment_ecp])
			->andFilterWhere(['like', 'invent_num', $this->invent_num])
			->andFilterWhere(['and', ['like', 'fam', $fam], ['like', 'name', $name], ['like', 'otch', $otch]])
			->andFilterWhere(['like', 'empl_ecp_status.text', $this->Statustxt])
			->andFilterWhere(['like', 'ecp_org.text', $this->ecp_org_id])
			->andFilterWhere(['like', 'otdel.text', $this->otdels]);

        return $dataProvider;
    }
}
