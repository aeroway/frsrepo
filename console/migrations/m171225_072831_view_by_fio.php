<?php

use yii\db\Schema;
use yii\db\Migration;

class m171225_072831_view_by_fio extends Migration
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
            '{{%view_by_fio}}',
            [
                'otdel'=> $this->string()->null()->defaultValue(null),
                'fio'=> $this->string()->null()->defaultValue(null),
            ],$tableOptions
        );

    }

    public function safeDown()
    {
        $this->dropTable('{{%view_by_fio}}');
    }
}
