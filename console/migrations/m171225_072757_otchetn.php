<?php

use yii\db\Schema;
use yii\db\Migration;

class m171225_072757_otchetn extends Migration
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
            '{{%otchetn}}',
            [
                'id'=> $this->primaryKey(),
                'area'=> $this->string()->null()->defaultValue(null),
                'reason1'=> $this->string()->null()->defaultValue(null),
                'reason2'=> $this->string()->null()->defaultValue(null),
                'offer'=> $this->string()->null()->defaultValue(null),
                'comment'=> $this->string()->null()->defaultValue(null),
                'condnum'=> $this->string()->null()->defaultValue(null),
                'dateon'=> $this->datetime()->null()->defaultValue(null),
                'usernameon'=> $this->string()->null()->defaultValue(null),
                'status'=> $this->string()->null()->defaultValue('('не назначено')'),
                'flag'=> $this->smallInteger()->null()->defaultValue(0),
                'id_dpt'=> $this->integer()->null()->defaultValue(null),
                'filename'=> $this->string()->null()->defaultValue(null),
                'id_egrp'=> $this->integer()->null()->defaultValue(null),
                'date_update'=> $this->datetime()->null()->defaultValue(null),
                'date_load'=> $this->datetime()->null()->defaultValue('(getdate())'),
            ],$tableOptions
        );

    }

    public function safeDown()
    {
        $this->dropTable('{{%otchetn}}');
    }
}
