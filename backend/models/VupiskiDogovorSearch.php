<?php

namespace backend\models;

use yii\base\Model;
use yii\data\ActiveDataProvider;
use backend\models\VupiskiDogovor;

/**
 * VupiskiDogovorSearch represents the model behind the search form of `backend\models\VupiskiDogovor`.
 */
class VupiskiDogovorSearch extends VupiskiDogovor
{
    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['id', 'status', 'type_d'], 'integer'],
            [['pr_name_f', 'pr_name_s', 'pr_name_l', 'pr_date_b', 'pr_mesto_b', 'pr_pol', 'pr_pasp_s', 'pr_pasp_n', 'pr_vudan', 'pr_vudan_data', 'pr_adres_reg', 'pr_kod_podrazd', 'pok_name_f', 'pok_name_s', 'pok_name_l', 'pok_date_b', 'pok_mesto_b', 'pok_pol', 'pok_pasp_s', 'pok_pasp_n', 'pok_vudan', 'pok_vudan_data', 'pok_adres_reg', 'pok_kod_podrazd', 'obj_type', 'obj_kn', 'obj_adres', 'obj_square', 'obj_square_l', 'obj_cnt_room', 'obj_floor', 'obj_pod', 'dop_info', 'cena', 'doc_osn', 'date_doc_osn', 'zapis_v_egrp', 'date_zapis_v_egrp', 'svid', 'date_svid', '_from', 'date_in', 'istochnik', 'ip', 'time_start', 'time_end', 'floors_dom', 'pod_oni', 'invn_oni', 'liter_oni', 'zem_oni', 'nazn_oni', 'square_oni_zu', 'square_oni_dom', 'kn_oni_dom', 'doc_osn_oni_dom', 'date_doc_osn_oni_dom', 'pravo_polz_zu', 'num_nej_pom', 'inv_ocenka'], 'safe'],
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
        $query = VupiskiDogovor::find();

        // add conditions that should always apply here

        $dataProvider = new ActiveDataProvider([
            'query' => $query,
            'sort'=> ['defaultOrder' => ['id' => SORT_DESC]],
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
            'date_in' => $this->date_in,
            'time_start' => $this->time_start,
            'time_end' => $this->time_end,
            'status' => $this->status,
            'type_d' => $this->type_d,
        ]);

        $query->andFilterWhere(['like', 'pr_name_f', $this->pr_name_f])
            ->andFilterWhere(['like', 'pr_name_s', $this->pr_name_s])
            ->andFilterWhere(['like', 'pr_name_l', $this->pr_name_l])
            ->andFilterWhere(['like', 'pr_date_b', $this->pr_date_b])
            ->andFilterWhere(['like', 'pr_mesto_b', $this->pr_mesto_b])
            ->andFilterWhere(['like', 'pr_pol', $this->pr_pol])
            ->andFilterWhere(['like', 'pr_pasp_s', $this->pr_pasp_s])
            ->andFilterWhere(['like', 'pr_pasp_n', $this->pr_pasp_n])
            ->andFilterWhere(['like', 'pr_vudan', $this->pr_vudan])
            ->andFilterWhere(['like', 'pr_vudan_data', $this->pr_vudan_data])
            ->andFilterWhere(['like', 'pr_adres_reg', $this->pr_adres_reg])
            ->andFilterWhere(['like', 'pr_kod_podrazd', $this->pr_kod_podrazd])
            ->andFilterWhere(['like', 'pok_name_f', $this->pok_name_f])
            ->andFilterWhere(['like', 'pok_name_s', $this->pok_name_s])
            ->andFilterWhere(['like', 'pok_name_l', $this->pok_name_l])
            ->andFilterWhere(['like', 'pok_date_b', $this->pok_date_b])
            ->andFilterWhere(['like', 'pok_mesto_b', $this->pok_mesto_b])
            ->andFilterWhere(['like', 'pok_pol', $this->pok_pol])
            ->andFilterWhere(['like', 'pok_pasp_s', $this->pok_pasp_s])
            ->andFilterWhere(['like', 'pok_pasp_n', $this->pok_pasp_n])
            ->andFilterWhere(['like', 'pok_vudan', $this->pok_vudan])
            ->andFilterWhere(['like', 'pok_vudan_data', $this->pok_vudan_data])
            ->andFilterWhere(['like', 'pok_adres_reg', $this->pok_adres_reg])
            ->andFilterWhere(['like', 'pok_kod_podrazd', $this->pok_kod_podrazd])
            ->andFilterWhere(['like', 'obj_type', $this->obj_type])
            ->andFilterWhere(['like', 'obj_kn', $this->obj_kn])
            ->andFilterWhere(['like', 'obj_adres', $this->obj_adres])
            ->andFilterWhere(['like', 'obj_square', $this->obj_square])
            ->andFilterWhere(['like', 'obj_square_l', $this->obj_square_l])
            ->andFilterWhere(['like', 'obj_cnt_room', $this->obj_cnt_room])
            ->andFilterWhere(['like', 'obj_floor', $this->obj_floor])
            ->andFilterWhere(['like', 'obj_pod', $this->obj_pod])
            ->andFilterWhere(['like', 'dop_info', $this->dop_info])
            ->andFilterWhere(['like', 'cena', $this->cena])
            ->andFilterWhere(['like', 'doc_osn', $this->doc_osn])
            ->andFilterWhere(['like', 'date_doc_osn', $this->date_doc_osn])
            ->andFilterWhere(['like', 'zapis_v_egrp', $this->zapis_v_egrp])
            ->andFilterWhere(['like', 'date_zapis_v_egrp', $this->date_zapis_v_egrp])
            ->andFilterWhere(['like', 'svid', $this->svid])
            ->andFilterWhere(['like', 'date_svid', $this->date_svid])
            ->andFilterWhere(['like', '_from', $this->_from])
            ->andFilterWhere(['like', 'istochnik', $this->istochnik])
            ->andFilterWhere(['like', 'ip', $this->ip])
            ->andFilterWhere(['like', 'floors_dom', $this->floors_dom])
            ->andFilterWhere(['like', 'pod_oni', $this->pod_oni])
            ->andFilterWhere(['like', 'invn_oni', $this->invn_oni])
            ->andFilterWhere(['like', 'liter_oni', $this->liter_oni])
            ->andFilterWhere(['like', 'zem_oni', $this->zem_oni])
            ->andFilterWhere(['like', 'nazn_oni', $this->nazn_oni])
            ->andFilterWhere(['like', 'square_oni_zu', $this->square_oni_zu])
            ->andFilterWhere(['like', 'square_oni_dom', $this->square_oni_dom])
            ->andFilterWhere(['like', 'kn_oni_dom', $this->kn_oni_dom])
            ->andFilterWhere(['like', 'doc_osn_oni_dom', $this->doc_osn_oni_dom])
            ->andFilterWhere(['like', 'date_doc_osn_oni_dom', $this->date_doc_osn_oni_dom])
            ->andFilterWhere(['like', 'pravo_polz_zu', $this->pravo_polz_zu])
            ->andFilterWhere(['like', 'num_nej_pom', $this->num_nej_pom])
            ->andFilterWhere(['like', 'inv_ocenka', $this->inv_ocenka]);

        return $dataProvider;
    }
}
