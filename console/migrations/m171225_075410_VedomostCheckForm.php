<?php

use yii\db\Schema;
use yii\db\Migration;

class m171225_075410_VedomostCheckForm extends Migration
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
            '{{%VedomostCheckForm}}',
            [
                'id'=> $this->primaryKey(),
                'date_in'=> $this->datetime()->null()->defaultValue('(getdate())'),
                'user_in'=> $this->string()->null()->defaultValue(null),
                'vedomost_num'=> $this->integer()->null()->defaultValue(null),
                'vedomost_date'=> $this->datetime()->null()->defaultValue(null),
                'vedomost_res'=> $this->smallInteger()->null()->defaultValue(null),
                'check_type'=> $this->smallInteger()->null()->defaultValue(null),
                'module'=> $this->string()->null()->defaultValue(null),
                'ip'=> $this->string()->null()->defaultValue(null),
                'sektors_ip'=> $this->integer()->null()->defaultValue(null),
                'dt_fr'=> $this->datetime()->null()->defaultValue(null),
            ],$tableOptions
        );

    }

    public function safeDown()
    {
        $this->dropTable('{{%VedomostCheckForm}}');
    }
}
