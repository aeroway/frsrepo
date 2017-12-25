<?php

use yii\db\Schema;
use yii\db\Migration;

class m171225_075409_type extends Migration
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
            '{{%type}}',
            [
                'id'=> $this->smallInteger()->null()->defaultValue(null),
                'text'=> $this->string()->null()->defaultValue(null),
            ],$tableOptions
        );

    }

    public function safeDown()
    {
        $this->dropTable('{{%type}}');
    }
}
