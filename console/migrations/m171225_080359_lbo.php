<?php

use yii\db\Schema;
use yii\db\Migration;

class m171225_080359_lbo extends Migration
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
            '{{%lbo}}',
            [
                'id'=> $this->primaryKey(),
                'sum'=> $this->float()->null()->defaultValue(null),
                'comment'=> $this->string()->null()->defaultValue(null),
                'date'=> $this->datetime()->null()->defaultValue(null),
                'year'=> $this->smallInteger()->null()->defaultValue(null),
            ],$tableOptions
        );

    }

    public function safeDown()
    {
        $this->dropTable('{{%lbo}}');
    }
}
