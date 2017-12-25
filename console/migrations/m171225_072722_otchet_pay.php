<?php

use yii\db\Schema;
use yii\db\Migration;

class m171225_072722_otchet_pay extends Migration
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
            '{{%otchet_pay}}',
            [
                'id'=> $this->primaryKey(),
                'number'=> $this->string()->null()->defaultValue(null),
                'payer_name'=> $this->string()->null()->defaultValue(null),
                'sum'=> $this->float()->null()->defaultValue(null),
                'payer_id'=> $this->string()->null()->defaultValue(null),
                'payer_date'=> $this->datetime()->null()->defaultValue(null),
                'note'=> $this->string()->null()->defaultValue(null),
                'date_load'=> $this->datetime()->null()->defaultValue('(getdate())'),
                'status'=> $this->string()->null()->defaultValue('('не назначено')'),
                'username'=> $this->string()->null()->defaultValue(null),
                'date'=> $this->datetime()->null()->defaultValue(null),
                'flag'=> $this->smallInteger()->null()->defaultValue(0),
                'date_update'=> $this->datetime()->null()->defaultValue(null),
            ],$tableOptions
        );

    }

    public function safeDown()
    {
        $this->dropTable('{{%otchet_pay}}');
    }
}
