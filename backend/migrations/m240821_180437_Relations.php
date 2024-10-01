<?php

use yii\db\Schema;
use yii\db\Migration;

class m240821_180437_Relations extends Migration
{

    public function init()
    {
       $this->db = 'db10';
       parent::init();
    }

    public function safeUp()
    {
        $this->addForeignKey('fk_cat_book_author_author_id',
            '{{%cat_book_author}}','author_id',
            '{{%cat_authors}}','id',
            'CASCADE','CASCADE'
         );
        $this->addForeignKey('fk_cat_book_author_book_id',
            '{{%cat_book_author}}','book_id',
            '{{%cat_books}}','id',
            'CASCADE','CASCADE'
         );
    }

    public function safeDown()
    {
        $this->dropForeignKey('fk_cat_book_author_author_id', '{{%cat_book_author}}');
        $this->dropForeignKey('fk_cat_book_author_book_id', '{{%cat_book_author}}');
    }
}
