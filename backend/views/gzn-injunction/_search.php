<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;

/* @var $this yii\web\View */
/* @var $model backend\models\GznInjunctionSearch */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="gzn-injunction-search">

    <?php $form = ActiveForm::begin([
        'action' => ['index'],
        'method' => 'get',
    ]); ?>

    <?= $form->field($model, 'id') ?>

    <?= $form->field($model, 'count_term_execution') ?>

    <?= $form->field($model, 'act_checking') ?>

    <?= $form->field($model, 'not_done') ?>

    <?= $form->field($model, 'repeated') ?>

    <?php // echo $form->field($model, 'decision_judge') ?>

    <?php // echo $form->field($model, 'date_protocol') ?>

    <?php // echo $form->field($model, 'decision_judge_j') ?>

    <?php // echo $form->field($model, 'disobedience') ?>

    <?php // echo $form->field($model, 'gzn_violations_id') ?>

    <div class="form-group">
        <?= Html::submitButton('Search', ['class' => 'btn btn-primary']) ?>
        <?= Html::resetButton('Reset', ['class' => 'btn btn-default']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
