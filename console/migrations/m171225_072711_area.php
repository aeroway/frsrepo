<?php

use yii\db\Schema;
use yii\db\Migration;

class m171225_072711_area extends Migration
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
            '{{%area}}',
            [
                'id'=> $this->primaryKey(),
                'kn'=> $this->string()->null()->defaultValue(null),
                'name'=> $this->string()->null()->defaultValue(null),
                'id_dpt'=> $this->string()->null()->defaultValue(null),
                'fl'=> $this->string()->null()->defaultValue(null),
            ],$tableOptions
        );

    }

    public function safeDown()
    {
        $this->dropTable('{{%area}}');
    }
}
