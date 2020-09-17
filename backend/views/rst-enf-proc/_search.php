<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;

/* @var $this yii\web\View */
/* @var $model backend\models\RstEnfProcSearch */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="rst-enf-proc-search">

    <?php $form = ActiveForm::begin([
        'action' => ['index'],
        'method' => 'get',
    ]); ?>

    <?= $form->field($model, 'id') ?>

    <?= $form->field($model, 'otdel_id') ?>

    <?= $form->field($model, 'num_req') ?>

    <?= $form->field($model, 'agency') ?>

    <?= $form->field($model, 'num_enf_proc') ?>

    <?php // echo $form->field($model, 'decision') ?>

    <?php // echo $form->field($model, 'num_notice') ?>

    <?php // echo $form->field($model, 'num_appeal') ?>

    <?php // echo $form->field($model, 'date_edit') ?>

    <?php // echo $form->field($model, 'username') ?>

    <?php // echo $form->field($model, 'result') ?>

    <?php // echo $form->field($model, 'comment') ?>

    <div class="form-group">
        <?= Html::submitButton('Search', ['class' => 'btn btn-primary']) ?>
        <?= Html::resetButton('Reset', ['class' => 'btn btn-outline-secondary']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
