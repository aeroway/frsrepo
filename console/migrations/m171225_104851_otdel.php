<?php

use yii\db\Schema;
use yii\db\Migration;

class m171225_104851_otdel extends Migration
{

    public function init()
    {
        $this->db = 'db5';
        parent::init();
    }

    public function safeUp()
    {
        $tableOptions = 'ENGINE=InnoDB';

        $this->createTable(
            '{{%otdel}}',
            [
                'id'=> $this->primaryKey(),
                'text'=> $this->string()->null()->defaultValue(null),
                'ind'=> $this->smallInteger()->null()->defaultValue(null),
            ],$tableOptions
        );

    }

    public function safeDown()
    {
        $this->dropTable('{{%otdel}}');
    }
}
