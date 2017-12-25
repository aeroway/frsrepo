<?php

use yii\db\Schema;
use yii\db\Migration;

class m171225_080402_purchase_plan extends Migration
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
            '{{%purchase_plan}}',
            [
                'id'=> $this->primaryKey(),
                'type'=> $this->string()->null()->defaultValue(null),
                'okpd'=> $this->string()->null()->defaultValue(null),
                'name_object'=> $this->string()->null()->defaultValue(null),
                'outlay'=> $this->float()->null()->defaultValue(null),
                'p_year'=> $this->float()->null()->defaultValue(null),
                'c_year'=> $this->float()->null()->defaultValue(null),
                'special'=> $this->float()->null()->defaultValue(null),
                'sum'=> $this->float()->null()->defaultValue(null),
                'year'=> $this->smallInteger()->null()->defaultValue(null),
                'st_id'=> $this->integer()->null()->defaultValue(null),
                'is_top'=> $this->integer()->null()->defaultValue(0),
                'f_row'=> $this->integer()->null()->defaultValue(0),
                'is_percent'=> $this->smallInteger()->null()->defaultValue(null),
                'econom'=> $this->string()->null()->defaultValue(null),
            ],$tableOptions
        );

    }

    public function safeDown()
    {
        $this->dropTable('{{%purchase_plan}}');
    }
}
