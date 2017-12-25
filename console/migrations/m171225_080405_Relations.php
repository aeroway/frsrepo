<?php

use yii\db\Schema;
use yii\db\Migration;

class m171225_080405_Relations extends Migration
{

    public function init()
    {
       $this->db = 'db6';
       parent::init();
    }

    public function safeUp()
    {
        $this->addForeignKey('fk_purchase_plan_st_id',
            '{{%purchase_plan}}','st_id',
            '{{%spending}}','id',
            'CASCADE','CASCADE'
         );
        $this->addForeignKey('fk_schedule_plan_pm_id',
            '{{%schedule_plan}}','pm_id',
            '{{%purchase_method}}','id',
            'CASCADE','CASCADE'
         );
    }

    public function safeDown()
    {
        $this->dropForeignKey('fk_purchase_plan_st_id', '{{%purchase_plan}}');
        $this->dropForeignKey('fk_schedule_plan_pm_id', '{{%schedule_plan}}');
    }
}
