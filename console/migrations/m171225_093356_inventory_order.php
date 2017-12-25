<?php

use yii\db\Schema;
use yii\db\Migration;

class m171225_093356_inventory_order extends Migration
{

    public function init()
    {
        $this->db = 'db4';
        parent::init();
    }

    public function safeUp()
    {
        $tableOptions = 'ENGINE=InnoDB';

        $this->createTable(
            '{{%inventory_order}}',
            [
                'id'=> $this->primaryKey(),
                'invnum_invor'=> $this->string()->null()->defaultValue(null),
                'invname_invor'=> $this->string()->null()->defaultValue(null),
                'ip_invor'=> $this->string()->null()->defaultValue(null),
                'user_invor'=> $this->string()->null()->defaultValue(null),
                'demanding_invor'=> $this->string()->null()->defaultValue(null),
                'date_invor'=> $this->datetime()->null()->defaultValue(null),
                'status_id_invor'=> $this->integer()->null()->defaultValue(null),
                'active_invor'=> $this->smallInteger()->null()->defaultValue(0),
            ],$tableOptions
        );

    }

    public function safeDown()
    {
        $this->dropTable('{{%inventory_order}}');
    }
}
