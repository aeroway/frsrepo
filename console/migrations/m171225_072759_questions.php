<?php

use yii\db\Schema;
use yii\db\Migration;

class m171225_072759_questions extends Migration
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
            '{{%questions}}',
            [
                'id'=> $this->primaryKey(),
                'question'=> $this->string()->null()->defaultValue(null),
                'answer'=> $this->string()->null()->defaultValue(null),
            ],$tableOptions
        );

    }

    public function safeDown()
    {
        $this->dropTable('{{%questions}}');
    }
}
