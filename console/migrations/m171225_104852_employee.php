<?php

use yii\db\Schema;
use yii\db\Migration;

class m171225_104852_employee extends Migration
{

    public function init()
    {
        $this->db = 'db5';
        parent::init();
    }

    public function safeUp()
    {
        $tableOptions = 'ENGINE=InnoDB';

        $this->createTable(
            '{{%employee}}',
            [
                'id'=> $this->primaryKey(),
                'fam'=> $this->string()->null()->defaultValue(null),
                'name'=> $this->string()->null()->defaultValue(null),
                'otch'=> $this->string()->null()->defaultValue(null),
                'pasp_s'=> $this->string()->null()->defaultValue(null),
                'pasp_n'=> $this->string()->null()->defaultValue(null),
                'pasp_date_v'=> $this->datetime()->null()->defaultValue(null),
                'pasp_kem_v'=> $this->string()->null()->defaultValue(null),
                'adres_f'=> $this->string()->null()->defaultValue(null),
                'adres_reg'=> $this->string()->null()->defaultValue(null),
                'date_priem'=> $this->datetime()->null()->defaultValue(null),
                'gsdp_y'=> $this->integer()->null()->defaultValue(null),
                'gsdp_m'=> $this->integer()->null()->defaultValue(null),
                'gsdp_d'=> $this->integer()->null()->defaultValue(null),
                'otsdp_y'=> $this->integer()->null()->defaultValue(null),
                'otsdp_m'=> $this->integer()->null()->defaultValue(null),
                'otsdp_d'=> $this->integer()->null()->defaultValue(null),
                'ver'=> $this->integer()->null()->defaultValue(null),
                'is_top'=> $this->integer()->null()->defaultValue(0),
                'date_nazn'=> $this->datetime()->null()->defaultValue(null),
                'idm_otdel'=> $this->integer()->null()->defaultValue(null),
                'idm_doljn'=> $this->integer()->null()->defaultValue(null),
                'oklad'=> $this->string()->null()->defaultValue(null),
                'nadbavka'=> $this->string()->null()->defaultValue(null),
                'osnovanie'=> $this->string()->null()->defaultValue(null),
                'date_in'=> $this->datetime()->null()->defaultValue('(getdate())'),
                'brak'=> $this->smallInteger()->null()->defaultValue(null),
                'suprug'=> $this->string()->null()->defaultValue(null),
                'phone'=> $this->string()->null()->defaultValue(null),
                'prikazi'=> $this->string()->null()->defaultValue(null),
                'status'=> $this->integer()->null()->defaultValue(null),
                'data_b'=> $this->datetime()->null()->defaultValue(null),
                'tgs_y'=> $this->smallInteger()->null()->defaultValue(null),
                'tgs_m'=> $this->smallInteger()->null()->defaultValue(null),
                'tgs_d'=> $this->smallInteger()->null()->defaultValue(null),
                'date_stazh'=> $this->datetime()->null()->defaultValue(null),
                'voen_uch'=> $this->smallInteger()->null()->defaultValue(0),
                'voen_kom'=> $this->string()->null()->defaultValue(null),
                'inn'=> $this->string()->null()->defaultValue(null),
                'snils'=> $this->string()->null()->defaultValue(null),
                'voen_zvanie'=> $this->smallInteger()->null()->defaultValue(null),
                'stat'=> $this->integer()->null()->defaultValue(null),
                'gos_reg'=> $this->smallInteger()->null()->defaultValue(null),
                'gos_inspect'=> $this->smallInteger()->null()->defaultValue(null),
                'status_to'=> $this->datetime()->null()->defaultValue(null),
                'foto'=> $this->string()->null()->defaultValue(null),
                'tos_y'=> $this->smallInteger()->null()->defaultValue(null),
                'tos_m'=> $this->smallInteger()->null()->defaultValue(null),
                'tos_d'=> $this->smallInteger()->null()->defaultValue(null),
                'pol'=> $this->smallInteger()->null()->defaultValue(null),
                'doplata_ur_percent'=> $this->smallInteger()->null()->defaultValue(null),
                'doplata_ur_prikaz'=> $this->string()->null()->defaultValue(null),
                'doplata_ur_data'=> $this->datetime()->null()->defaultValue(null),
                'nadbavka_stazh'=> $this->decimal()->null()->defaultValue('((0))'),
                'nadbavka_stazh_raschet'=> $this->decimal()->null()->defaultValue('((0))'),
                'login_upr'=> $this->string()->null()->defaultValue(null),
                'login_just'=> $this->string()->null()->defaultValue(null),
                'check_is_login'=> $this->smallInteger()->null()->defaultValue(0),
                'skud_card_num'=> $this->string()->null()->defaultValue(null),
                'date_uvolnen'=> $this->datetime()->null()->defaultValue(null),
            ],$tableOptions
        );

    }

    public function safeDown()
    {
        $this->dropTable('{{%employee}}');
    }
}
