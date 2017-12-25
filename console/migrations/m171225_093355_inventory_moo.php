<?php

use yii\db\Schema;
use yii\db\Migration;

class m171225_093355_inventory_moo extends Migration
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
            '{{%inventory_moo}}',
            [
                'id'=> $this->primaryKey(),
                'name'=> $this->string()->notNull(),
            ],$tableOptions
        );

    }

    public function safeDown()
    {
        $this->dropTable('{{%inventory_moo}}');
    }
}
