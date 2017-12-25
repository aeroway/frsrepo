<?php

use yii\db\Schema;
use yii\db\Migration;

class m171225_072835_Relations extends Migration
{

    public function init()
    {
       $this->db = 'db';
       parent::init();
    }

    public function safeUp()
    {
        $this->addForeignKey('fk_gzn_injunction_gzn_violations_id',
            '{{%gzn_injunction}}','gzn_violations_id',
            '{{%gzn_violations}}','id',
            'CASCADE','CASCADE'
         );
        $this->addForeignKey('fk_gzn_object_gzn_type_check_id',
            '{{%gzn_object}}','gzn_type_check_id',
            '{{%gzn_type_check}}','id',
            'CASCADE','CASCADE'
         );
        $this->addForeignKey('fk_gzn_violations_gzn_obj_id',
            '{{%gzn_violations}}','gzn_obj_id',
            '{{%gzn_object}}','id',
            'CASCADE','CASCADE'
         );
    }

    public function safeDown()
    {
        $this->dropForeignKey('fk_gzn_injunction_gzn_violations_id', '{{%gzn_injunction}}');
        $this->dropForeignKey('fk_gzn_object_gzn_type_check_id', '{{%gzn_object}}');
        $this->dropForeignKey('fk_gzn_violations_gzn_obj_id', '{{%gzn_violations}}');
    }
}
