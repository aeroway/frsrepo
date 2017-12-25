<?php

use yii\db\Schema;
use yii\db\Migration;

class m171225_080403_schedule_plan extends Migration
{

    public function init()
    {
        $this->db = 'db6';
        parent::init();
    }

    public function safeUp()
    {
        $tableOptions = 'ENGINE=InnoDB';

        $this->createTable(
            '{{%schedule_plan}}',
            [
                'id'=> $this->primaryKey(),
                'name'=> $this->string()->null()->defaultValue(null),
                'sum'=> $this->float()->null()->defaultValue(null),
                'comment'=> $this->string()->null()->defaultValue(null),
                'pm_id'=> $this->integer()->null()->defaultValue(null),
                'sum_fact'=> $this->float()->null()->defaultValue(null),
                'pp_id'=> $this->integer()->null()->defaultValue(null),
                'sum_contract'=> $this->float()->null()->defaultValue(null),
                'name_doc'=> $this->string()->null()->defaultValue(null),
                'date_doc'=> $this->datetime()->null()->defaultValue(null),
                'date_exp_from'=> $this->datetime()->null()->defaultValue(null),
                'date_exp_to'=> $this->datetime()->null()->defaultValue(null),
                'inn'=> $this->string()->null()->defaultValue(null),
                'name_org'=> $this->string()->null()->defaultValue(null),
            ],$tableOptions
        );

    }

    public function safeDown()
    {
        $this->dropTable('{{%schedule_plan}}');
    }
}
