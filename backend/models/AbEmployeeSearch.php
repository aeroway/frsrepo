<?php

namespace backend\models;

use Yii;
use yii\base\Model;
use yii\data\ActiveDataProvider;
use backend\models\AbEmployee;

/**
 * AbEmployeeSearch represents the model behind the search form about `backend\models\AbEmployee`.
 */
class AbEmployeeSearch extends AbEmployee
{
    /**
     * @inheritdoc
     */
     
    //public $fullName; 
    public function rules()
    {
        return [
            [['id', 'act'], 'integer'],
            [['dt1', 'dt2', 'id_employee'], 'safe'],
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
        $query = AbEmployee::find();

        $dataProvider = new ActiveDataProvider([
            'query' => $query,
			'sort'=> ['defaultOrder' => ['dt2'=>SORT_ASC]]
        ]);

        $this->load($params);

        if (!$this->validate()) {
            // uncomment the following line if you do not want to return any records when validation fails
            // $query->where('0=1');
            return $dataProvider;
        }

		//$query->joinWith('idEmployee');

        $query->andFilterWhere([
            'id' => $this->id,
            //'id_employee' => $this->id_employee,
            'act' => $this->act,
            'dt1' => $this->dt1,
            'dt2' => $this->dt2,
        ]);

        if($this->id_employee)
        {
            $sql = "SELECT id FROM employee WHERE upper(fam)+' '+upper(name)+' '+upper(otch) LIKE upper('%".ltrim($this->id_employee)."%')";
            $connection = \Yii::$app->db5;
            $ids = $connection->createCommand($sql)->queryAll();
            $ids_s = '(';

            foreach($ids as $data)
            {
                $ids_s .= $data['id'] . ',';
            }

            $ids_s = substr($ids_s, 0, strlen($ids_s)-1) . ')';

            $query->andWhere('id_employee in ' . $ids_s . ' ');
        }

		$query->andFilterWhere([
			'act' => '1'
		]);

        return $dataProvider;
    }
}
