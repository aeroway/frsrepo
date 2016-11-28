<?php

namespace backend\models;

use Yii;
use yii\base\Model;
use yii\data\ActiveDataProvider;
use backend\models\Otchett;

/**
 * OtchettSearch represents the model behind the search form about `backend\models\Otchett`.
 */
class OtchetstatSearch extends Otchett
{
    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['id', 'id_dpt', 'id_egrp'], 'integer'],
            [['kn', 'description', 'status', 'comment', 'date', 'username', 'area', 'flag', 'filename', 'date_update', 'date_load'], 'safe'],
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
        $query = Otchett::find();

        $dataProvider = new ActiveDataProvider([
            'query' => $query,
            'sort'=> ['defaultOrder' => ['kn' => SORT_ASC, 'date'=>SORT_DESC]]
        ]);

        $this->load($params);

        if (!$this->validate()) {
            // uncomment the following line if you do not want to return any records when validation fails
            // $query->where('0=1');
            return $dataProvider;
        }

        $query->andFilterWhere([
            'id' => $this->id,
            //'date' => $this->date,
            'date_update' => $this->date_update,
            'date_load' => $this->date_load,
            'status' => 'в работе',
        ]);

        $datec = date_create($this->date);
        $dateo = date_create(date('Y-m-d'));

        if ($this->date) 
        {
            $date5 = date_create($this->date);
            $date15 = date_create($this->date);
            $date30 = date_create($this->date);

            date_add($date5, date_interval_create_from_date_string('5 days'));
            date_add($date15, date_interval_create_from_date_string('15 days'));
            date_add($date30, date_interval_create_from_date_string('30 days'));

            //echo date_format($datec, 'Y-m-d');
            //echo '<br>';
            //echo date_format($dateo, 'Y-m-d 23:59:59');
            //die();

            if (date_format($dateo, 'Y-m-d') == date_format($date5, 'Y-m-d'))
            {
                $date = date_format($datec, 'Y-m-d H:i:s');
                $date2 = date_format($dateo, 'Y-m-d 23:59:59');
            }
            elseif(date_format($dateo, 'Y-m-d') == date_format($date15, 'Y-m-d'))
            {
                $date = date_format($datec, 'Y-m-d H:i:s');
                date_add($datec, date_interval_create_from_date_string('10 days'));
                $date2 = date_format($datec, 'Y-m-d H:i:s');
            }
            elseif(date_format($dateo, 'Y-m-d') == date_format($date30, 'Y-m-d'))
            {
                $date = '';
                date_add($datec, date_interval_create_from_date_string('15 days'));
                $date2 = date_format($datec, 'Y-m-d H:i:s');
            }
            else
            {
                $date = date_format($datec, 'Y-m-d H:i:s');
                $date2 = date_format($dateo, 'Y-m-d 23:59:59');
            }
        } else 
        {
             $date = '';
             $date2 = '';
        }

        $query->andFilterWhere(['like', 'kn', $this->kn])
            ->andFilterWhere(['like', 'description', $this->description])
            //->andFilterWhere(['>=', 'date', $date])
            ->andFilterWhere(['and', ['>=', 'date', $date], ['<=', 'date', $date2]])
            //->andFilterWhere(['like', 'status', $this->status])
            ->andFilterWhere(['like', 'comment', $this->comment])
            ->andFilterWhere(['like', 'area', $this->area])
            ->andFilterWhere(['like', 'flag', $this->flag])
            ->andFilterWhere(['like', 'id_dpt', $this->id_dpt])
            ->andFilterWhere(['like', 'filename', $this->filename])
            ->andFilterWhere(['like', 'id_egrp', $this->id_egrp])
            ->andFilterWhere(['like', 'username', $this->username]);

        return $dataProvider;
    }
}
