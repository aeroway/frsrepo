<?php

use yii\db\Schema;
use yii\db\Migration;

class m171225_075402_area extends Migration
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
            '{{%area}}',
            [
                'id'=> $this->primaryKey(),
                'name'=> $this->string()->notNull(),
                'status'=> $this->smallInteger()->notNull(),
            ],$tableOptions
        );

    }

    public function safeDown()
    {
        $this->dropTable('{{%area}}');
    }
}
