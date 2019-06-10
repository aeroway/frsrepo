<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;

/* @var $this yii\web\View */
/* @var $model backend\models\EmplEcpSearch */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="empl-ecp-search">

    <?php $form = ActiveForm::begin([
        'action' => ['index'],
        'method' => 'get',
    ]); ?>

    <?= $form->field($model, 'id') ?>

    <?= $form->field($model, 'idm_empl') ?>

    <?= $form->field($model, 'ecp_start') ?>

    <?= $form->field($model, 'ecp_stop') ?>

    <?= $form->field($model, 'ecp_org_id') ?>

    <?php // echo $form->field($model, 'ecpmodify_date') ?>

    <?php // echo $form->field($model, 'status') ?>

    <?php // echo $form->field($model, 'nositel_num') ?>

    <?php // echo $form->field($model, 'nositel_type') ?>

    <?php // echo $form->field($model, 'date_in') ?>

    <?php // echo $form->field($model, 'req_date') ?>

    <?php // echo $form->field($model, 'user_in') ?>

    <div class="form-group">
        <?= Html::submitButton('Search', ['class' => 'btn btn-primary']) ?>
        <?= Html::resetButton('Reset', ['class' => 'btn btn-default']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
