<?php

use yii\db\Schema;
use yii\db\Migration;

class m171225_093359_inventory_partsorder extends Migration
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
            '{{%inventory_partsorder}}',
            [
                'id'=> $this->primaryKey(),
                'partsname_invpo'=> $this->string()->null()->defaultValue(null),
                'count_invpo'=> $this->smallInteger()->null()->defaultValue(null),
                'id_partsorder_invor'=> $this->integer()->null()->defaultValue(null),
            ],$tableOptions
        );

    }

    public function safeDown()
    {
        $this->dropTable('{{%inventory_partsorder}}');
    }
}
