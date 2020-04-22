<?php

namespace backend\models;

use Yii;
use yii\base\Model;
use yii\data\ActiveDataProvider;
use backend\models\Otchett;

/**
 * OtchettSearch represents the model behind the search form about `backend\models\Otchett`.
 */
class OtchettSearch extends Otchett
{
    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['id', 'id_dpt', 'id_egrp'], 'integer'],
            [['kn', 'description', 'status', 'comment', 'date', 'username', 'area', 'flag', 'filename', 'date_update', 'date_load', 'protocol'], 'safe'],
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

        if (Otchett::$name == 'otchet39' || Otchett::$name == 'otchet9') {
            $dataProvider = new ActiveDataProvider([
                'query' => $query,
                'sort'=> ['defaultOrder' => ['description' => SORT_ASC, 'area' => SORT_ASC]]
            ]);
        }
        else {
            $dataProvider = new ActiveDataProvider([
                'query' => $query,
                'sort'=> ['defaultOrder' => ['kn' => SORT_DESC, 'area' => SORT_ASC]]
            ]);
        }

        $this->load($params);

        if (!$this->validate()) {
            // uncomment the following line if you do not want to return any records when validation fails
            // $query->where('0=1');
            return $dataProvider;
        }

        $query->andFilterWhere([
            'id' => $this->id,
            'date' => $this->date,
            'date_update' => $this->date_update,
            'date_load' => $this->date_load,
            'status' => $this->status,
        ]);

        //$query->andFilterWhere(['like', 'kn', str_replace ( "\\\\\\\\", "\\", $this->kn )])
        $query->andFilterWhere(['like', 'kn', $this->kn])
            ->andFilterWhere(['like', 'description', $this->description])
            ->andFilterWhere(['like', 'comment', $this->comment])
            ->andFilterWhere(['like', 'area', $this->area])
            ->andFilterWhere(['like', 'flag', $this->flag])
            ->andFilterWhere(['like', 'id_dpt', $this->id_dpt])
            ->andFilterWhere(['like', 'filename', $this->filename])
            ->andFilterWhere(['like', 'id_egrp', $this->id_egrp])
            ->andFilterWhere(['like', 'username', $this->username])
            ->andFilterWhere(['like', 'protocol', $this->protocol]);

        return $dataProvider;
    }
}
