<?php

namespace backend\models;

use yii\base\Model;
use yii\data\ActiveDataProvider;
use backend\models\Employee;

/**
 * EmployeeSearch represents the model behind the search form of `backend\models\Employee`.
 */
class EmployeeSearch extends Employee
{
    /**
     * {@inheritdoc}
     */

    public function rules()
    {
        return [
            [['id', 'gsdp_y', 'gsdp_m', 'gsdp_d', 'otsdp_y', 'otsdp_m', 'otsdp_d', 'ver', 'is_top', 'brak', 'status', 'tgs_y', 'tgs_m', 'tgs_d', 'voen_uch', 'voen_zvanie', 'stat', 'gos_reg', 'gos_inspect', 'tos_y', 'tos_m', 'tos_d', 'pol', 'doplata_ur_percent', 'check_is_login'], 'integer'],
            [['idm_otdel', 'idm_doljn', 'fam', 'name', 'otch', 'pasp_s', 'pasp_n', 'pasp_date_v', 'pasp_kem_v', 'adres_f', 'adres_reg', 'date_priem', 'date_nazn', 'oklad', 'nadbavka', 'osnovanie', 'date_in', 'suprug', 'phone', 'prikazi', 'data_b', 'date_stazh', 'voen_kom', 'inn', 'snils', 'status_to', 'foto', 'doplata_ur_prikaz', 'doplata_ur_data', 'login_upr', 'login_just', 'skud_card_num', 'date_uvolnen'], 'safe'],
            [['nadbavka_stazh', 'nadbavka_stazh_raschet'], 'number'],
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
        $query = Employee::find()
            ->where(['<>', 'status', 2]);

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

        $query->joinWith('otdelText otd');
        $query->joinWith('dolnjName pos');

        // grid filtering conditions
        $query->andFilterWhere([
            'id' => $this->id,
            'pasp_date_v' => $this->pasp_date_v,
            'date_priem' => $this->date_priem,
            'gsdp_y' => $this->gsdp_y,
            'gsdp_m' => $this->gsdp_m,
            'gsdp_d' => $this->gsdp_d,
            'otsdp_y' => $this->otsdp_y,
            'otsdp_m' => $this->otsdp_m,
            'otsdp_d' => $this->otsdp_d,
            'ver' => $this->ver,
            'is_top' => $this->is_top,
            'date_nazn' => $this->date_nazn,
            'date_in' => $this->date_in,
            'brak' => $this->brak,
            'status' => $this->status,
            'data_b' => $this->data_b,
            'tgs_y' => $this->tgs_y,
            'tgs_m' => $this->tgs_m,
            'tgs_d' => $this->tgs_d,
            'date_stazh' => $this->date_stazh,
            'voen_uch' => $this->voen_uch,
            'voen_zvanie' => $this->voen_zvanie,
            'stat' => $this->stat,
            'gos_reg' => $this->gos_reg,
            'gos_inspect' => $this->gos_inspect,
            'status_to' => $this->status_to,
            'tos_y' => $this->tos_y,
            'tos_m' => $this->tos_m,
            'tos_d' => $this->tos_d,
            'pol' => $this->pol,
            'doplata_ur_percent' => $this->doplata_ur_percent,
            'doplata_ur_data' => $this->doplata_ur_data,
            'nadbavka_stazh' => $this->nadbavka_stazh,
            'nadbavka_stazh_raschet' => $this->nadbavka_stazh_raschet,
            'check_is_login' => $this->check_is_login,
            'date_uvolnen' => $this->date_uvolnen,
        ]);

        $query->andFilterWhere(['like', 'fam', $this->fam])
            ->andFilterWhere(['like', 'pos.name', $this->idm_doljn])
            ->andFilterWhere(['like', 'otd.text', $this->idm_otdel])
            ->andFilterWhere(['like', 'name', $this->name])
            ->andFilterWhere(['like', 'otch', $this->otch])
            ->andFilterWhere(['like', 'pasp_s', $this->pasp_s])
            ->andFilterWhere(['like', 'pasp_n', $this->pasp_n])
            ->andFilterWhere(['like', 'pasp_kem_v', $this->pasp_kem_v])
            ->andFilterWhere(['like', 'adres_f', $this->adres_f])
            ->andFilterWhere(['like', 'adres_reg', $this->adres_reg])
            ->andFilterWhere(['like', 'oklad', $this->oklad])
            ->andFilterWhere(['like', 'nadbavka', $this->nadbavka])
            ->andFilterWhere(['like', 'osnovanie', $this->osnovanie])
            ->andFilterWhere(['like', 'suprug', $this->suprug])
            ->andFilterWhere(['like', 'phone', $this->phone])
            ->andFilterWhere(['like', 'prikazi', $this->prikazi])
            ->andFilterWhere(['like', 'voen_kom', $this->voen_kom])
            ->andFilterWhere(['like', 'inn', $this->inn])
            ->andFilterWhere(['like', 'snils', $this->snils])
            ->andFilterWhere(['like', 'foto', $this->foto])
            ->andFilterWhere(['like', 'doplata_ur_prikaz', $this->doplata_ur_prikaz])
            ->andFilterWhere(['like', 'login_upr', $this->login_upr])
            ->andFilterWhere(['like', 'login_just', $this->login_just])
            ->andFilterWhere(['like', 'skud_card_num', $this->skud_card_num]);

        return $dataProvider;
    }
}
