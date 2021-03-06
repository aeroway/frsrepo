<?php

namespace backend\models;

use Yii;
use yii\base\Model;
use yii\data\ActiveDataProvider;
use backend\models\Req;
use yii\web\ForbiddenHttpException;

/**
 * ReqSearch represents the model behind the search form about `backend\models\Req`.
 */
class ReqSearch extends Req
{
    public $findOrg, $fullAddress, $iconStatus, $data1, $data2;
    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['id', 'obj_id', 'kuvd_id', 'status', 'type', 'otdel', 'cel', 'fast', 'vedomost_num', 'vedomost_unform', 'area_id'], 'integer'],
            [['obj_addr', 'zayavitel_num', 'zayavitel_fio', 'kuvd', 'user_text',   'user_to', 'kn', 'coment', 'cur_user', 'date_end', 'phone', 'user_last',
                'srok', 'user_print', 'print_date', 'code_mesto', 'date_v', 'org', 'inn', 'findOrg', 'fullAddress', 'iconStatus', 'date_in'], 'safe'],
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
        $query = Req::find();

        if (in_array("alvl1", Yii::$app->user->identity->groups)) {
            $query = Req::find()
                ->where(['or',
                    ['user_text' => Yii::$app->user->identity->username],
                    ['user_text' => '23UPR\\' . Yii::$app->user->identity->username],
                    ['user_text' => '23UPRS\\' . Yii::$app->user->identity->username]
                ]);

            if ($this->isFkpUser()) {
                $query = Req::find()->where(['or', ['like', 'user_text', 'user'], ['=', 'user_text', 'Сайт']]);
            }

        }

        if (in_array("alvl2", Yii::$app->user->identity->groups) || in_array("alvl3", Yii::$app->user->identity->groups) || in_array("alvl4", Yii::$app->user->identity->groups)) {
            if ($this->isFkpUser()) {
                $query = Req::find()->where(['or', ['like', 'user_text', 'user'], ['=', 'user_text', 'Сайт']]);
            } else {
                $query = Req::find();
            }
        }

        $dataProvider = new ActiveDataProvider([
            'query' => $query,
            'sort'=> ['defaultOrder' => ['id' => SORT_DESC]]
        ]);

        $this->load($params);

        if (!$this->validate()) {
            // uncomment the following line if you do not want to return any records when validation fails
            // $query->where('0=1');
            return $dataProvider;
        }

        if(!isset($this->status)) {
            $this->status = 1;
        }

        $query->andFilterWhere([
            'id' => $this->id,
            'obj_id' => $this->obj_id,
            'kuvd_id' => $this->kuvd_id,
            'status' => $this->status,
            //'date_in' => $this->date_in,
            'type' => $this->type,
            'otdel' => $this->otdel,
            'cel' => $this->cel,
            'date_end' => $this->date_end,
            'fast' => $this->fast,
            'vedomost_num' => $this->vedomost_num,
            'vedomost_unform' => $this->vedomost_unform,
            'srok' => $this->srok,
            'print_date' => $this->print_date,
            'date_v' => $this->date_v,
            'area_id' => $this->area_id,
        ]);

        if(isset($this->date_in) and !empty($this->date_in)) {
            $this->data1 = date('Y-m-d', strtotime($this->date_in));
            $this->data2 = date('Y-m-d', strtotime('+1 day', strtotime($this->date_in)));
        }

        $query->andFilterWhere(['like', 'obj_addr', $this->obj_addr])
            ->andFilterWhere(['like', 'zayavitel_num', $this->zayavitel_num])
            ->andFilterWhere(['like', 'zayavitel_fio', $this->zayavitel_fio])
            ->andFilterWhere(['like', 'kuvd', $this->kuvd])
            ->andFilterWhere(['like', 'user_text', $this->user_text])
            ->andFilterWhere(['like', 'user_to', $this->user_to])
            ->andFilterWhere(['like', 'kn', $this->kn])
            ->andFilterWhere(['like', 'coment', $this->coment])
            ->andFilterWhere(['like', 'cur_user', $this->cur_user])
            ->andFilterWhere(['like', 'phone', $this->phone])
            ->andFilterWhere(['like', 'user_last', $this->user_last])
            ->andFilterWhere(['like', 'user_print', $this->user_print])
            ->andFilterWhere(['like', 'code_mesto', $this->code_mesto])
            ->andFilterWhere(['like', 'org', $this->org])
            ->andFilterWhere(['like', 'inn', $this->inn])
            ->andFilterWhere(['and', ['>=', 'date_in', $this->data1], ['<=', 'date_in', $this->data2]])
            ->andFilterWhere(['or', ['like', 'zayavitel_fio', $this->findOrg], ['like', 'org', $this->findOrg]])
            ->andFilterWhere(['like', 'obj_addr', $this->fullAddress]);

        return $dataProvider;
    }

    public function isFkpUser()
    {
        $searchString = 'user';

        if(preg_match("/{$searchString}/i", Yii::$app->user->identity->username)) {
            return true;
        } else {
            return false;
        }
    }
}