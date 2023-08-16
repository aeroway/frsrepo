<?php

namespace backend\models;

use yii\base\Model;
use yii\data\ActiveDataProvider;
use backend\models\SgrMembers;

/**
 * SgrMembersSearch represents the model behind the search form of `backend\models\SgrMembers`.
 */
class SgrMembersSearch extends SgrMembers
{
    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['id'], 'integer'],
            [['fio', 'position', 'photo', 'contact', 'status'], 'safe'],
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
        if (empty($params["pr"])) {
            $query = SgrMembers::find()->where(['or', ['ilike', 'status', 'председатель'], ['ilike', 'status', 'секретарь']]);
        } else {
            if ($params["pr"] == 1) {
                $query = SgrMembers::find()->where(['ilike', 'status', 'член рабочей группы']);
            }

            if ($params["pr"] == 2) {
                $query = SgrMembers::find()->where(['ilike', 'status', 'член Совета']);
            }

            if ($params["pr"] == 3) {
                $query = SgrMembers::find();
            }
        }

        // add conditions that should always apply here

        $dataProvider = new ActiveDataProvider([
            'query' => $query,
            'sort'=> ['defaultOrder' => ['position' => SORT_DESC]]
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
        ]);

        $query->andFilterWhere(['ilike', 'fio', $this->fio])
            ->andFilterWhere(['ilike', 'position', $this->position])
            // ->andFilterWhere(['ilike', 'contact', $this->contact])
            ->andFilterWhere(['ilike', 'status', $this->status]);
            // ->andFilterWhere(['ilike', 'photo', $this->photo]);

        return $dataProvider;
    }
}
