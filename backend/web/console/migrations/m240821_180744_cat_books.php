<?php

use yii\db\Schema;
use yii\db\Migration;

class m240821_180744_cat_books extends Migration
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
            '{{%cat_books}}',
            [
                'id'=> $this->primaryKey(),
                'title'=> $this->string(255)->notNull(),
                'year'=> $this->integer(32)->notNull(),
                'description'=> $this->string(1024),
                'isbn'=> $this->string(50)->notNull(),
                'image'=> $this->string(255),
            ],$tableOptions
        );

    }

    public function safeDown()
    {
        $this->dropTable('{{%cat_books}}');
    }
}
