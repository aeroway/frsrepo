<?php

namespace backend\models;

use yii\base\Model;
use yii\data\ActiveDataProvider;
use backend\models\XmlAnalysis;

/**
 * XmlAnalysisSearch represents the model behind the search form of `backend\models\XmlAnalysis`.
 */
class XmlAnalysisSearch extends XmlAnalysis
{
    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['kn', 'address', 'filename'], 'safe'],
            [['id'], 'integer'],
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
        $where = '1=1';

        if (empty($params['XmlAnalysisSearch']['kn']) && empty($params['XmlAnalysisSearch']['address']) && empty($params['XmlAnalysisSearch']['filename']) && empty($params['XmlAnalysisSearch']['knGroup'])) {
            $where = '0=1';
        }

        if (!empty($params['XmlAnalysisSearch']['knGroup'])) {
            $knGroupExp = explode(';', $params['XmlAnalysisSearch']['knGroup']);

            for ($i=0; $i < count($knGroupExp); $i++) {
                $knGroupExp[$i] = trim($knGroupExp[$i]);
            }

            $query = XmlAnalysis::find()->where(['IN', 'kn', $knGroupExp]);
        } else {
            $query = XmlAnalysis::find()->where($where);
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
        // $query->andFilterWhere([
        //     'id' => $this->id,
        // ]);

        $query->andFilterWhere(['=', 'kn', $this->kn])
            ->andFilterWhere(['ilike', 'address', $this->address])
            ->andFilterWhere(['=', 'filename', mb_strtolower($this->filename)]);

        return $dataProvider;
    }
}
