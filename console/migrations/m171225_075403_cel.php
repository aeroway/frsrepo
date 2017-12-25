<?php

use yii\db\Schema;
use yii\db\Migration;

class m171225_075403_cel extends Migration
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
            '{{%cel}}',
            [
                'id'=> $this->integer()->notNull(),
                'text'=> $this->string()->null()->defaultValue(null),
            ],$tableOptions
        );

    }

    public function safeDown()
    {
        $this->dropTable('{{%cel}}');
    }
}
