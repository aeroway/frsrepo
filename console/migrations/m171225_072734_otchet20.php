<?php

use yii\db\Schema;
use yii\db\Migration;

class m171225_072734_otchet20 extends Migration
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
            '{{%otchet20}}',
            [
                'id'=> $this->primaryKey(),
                'area'=> $this->string()->null()->defaultValue(null),
                'description'=> $this->string()->null()->defaultValue(null),
                'kn'=> $this->string()->null()->defaultValue(null),
                'date'=> $this->datetime()->null()->defaultValue(null),
                'username'=> $this->string()->null()->defaultValue(null),
                'comment'=> $this->string()->null()->defaultValue(null),
                'flag'=> $this->smallInteger()->null()->defaultValue(0),
                'id_dpt'=> $this->integer()->null()->defaultValue(null),
                'filename'=> $this->string()->null()->defaultValue(null),
                'id_egrp'=> $this->integer()->null()->defaultValue(null),
                'date_update'=> $this->datetime()->null()->defaultValue(null),
                'date_load'=> $this->datetime()->null()->defaultValue('(getdate())'),
                'protocol'=> $this->string()->null()->defaultValue(null),
                'status'=> $this->string()->null()->defaultValue('('не назначено')'),
            ],$tableOptions
        );

    }

    public function safeDown()
    {
        $this->dropTable('{{%otchet20}}');
    }
}
