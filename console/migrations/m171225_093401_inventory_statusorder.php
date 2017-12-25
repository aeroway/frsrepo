<?php

use yii\db\Schema;
use yii\db\Migration;

class m171225_093401_inventory_statusorder extends Migration
{

    public function init()
    {
        $this->db = 'db4';
        parent::init();
    }

    public function safeUp()
    {
        $tableOptions = 'ENGINE=InnoDB';

        $this->createTable(
            '{{%inventory_statusorder}}',
            [
                'id'=> $this->primaryKey(),
                'status_invor'=> $this->string()->null()->defaultValue(null),
            ],$tableOptions
        );

    }

    public function safeDown()
    {
        $this->dropTable('{{%inventory_statusorder}}');
    }
}
