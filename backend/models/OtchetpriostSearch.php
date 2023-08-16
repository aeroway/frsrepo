<?php

namespace backend\models;

use Yii;
use yii\base\Model;
use yii\data\ActiveDataProvider;
use backend\models\Otchetpriost;

/**
 * OtchetpriostSearch represents the model behind the search form about `backend\models\Otchetpriost`.
 */
class OtchetpriostSearch extends Otchetpriost
{
    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['id'], 'integer'],
            [['status', 'area_id', 'description', 'offer', 'comment', 'kuvd', 'flag', 'filename', 'date_update', 'date_load', 'username', 'executor', 'urd', 'date_suspend', 'mark_id'], 'safe'],
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
        $query = Otchetpriost::find();

        $dataProvider = new ActiveDataProvider([
            'query' => $query,
            'sort'=> ['defaultOrder' => ['date' => SORT_DESC]]
        ]);

        $this->load($params);

        if (!$this->validate()) {
            // uncomment the following line if you do not want to return any records when validation fails
            // $query->where('0=1');
            return $dataProvider;
        }

        $query->joinWith('area a');
        $query->joinWith('mark m');
        // $query->joinWith('suspensionArticles s');

        $dateSuspend = empty($this->date_suspend) ? '' :  Yii::$app->formatter->asDate($this->date_suspend, 'yyyy-MM-dd');

        $query->andFilterWhere([
            'id' => $this->id,
            'date_update' => $this->date_update,
            'date_load' => $this->date_load,
            'status' => $this->status,
            'date_suspend' => $dateSuspend,
            'a.name' => $this->area_id,
        ]);

        $query->andFilterWhere(['like', 'm.name', $this->mark_id])
            // ->andFilterWhere(['like', 's.name', $this->suspensionId])
            ->andFilterWhere(['like', 'description', $this->description])
            ->andFilterWhere(['like', 'offer', $this->offer])
            ->andFilterWhere(['like', 'urd', $this->urd])
            ->andFilterWhere(['like', 'comment', $this->comment])
            ->andFilterWhere(['like', 'flag', $this->flag])
            ->andFilterWhere(['like', 'filename', $this->filename])
            ->andFilterWhere(['like', 'username', $this->username])
            ->andFilterWhere(['like', 'executor', $this->executor])
            ->andFilterWhere(['like', 'kuvd', $this->kuvd]);

        return $dataProvider;
    }
}
