<?php

use yii\db\Schema;
use yii\db\Migration;

class m171225_075709_ab_status extends Migration
{

    public function init()
    {
        $this->db = 'db3';
        parent::init();
    }

    public function safeUp()
    {
        $tableOptions = 'ENGINE=InnoDB';

        $this->createTable(
            '{{%ab_status}}',
            [
                'id'=> $this->primaryKey(),
                'name'=> $this->string()->null()->defaultValue(null),
            ],$tableOptions
        );

    }

    public function safeDown()
    {
        $this->dropTable('{{%ab_status}}');
    }
}
