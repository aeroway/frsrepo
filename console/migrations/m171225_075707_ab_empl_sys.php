<?php

use yii\db\Schema;
use yii\db\Migration;

class m171225_075707_ab_empl_sys extends Migration
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
            '{{%ab_empl_sys}}',
            [
                'id'=> $this->primaryKey(),
                'id_empl'=> $this->integer()->notNull(),
                'id_status'=> $this->integer()->notNull(),
                'id_systems'=> $this->integer()->notNull(),
            ],$tableOptions
        );

    }

    public function safeDown()
    {
        $this->dropTable('{{%ab_empl_sys}}');
    }
}
