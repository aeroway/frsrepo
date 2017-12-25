<?php

use yii\db\Schema;
use yii\db\Migration;

class m171225_072735_otchet21 extends Migration
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
            '{{%otchet21}}',
            [
                'id'=> $this->primaryKey(),
                'kn'=> $this->string()->null()->defaultValue(null),
                'id_dpt'=> $this->integer()->null()->defaultValue(null),
                'id_egrp'=> $this->integer()->null()->defaultValue(null),
                'comment'=> $this->string()->null()->defaultValue(null),
                'description'=> $this->string()->null()->defaultValue(null),
                'area'=> $this->string()->null()->defaultValue(null),
                'date'=> $this->datetime()->null()->defaultValue(null),
                'username'=> $this->string()->null()->defaultValue(null),
                'flag'=> $this->smallInteger()->null()->defaultValue(0),
                'filename'=> $this->string()->null()->defaultValue(null),
                'date_update'=> $this->datetime()->null()->defaultValue(null),
                'date_load'=> $this->datetime()->null()->defaultValue('(getdate())'),
                'protocol'=> $this->string()->null()->defaultValue(null),
                'status'=> $this->string()->null()->defaultValue('('не назначено')'),
            ],$tableOptions
        );

    }

    public function safeDown()
    {
        $this->dropTable('{{%otchet21}}');
    }
}
