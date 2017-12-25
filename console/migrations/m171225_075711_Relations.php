<?php

use yii\db\Schema;
use yii\db\Migration;

class m171225_075711_Relations extends Migration
{

    public function init()
    {
       $this->db = 'db3';
       parent::init();
    }

    public function safeUp()
    {
        $this->addForeignKey('fk_ab_empl_sys_id_systems',
            '{{%ab_empl_sys}}','id_systems',
            '{{%ab_systems}}','id',
            'CASCADE','CASCADE'
         );
        $this->addForeignKey('fk_ab_empl_sys_id_status',
            '{{%ab_empl_sys}}','id_status',
            '{{%ab_status}}','id',
            'CASCADE','CASCADE'
         );
        $this->addForeignKey('fk_ab_empl_sys_id_empl',
            '{{%ab_empl_sys}}','id_empl',
            '{{%ab_employee}}','id',
            'CASCADE','CASCADE'
         );
    }

    public function safeDown()
    {
        $this->dropForeignKey('fk_ab_empl_sys_id_systems', '{{%ab_empl_sys}}');
        $this->dropForeignKey('fk_ab_empl_sys_id_status', '{{%ab_empl_sys}}');
        $this->dropForeignKey('fk_ab_empl_sys_id_empl', '{{%ab_empl_sys}}');
    }
}
