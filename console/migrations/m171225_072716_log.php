<?php

use yii\db\Schema;
use yii\db\Migration;

class m171225_072716_log extends Migration
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
            '{{%log}}',
            [
                'text'=> $this->string()->null()->defaultValue(null),
                'text2'=> $this->integer()->null()->defaultValue(null),
                'id'=> $this->primaryKey(),
            ],$tableOptions
        );

    }

    public function safeDown()
    {
        $this->dropTable('{{%log}}');
    }
}
