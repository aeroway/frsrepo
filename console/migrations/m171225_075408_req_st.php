<?php

use yii\db\Schema;
use yii\db\Migration;

class m171225_075408_req_st extends Migration
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
            '{{%req_st}}',
            [
                'id'=> $this->smallInteger()->notNull(),
                'text'=> $this->string()->null()->defaultValue(null),
                'priority'=> $this->smallInteger()->null()->defaultValue(null),
            ],$tableOptions
        );

    }

    public function safeDown()
    {
        $this->dropTable('{{%req_st}}');
    }
}
