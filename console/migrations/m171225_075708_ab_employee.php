<?php

use yii\db\Schema;
use yii\db\Migration;

class m171225_075708_ab_employee extends Migration
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
            '{{%ab_employee}}',
            [
                'id'=> $this->primaryKey(),
                'id_employee'=> $this->integer()->notNull(),
                'act'=> $this->smallInteger()->notNull(),
                'dt1'=> $this->datetime()->notNull(),
                'dt2'=> $this->datetime()->notNull(),
            ],$tableOptions
        );

    }

    public function safeDown()
    {
        $this->dropTable('{{%ab_employee}}');
    }
}
