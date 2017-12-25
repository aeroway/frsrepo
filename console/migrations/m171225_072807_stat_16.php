<?php

use yii\db\Schema;
use yii\db\Migration;

class m171225_072807_stat_16 extends Migration
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
            '{{%stat_16}}',
            [
                'name'=> $this->string()->null()->defaultValue(null),
                'vse'=> $this->integer()->null()->defaultValue(null),
                'ispr'=> $this->integer()->null()->defaultValue(null),
                'WORK'=> $this->integer()->null()->defaultValue(null),
                'ne_ispr'=> $this->integer()->null()->defaultValue(null),
                'ne_nazn'=> $this->integer()->null()->defaultValue(null),
                'rep'=> $this->integer()->null()->defaultValue(null),
                'nazn'=> $this->integer()->null()->defaultValue(null),
            ],$tableOptions
        );

    }

    public function safeDown()
    {
        $this->dropTable('{{%stat_16}}');
    }
}
