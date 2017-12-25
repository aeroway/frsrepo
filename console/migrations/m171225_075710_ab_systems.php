<?php

use yii\db\Schema;
use yii\db\Migration;

class m171225_075710_ab_systems extends Migration
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
            '{{%ab_systems}}',
            [
                'id'=> $this->primaryKey(),
                'name'=> $this->string()->null()->defaultValue(null),
            ],$tableOptions
        );

    }

    public function safeDown()
    {
        $this->dropTable('{{%ab_systems}}');
    }
}
