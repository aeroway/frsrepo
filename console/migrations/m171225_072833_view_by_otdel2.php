<?php

use yii\db\Schema;
use yii\db\Migration;

class m171225_072833_view_by_otdel2 extends Migration
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
            '{{%view_by_otdel2}}',
            [
                'fio'=> $this->string()->null()->defaultValue(null),
                'otdel'=> $this->string()->null()->defaultValue(null),
                'vsego'=> $this->integer()->null()->defaultValue(null),
                'pr'=> $this->integer()->null()->defaultValue(null),
                'otkaz'=> $this->integer()->null()->defaultValue(null),
                'doublepr'=> $this->integer()->null()->defaultValue(null),
                'noUvedoml'=> $this->integer()->null()->defaultValue(null),
                'prSdopom'=> $this->integer()->null()->defaultValue(null),
                'prosrPR'=> $this->integer()->null()->defaultValue(null),
            ],$tableOptions
        );

    }

    public function safeDown()
    {
        $this->dropTable('{{%view_by_otdel2}}');
    }
}
