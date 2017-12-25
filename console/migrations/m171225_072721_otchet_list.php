<?php

use yii\db\Schema;
use yii\db\Migration;

class m171225_072721_otchet_list extends Migration
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
            '{{%otchet_list}}',
            [
                'id'=> $this->primaryKey(),
                'name_list'=> $this->string()->null()->defaultValue(null),
                'table_list'=> $this->string()->null()->defaultValue(null),
                'status_list'=> $this->smallInteger()->null()->defaultValue(null),
                'description_list'=> $this->text()->null()->defaultValue(null),
            ],$tableOptions
        );

    }

    public function safeDown()
    {
        $this->dropTable('{{%otchet_list}}');
    }
}
