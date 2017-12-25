<?php

use yii\db\Schema;
use yii\db\Migration;

class m171225_093404_Relations extends Migration
{

    public function init()
    {
       $this->db = 'db4';
       parent::init();
    }

    public function safeUp()
    {
        $this->addForeignKey('fk_inventory_id_status',
            '{{%inventory}}','id_status',
            '{{%inventory_status}}','id',
            'CASCADE','CASCADE'
         );
        $this->addForeignKey('fk_inventory_id_moo',
            '{{%inventory}}','id_moo',
            '{{%inventory_moo}}','id',
            'CASCADE','CASCADE'
         );
        $this->addForeignKey('fk_inventory_id_typetech',
            '{{%inventory}}','id_typetech',
            '{{%inventory_typetech}}','id',
            'CASCADE','CASCADE'
         );
        $this->addForeignKey('fk_inventory_log_id_status',
            '{{%inventory_log}}','id_status',
            '{{%inventory_status}}','id',
            'CASCADE','CASCADE'
         );
        $this->addForeignKey('fk_inventory_log_id_moo',
            '{{%inventory_log}}','id_moo',
            '{{%inventory_moo}}','id',
            'CASCADE','CASCADE'
         );
        $this->addForeignKey('fk_inventory_log_id_typetech',
            '{{%inventory_log}}','id_typetech',
            '{{%inventory_typetech}}','id',
            'CASCADE','CASCADE'
         );
        $this->addForeignKey('fk_inventory_order_status_id_invor',
            '{{%inventory_order}}','status_id_invor',
            '{{%inventory_statusorder}}','id',
            'CASCADE','CASCADE'
         );
        $this->addForeignKey('fk_inventory_parts_id_typeparts',
            '{{%inventory_parts}}','id_typeparts',
            '{{%inventory_typeparts}}','id',
            'CASCADE','CASCADE'
         );
        $this->addForeignKey('fk_inventory_parts_ligament_id_inventory_parts',
            '{{%inventory_parts_ligament}}','id_inventory_parts',
            '{{%inventory_parts}}','id',
            'CASCADE','CASCADE'
         );
        $this->addForeignKey('fk_inventory_parts_ligament_invnum_inventory',
            '{{%inventory_parts_ligament}}','invnum_inventory',
            '{{%inventory}}','invnum',
            'CASCADE','CASCADE'
         );
        $this->addForeignKey('fk_inventory_partsorder_id_partsorder_invor',
            '{{%inventory_partsorder}}','id_partsorder_invor',
            '{{%inventory_order}}','id',
            'CASCADE','CASCADE'
         );
        $this->addForeignKey('fk_inventory_statusorder_id',
            '{{%inventory_statusorder}}','id',
            '{{%inventory_statusorder}}','id',
            'CASCADE','CASCADE'
         );
    }

    public function safeDown()
    {
        $this->dropForeignKey('fk_inventory_id_status', '{{%inventory}}');
        $this->dropForeignKey('fk_inventory_id_moo', '{{%inventory}}');
        $this->dropForeignKey('fk_inventory_id_typetech', '{{%inventory}}');
        $this->dropForeignKey('fk_inventory_log_id_status', '{{%inventory_log}}');
        $this->dropForeignKey('fk_inventory_log_id_moo', '{{%inventory_log}}');
        $this->dropForeignKey('fk_inventory_log_id_typetech', '{{%inventory_log}}');
        $this->dropForeignKey('fk_inventory_order_status_id_invor', '{{%inventory_order}}');
        $this->dropForeignKey('fk_inventory_parts_id_typeparts', '{{%inventory_parts}}');
        $this->dropForeignKey('fk_inventory_parts_ligament_id_inventory_parts', '{{%inventory_parts_ligament}}');
        $this->dropForeignKey('fk_inventory_parts_ligament_invnum_inventory', '{{%inventory_parts_ligament}}');
        $this->dropForeignKey('fk_inventory_partsorder_id_partsorder_invor', '{{%inventory_partsorder}}');
        $this->dropForeignKey('fk_inventory_statusorder_id', '{{%inventory_statusorder}}');
    }
}
