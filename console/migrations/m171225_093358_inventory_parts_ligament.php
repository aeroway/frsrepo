<?php

use yii\db\Schema;
use yii\db\Migration;

class m171225_093358_inventory_parts_ligament extends Migration
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
            '{{%inventory_parts_ligament}}',
            [
                'id'=> $this->primaryKey(),
                'invnum_inventory'=> $this->string()->notNull(),
                'id_inventory_parts'=> $this->integer()->notNull(),
                'amount_ipl'=> $this->smallInteger()->notNull(),
            ],$tableOptions
        );

    }

    public function safeDown()
    {
        $this->dropTable('{{%inventory_parts_ligament}}');
    }
}
