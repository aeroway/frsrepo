<?php

use yii\db\Schema;
use yii\db\Migration;

class m171225_093357_inventory_parts extends Migration
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
            '{{%inventory_parts}}',
            [
                'id'=> $this->primaryKey(),
                'nameparts'=> $this->string()->notNull(),
                'id_typeparts'=> $this->integer()->notNull(),
                'amount'=> $this->smallInteger()->notNull(),
                'location'=> $this->string()->notNull(),
                'comment_parts'=> $this->string()->null()->defaultValue(null),
            ],$tableOptions
        );

    }

    public function safeDown()
    {
        $this->dropTable('{{%inventory_parts}}');
    }
}
