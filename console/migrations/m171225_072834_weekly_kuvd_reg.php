<?php

use yii\db\Schema;
use yii\db\Migration;

class m171225_072834_weekly_kuvd_reg extends Migration
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
            '{{%weekly_kuvd_reg}}',
            [
                'id'=> $this->primaryKey(),
                'fio'=> $this->string()->null()->defaultValue(null),
                'count'=> $this->integer()->null()->defaultValue(null),
                'fl'=> $this->string()->null()->defaultValue(null),
            ],$tableOptions
        );

    }

    public function safeDown()
    {
        $this->dropTable('{{%weekly_kuvd_reg}}');
    }
}
