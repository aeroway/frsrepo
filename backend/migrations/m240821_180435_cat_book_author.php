<?php

use yii\db\Schema;
use yii\db\Migration;

class m240821_180435_cat_book_author extends Migration
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
            '{{%cat_book_author}}',
            [
                'id'=> $this->primaryKey(),
                'book_id'=> $this->integer(32)->notNull(),
                'author_id'=> $this->integer(32)->notNull(),
            ],$tableOptions
        );

    }

    public function safeDown()
    {
        $this->dropTable('{{%cat_book_author}}');
    }
}
