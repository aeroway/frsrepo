<?php

namespace backend\models;

use Yii;
use yii\base\Model;
use yii\data\ActiveDataProvider;
use backend\models\Otchetlist;

/**
 * OtchetlistSearch represents the model behind the search form about `backend\models\Otchetlist`.
 */
class OtchetlistSearch extends Otchetlist
{
    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['id', 'status_list'], 'integer'],
            [['name_list', 'table_list', 'description_list'], 'safe'],
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
        if(Yii::$app->controller->action->id == 'stat')
        {
            $query = Otchetlist::find();
        }
        else
        {
            $query = Otchetlist::find()->where(['status_list' => '1']);
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
            'status_list' => $this->status_list,
        ]);

        $query->andFilterWhere(['like', 'name_list', $this->name_list])
            ->andFilterWhere(['like', 'table_list', $this->table_list])
            ->andFilterWhere(['like', 'description_list', $this->description_list]);

        return $dataProvider;
    }
}
