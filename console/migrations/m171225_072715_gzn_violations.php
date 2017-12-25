<?php

use yii\db\Schema;
use yii\db\Migration;

class m171225_072715_gzn_violations extends Migration
{

    public function init()
    {
        $this->db = 'db';
        parent::init();
    }

    public function safeUp()
    {
        $tableOptions = 'ENGINE=InnoDB';

        $this->createTable(
            '{{%gzn_violations}}',
            [
                'id'=> $this->primaryKey(),
                'gzn_obj_id'=> $this->integer()->null()->defaultValue(null),
                'code_koap'=> $this->string()->null()->defaultValue(null),
                'decision_punishment'=> $this->string()->null()->defaultValue(null),
                'date_due'=> $this->datetime()->null()->defaultValue(null),
                'amount_fine'=> $this->float()->null()->defaultValue(null),
                'amount_fine_collected'=> $this->float()->null()->defaultValue(null),
                'payment_doc'=> $this->string()->null()->defaultValue(null),
                'decision_cancellation'=> $this->string()->null()->defaultValue(null),
                'decision_termination'=> $this->string()->null()->defaultValue(null),
                'instruction_elimination'=> $this->string()->null()->defaultValue(null),
                'decision_appeal'=> $this->string()->null()->defaultValue(null),
            ],$tableOptions
        );

    }

    public function safeDown()
    {
        $this->dropTable('{{%gzn_violations}}');
    }
}
