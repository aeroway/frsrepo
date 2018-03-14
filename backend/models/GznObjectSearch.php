<?php

namespace backend\models;

use Yii;
use yii\base\Model;
use yii\data\ActiveDataProvider;
use backend\models\GznObject;
use yii\web\ForbiddenHttpException;

/**
 * GznObjectSearch represents the model behind the search form about `backend\models\GznObject`.
 */
class GznObjectSearch extends GznObject
{
    public $areaOtchetName;
    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['id', 'land_num', 'success', 'checklist'], 'integer'],
            [['authoritie_check', 'kn', 'kn_cost', 'order_check', 'act_check', 'date_enforcement', 'land_category', 'requisites_land_user', 'address_land_plot', 'type_func_use', 'description_violation', 'full_name_inspector', 'gzn_type_check_id', 'area_id', 'areaOtchetName'], 'safe'],
            [['land_area'], 'number'],
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
        $booleanCheck = false;
        $countGroup = 0;

        foreach(Yii::$app->user->identity->groups as $value) {
            $pos = strpos($value, 'отдел gzn');

            if($pos !== FALSE) {
                $booleanCheck = true;
                $countGroup++;
                $idArea = AreaOtchet::find('id')->where(["name" => substr($value, 0, $pos + 10)])->one()["id"];

                if($idArea == 100) {
                    $query = GznObject::find()->alias('c');
                } else {
                    $query = GznObject::find()->where(["area_id" => $idArea])->alias('c');
                }
            }
        }

        if($countGroup > 1) {
            throw new ForbiddenHttpException('Вы не можете получить доступ к этой странице, т.к. состоите более, чем двух районах одновременно.');
        }

        if(!$booleanCheck) {
            $query = GznObject::find()->alias('c');
        }

        // add conditions that should always apply here

        $dataProvider = new ActiveDataProvider([
            'query' => $query,
        ]);

		$dataProvider->setSort([
			'attributes' => [
				'gzn_type_check_id',
				'authoritie_check',
				'kn' => [
					'asc' => ['c.kn' => SORT_ASC],
					'desc' => ['c.kn' => SORT_DESC],
					'default' => SORT_ASC
				],
				'act_check',
				'address_land_plot',
				'full_name_inspector',
				'success',
				'checklist',
				'areaOtchetName' => [
					'asc' => ['b.name' => SORT_ASC],
					'desc' => ['b.name' => SORT_DESC],
					'label' => 'Отдел',
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

        $query->joinWith('gznTypeCheck a');
        $query->joinWith('areaOtchet b');

        // grid filtering conditions
        $query->andFilterWhere([
            'id' => $this->id,
            'land_num' => $this->land_num,
            'success' => $this->success,
            'checklist' => $this->checklist,
            'authoritie_check' => $this->authoritie_check,
            'land_area' => $this->land_area,
            'date_enforcement' => $this->date_enforcement,
            'a.name' => $this->gzn_type_check_id,
            'area_id' => $this->area_id,
        ]);

        $query->andFilterWhere(['like', 'c.kn', $this->kn])
            ->andFilterWhere(['like', 'kn_cost', $this->kn_cost])
            ->andFilterWhere(['like', 'order_check', $this->order_check])
            ->andFilterWhere(['like', 'act_check', $this->act_check])
            ->andFilterWhere(['like', 'land_category', $this->land_category])
            ->andFilterWhere(['like', 'requisites_land_user', $this->requisites_land_user])
            ->andFilterWhere(['like', 'address_land_plot', $this->address_land_plot])
            ->andFilterWhere(['like', 'type_func_use', $this->type_func_use])
            ->andFilterWhere(['like', 'description_violation', $this->description_violation])
            ->andFilterWhere(['like', 'b.name', $this->areaOtchetName])
            ->andFilterWhere(['like', 'full_name_inspector', $this->full_name_inspector]);

        return $dataProvider;
    }
}
