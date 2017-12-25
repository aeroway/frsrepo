<?php

use yii\db\Schema;
use yii\db\Migration;

class m171225_072713_gzn_object extends Migration
{

    public function init()
    {
        $this->db = 'db';
        parent::init();
    }

    public function safeUp()
    {
        $tableOptions = 'ENGINE=InnoDB';

        $this->createTable(
            '{{%gzn_object}}',
            [
                'id'=> $this->primaryKey(),
                'gzn_type_check_id'=> $this->integer()->null()->defaultValue(null),
                'authoritie_check'=> $this->string()->null()->defaultValue(null),
                'name_entity'=> $this->string()->null()->defaultValue(null),
                'kn'=> $this->string()->null()->defaultValue(null),
                'land_num'=> $this->smallInteger()->null()->defaultValue(null),
                'land_area'=> $this->float()->null()->defaultValue(null),
                'violation_area'=> $this->float()->null()->defaultValue(null),
                'kn_cost'=> $this->string()->null()->defaultValue(null),
                'order_check'=> $this->string()->null()->defaultValue(null),
                'act_check'=> $this->string()->null()->defaultValue(null),
                'violation_protocol'=> $this->string()->null()->defaultValue(null),
                'date_ruling'=> $this->datetime()->null()->defaultValue(null),
                'date_enforcement'=> $this->datetime()->null()->defaultValue(null),
                'date_warning'=> $this->datetime()->null()->defaultValue(null),
                'date_warning_execution'=> $this->datetime()->null()->defaultValue(null),
                'termination_land_rights'=> $this->datetime()->null()->defaultValue(null),
                'date_reference'=> $this->datetime()->null()->defaultValue(null),
                'info_decision'=> $this->string()->null()->defaultValue(null),
                'violation_decision_end'=> $this->string()->null()->defaultValue(null),
                'date_outgoing'=> $this->datetime()->null()->defaultValue(null),
                'date_performance'=> $this->datetime()->null()->defaultValue(null),
                'land_category'=> $this->string()->null()->defaultValue(null),
                'land_user_category'=> $this->string()->null()->defaultValue(null),
                'requisites_land_user'=> $this->string()->null()->defaultValue(null),
                'address_land_plot'=> $this->string()->null()->defaultValue(null),
                'type_func_use'=> $this->string()->null()->defaultValue(null),
                'description_violation'=> $this->string()->null()->defaultValue(null),
                'phone'=> $this->string()->null()->defaultValue(null),
                'full_name_inspector'=> $this->string()->null()->defaultValue(null),
                'date_month'=> $this->datetime()->null()->defaultValue(null),
                'count_days_check'=> $this->smallInteger()->null()->defaultValue(null),
            ],$tableOptions
        );

    }

    public function safeDown()
    {
        $this->dropTable('{{%gzn_object}}');
    }
}
