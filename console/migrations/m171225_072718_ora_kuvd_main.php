<?php

use yii\db\Schema;
use yii\db\Migration;

class m171225_072718_ora_kuvd_main extends Migration
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
            '{{%ora_kuvd_main}}',
            [
                'id'=> $this->primaryKey(),
                'otdel'=> $this->string()->null()->defaultValue(null),
                'fio'=> $this->string()->null()->defaultValue(null),
                'kuvd'=> $this->string()->null()->defaultValue(null),
                'date_receipt'=> $this->datetime()->null()->defaultValue(null),
                'version'=> $this->string()->null()->defaultValue(null),
                'is_top'=> $this->smallInteger()->null()->defaultValue(0),
                'date_version'=> $this->datetime()->null()->defaultValue(null),
                'status'=> $this->string()->null()->defaultValue(null),
                'date_issue'=> $this->datetime()->null()->defaultValue(null),
                'kuvd_id'=> $this->integer()->null()->defaultValue(null),
                'date_load'=> $this->datetime()->null()->defaultValue('(getdate())'),
                'date_end'=> $this->datetime()->null()->defaultValue(null),
                'date_suspend'=> $this->datetime()->null()->defaultValue(null),
                'performer'=> $this->string()->null()->defaultValue(null),
                'message'=> $this->string()->null()->defaultValue(null),
            ],$tableOptions
        );

    }

    public function safeDown()
    {
        $this->dropTable('{{%ora_kuvd_main}}');
    }
}
