<?php

use yii\db\Schema;
use yii\db\Migration;

class m171225_072712_gzn_injunction extends Migration
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
            '{{%gzn_injunction}}',
            [
                'id'=> $this->primaryKey(),
                'count_term_execution'=> $this->smallInteger()->null()->defaultValue(null),
                'act_checking'=> $this->string()->null()->defaultValue(null),
                'not_done'=> $this->string()->null()->defaultValue(null),
                'repeated'=> $this->string()->null()->defaultValue(null),
                'decision_judge'=> $this->string()->null()->defaultValue(null),
                'amount_fine'=> $this->float()->null()->defaultValue(null),
                'amount_fine_collected'=> $this->float()->null()->defaultValue(null),
                'date_protocol'=> $this->datetime()->null()->defaultValue(null),
                'decision_judge_j'=> $this->string()->null()->defaultValue(null),
                'amount_fine_j'=> $this->float()->null()->defaultValue(null),
                'amount_fine_collected_j'=> $this->float()->null()->defaultValue(null),
                'disobedience'=> $this->string()->null()->defaultValue(null),
                'obstruction'=> $this->string()->null()->defaultValue(null),
                'reasons_impossibility'=> $this->string()->null()->defaultValue(null),
                'repeated_j2'=> $this->string()->null()->defaultValue(null),
                'decision_judge_j2'=> $this->string()->null()->defaultValue(null),
                'amount_fine_j2'=> $this->float()->null()->defaultValue(null),
                'amount_fine_collected_j2'=> $this->float()->null()->defaultValue(null),
                'gzn_violations_id'=> $this->integer()->null()->defaultValue(null),
            ],$tableOptions
        );

    }

    public function safeDown()
    {
        $this->dropTable('{{%gzn_injunction}}');
    }
}
