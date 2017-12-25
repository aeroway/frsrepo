<?php

use yii\db\Schema;
use yii\db\Migration;

class m171225_075405_otdel extends Migration
{

    public function init()
    {
        $this->db = 'db2';
        parent::init();
    }

    public function safeUp()
    {
        $tableOptions = 'ENGINE=InnoDB';

        $this->createTable(
            '{{%otdel}}',
            [
                'id'=> $this->integer()->notNull(),
                'text'=> $this->string()->null()->defaultValue(null),
            ],$tableOptions
        );

    }

    public function safeDown()
    {
        $this->dropTable('{{%otdel}}');
    }
}
