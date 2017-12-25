<?php

use yii\db\Schema;
use yii\db\Migration;

class m171225_072719_ora_messages extends Migration
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
            '{{%ora_messages}}',
            [
                'id'=> $this->primaryKey(),
                'text_message'=> $this->string()->null()->defaultValue(null),
                'kuvd_id'=> $this->integer()->null()->defaultValue(null),
                'version'=> $this->string()->null()->defaultValue(null),
            ],$tableOptions
        );

    }

    public function safeDown()
    {
        $this->dropTable('{{%ora_messages}}');
    }
}
