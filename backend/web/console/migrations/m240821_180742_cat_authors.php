<?php

use yii\db\Schema;
use yii\db\Migration;

class m240821_180742_cat_authors extends Migration
{

    public function init()
    {
        $this->db = 'db10';
        parent::init();
    }

    public function safeUp()
    {
        $tableOptions = 'ENGINE=InnoDB';

        $this->createTable(
            '{{%cat_authors}}',
            [
                'id'=> $this->primaryKey(),
                'name'=> $this->string(128)->notNull(),
            ],$tableOptions
        );

    }

    public function safeDown()
    {
        $this->dropTable('{{%cat_authors}}');
    }
}
