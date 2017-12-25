<?php

use yii\db\Schema;
use yii\db\Migration;

class m171225_072717_ora_dop_doc extends Migration
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
            '{{%ora_dop_doc}}',
            [
                'id'=> $this->primaryKey(),
                'date_load'=> $this->datetime()->null()->defaultValue('(getdate())'),
                'kuvd'=> $this->string()->null()->defaultValue(null),
                'FK_kuvd_id'=> $this->integer()->null()->defaultValue(null),
                'date_receipt'=> $this->datetime()->null()->defaultValue(null),
            ],$tableOptions
        );

    }

    public function safeDown()
    {
        $this->dropTable('{{%ora_dop_doc}}');
    }
}
