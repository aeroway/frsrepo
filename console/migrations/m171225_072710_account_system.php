<?php

use yii\db\Schema;
use yii\db\Migration;

class m171225_072710_account_system extends Migration
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
            '{{%account_system}}',
            [
                'id'=> $this->primaryKey(),
                'url'=> $this->string()->null()->defaultValue(null),
                'group_name'=> $this->string()->null()->defaultValue(null),
                'title'=> $this->string()->null()->defaultValue(null),
                'description'=> $this->string()->null()->defaultValue(null),
                'icon'=> $this->string()->null()->defaultValue(null),
                'group_item'=> $this->smallInteger()->null()->defaultValue(null),
                'bg_color'=> $this->string()->null()->defaultValue(null),
            ],$tableOptions
        );

    }

    public function safeDown()
    {
        $this->dropTable('{{%account_system}}');
    }
}
