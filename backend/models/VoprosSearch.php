<?php

namespace backend\models;

use yii\base\Model;
use yii\data\ActiveDataProvider;
use backend\models\Vopros;

/**
 * VoprosSearch represents the model behind the search form of `backend\models\Vopros`.
 */
class VoprosSearch extends Vopros
{
    public $cnt;

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['id', 'otdel_id', 'nv', 'cnt'], 'integer'],
            [['text'], 'safe'],
        ];
    }

    /**
     * {@inheritdoc}
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
        if (!empty($params["id"]) && $params["id"] > 0) {
            $query = Vopros::find()
            ->select(['vopros.id, vopros.text, COUNT(vopros_id) AS cnt'])
            ->joinWith('otvet')
            ->where(['otdel_id' => $params["id"]])
            ->groupBy(['vopros.id', 'vopros.text']);
        } else {
            $query = Vopros::find()
            ->select(['otdel.id, otdel.text, otdel_id, COUNT(otdel_id) AS cnt'])
            ->rightJoin('otdel', 'vopros.otdel_id = otdel.id')
            ->where(['OR', ['IS NOT', 'vopros.text', NULL], ['IS', 'otdel.ind', NULL]])
            ->groupBy(['otdel.id', 'otdel.text', 'otdel_id'])
            ->orderBy(['otdel.text' => SORT_ASC]);
        }

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
            'otdel_id' => $this->otdel_id,
            'nv' => $this->nv,
            'cnt' => $this->cnt,
        ]);

        $query->andFilterWhere(['like', 'text', $this->text]);

        return $dataProvider;
    }
}
