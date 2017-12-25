<?php

use yii\db\Schema;
use yii\db\Migration;

class m171225_075406_req extends Migration
{

    public function init()
    {
        $this->db = 'db2';
        parent::init();
    }

    public function safeUp()
    {
        $tableOptions = 'ENGINE=InnoDB';

        $this->createTable(
            '{{%req}}',
            [
                'id'=> $this->primaryKey(),
                'obj_addr'=> $this->string()->null()->defaultValue(null),
                'zayavitel_num'=> $this->string()->null()->defaultValue(null),
                'zayavitel_fio'=> $this->string()->null()->defaultValue(null),
                'obj_id'=> $this->integer()->null()->defaultValue(null),
                'kuvd'=> $this->string()->null()->defaultValue(null),
                'kuvd_id'=> $this->integer()->null()->defaultValue(null),
                'user_text'=> $this->string()->null()->defaultValue(null),
                'status'=> $this->smallInteger()->null()->defaultValue(0),
                'date_in'=> $this->datetime()->null()->defaultValue('(getdate())'),
                'user_to'=> $this->string()->null()->defaultValue(null),
                'kn'=> $this->string()->null()->defaultValue(null),
                'coment'=> $this->string()->null()->defaultValue(null),
                'type'=> $this->smallInteger()->null()->defaultValue(null),
                'otdel'=> $this->integer()->null()->defaultValue(null),
                'cel'=> $this->integer()->null()->defaultValue(null),
                'cur_user'=> $this->string()->null()->defaultValue(null),
                'date_end'=> $this->datetime()->null()->defaultValue(null),
                'fast'=> $this->smallInteger()->null()->defaultValue(0),
                'phone'=> $this->string()->null()->defaultValue(null),
                'vedomost_num'=> $this->integer()->null()->defaultValue(null),
                'user_last'=> $this->string()->null()->defaultValue(null),
                'vedomost_unform'=> $this->smallInteger()->null()->defaultValue(0),
                'srok'=> $this->datetime()->null()->defaultValue(null),
                'user_print'=> $this->string()->null()->defaultValue(null),
                'print_date'=> $this->datetime()->null()->defaultValue(null),
                'code_mesto'=> $this->string()->null()->defaultValue(null),
                'date_v'=> $this->datetime()->null()->defaultValue(null),
                'area_id'=> $this->smallInteger()->null()->defaultValue(null),
                'org'=> $this->string()->null()->defaultValue(null),
                'inn'=> $this->char()->null()->defaultValue(null),
                'scan_doc'=> $this->string()->null()->defaultValue(null),
                'date_return'=> $this->datetime()->null()->defaultValue(null),
            ],$tableOptions
        );

    }

    public function safeDown()
    {
        $this->dropTable('{{%req}}');
    }
}
