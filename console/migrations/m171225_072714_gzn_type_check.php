<?php

use yii\db\Schema;
use yii\db\Migration;

class m171225_072714_gzn_type_check extends Migration
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
            '{{%gzn_type_check}}',
            [
                'id'=> $this->primaryKey(),
                'name'=> $this->string()->null()->defaultValue(null),
            ],$tableOptions
        );

    }

    public function safeDown()
    {
        $this->dropTable('{{%gzn_type_check}}');
    }
}
