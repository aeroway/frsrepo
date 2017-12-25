<?php

use yii\db\Schema;
use yii\db\Migration;

class m171225_080404_spending extends Migration
{

    public function init()
    {
        $this->db = 'db6';
        parent::init();
    }

    public function safeUp()
    {
        $tableOptions = 'ENGINE=InnoDB';

        $this->createTable(
            '{{%spending}}',
            [
                'id'=> $this->primaryKey(),
                'type'=> $this->string()->null()->defaultValue(null),
                'expense'=> $this->string()->null()->defaultValue(null),
            ],$tableOptions
        );

    }

    public function safeDown()
    {
        $this->dropTable('{{%spending}}');
    }
}
