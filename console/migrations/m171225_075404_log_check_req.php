<?php

use yii\db\Schema;
use yii\db\Migration;

class m171225_075404_log_check_req extends Migration
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
            '{{%log_check_req}}',
            [
                'id'=> $this->primaryKey(),
                'date_in'=> $this->datetime()->null()->defaultValue('(getdate())'),
                'idm_req'=> $this->integer()->null()->defaultValue(null),
            ],$tableOptions
        );

    }

    public function safeDown()
    {
        $this->dropTable('{{%log_check_req}}');
    }
}
