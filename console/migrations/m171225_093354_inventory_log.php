<?php

use yii\db\Schema;
use yii\db\Migration;

class m171225_093354_inventory_log extends Migration
{

    public function init()
    {
        $this->db = 'db4';
        parent::init();
    }

    public function safeUp()
    {
        $tableOptions = 'ENGINE=InnoDB';

        $this->createTable(
            '{{%inventory_log}}',
            [
                'id'=> $this->primaryKey(),
                'invname'=> $this->string()->notNull(),
                'invnum'=> $this->string()->notNull(),
                'id_moo'=> $this->integer()->notNull(),
                'location'=> $this->string()->notNull(),
                'id_typetech'=> $this->integer()->notNull(),
                'date'=> $this->datetime()->notNull(),
                'id_status'=> $this->integer()->notNull(),
                'comment'=> $this->string()->notNull(),
                'authority'=> $this->smallInteger()->notNull(),
                'waybill'=> $this->smallInteger()->notNull(),
                'username'=> $this->string()->null()->defaultValue(null),
            ],$tableOptions
        );

    }

    public function safeDown()
    {
        $this->dropTable('{{%inventory_log}}');
    }
}
