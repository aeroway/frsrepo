<?php

namespace backend\models;

use Yii;
use yii\base\Model;
use yii\data\ActiveDataProvider;
use backend\models\Otchetn;

/**
 * OtchetnSearch represents the model behind the search form about `backend\models\Otchetn`.
 */
class OtchetnstatSearch extends Otchetn
{
    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['id', 'id_dpt', 'id_egrp'], 'integer'],
            [['area', 'status', 'reason1', 'reason2', 'offer', 'comment', 'condnum', 'flag', 'filename', 'date_update', 'date_load', 'usernameon'], 'safe'],
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
        $query = Otchetn::find();

        $dataProvider = new ActiveDataProvider([
            'query' => $query,
			'sort'=> ['defaultOrder' => ['area' => SORT_ASC, 'dateon'=>SORT_DESC]]
        ]);

        $this->load($params);

        if (!$this->validate()) {
            // uncomment the following line if you do not want to return any records when validation fails
            // $query->where('0=1');
            return $dataProvider;
        }

        $query->andFilterWhere([
            'id' => $this->id,
			'date_update' => $this->date_update,
			'date_load' => $this->date_load,
			'status' => 'в работе',
        ]);

        $query->andFilterWhere(['like', 'area', $this->area])
            //->andFilterWhere(['like', 'status', $this->status])
            ->andFilterWhere(['like', 'reason1', $this->reason1])
            ->andFilterWhere(['like', 'reason2', $this->reason2])
            ->andFilterWhere(['like', 'offer', $this->offer])
            ->andFilterWhere(['like', 'comment', $this->comment])
			->andFilterWhere(['like', 'flag', $this->flag])
			->andFilterWhere(['like', 'filename', $this->filename])
			->andFilterWhere(['like', 'id_dpt', $this->id_dpt])
			->andFilterWhere(['like', 'id_egrp', $this->id_egrp])
			->andFilterWhere(['like', 'usernameon', $this->usernameon])
            ->andFilterWhere(['like', 'condnum', $this->condnum]);

        return $dataProvider;
    }
}
