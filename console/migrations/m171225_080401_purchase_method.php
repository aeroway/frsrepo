<?php

use yii\db\Schema;
use yii\db\Migration;

class m171225_080401_purchase_method extends Migration
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
            '{{%purchase_method}}',
            [
                'id'=> $this->primaryKey(),
                'name'=> $this->string()->null()->defaultValue(null),
            ],$tableOptions
        );

    }

    public function safeDown()
    {
        $this->dropTable('{{%purchase_method}}');
    }
}
