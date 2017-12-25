<?php

use yii\db\Schema;
use yii\db\Migration;

class m171225_080400_okpd2_sprav extends Migration
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
            '{{%okpd2_sprav}}',
            [
                'id'=> $this->primaryKey(),
                'code'=> $this->string()->null()->defaultValue(null),
                'name'=> $this->text()->null()->defaultValue(null),
                'lvl'=> $this->smallInteger()->null()->defaultValue(0),
                'parent'=> $this->integer()->null()->defaultValue(0),
            ],$tableOptions
        );

    }

    public function safeDown()
    {
        $this->dropTable('{{%okpd2_sprav}}');
    }
}
