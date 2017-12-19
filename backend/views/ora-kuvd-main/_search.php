<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;

/* @var $this yii\web\View */
/* @var $model backend\models\OraKuvdMainSearch */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="ora-kuvd-main-search">

    <?php $form = ActiveForm::begin([
        'action' => ['index'],
        'method' => 'get',
    ]); ?>

    <?= $form->field($model, 'id') ?>

    <?= $form->field($model, 'otdel') ?>

    <?= $form->field($model, 'fio') ?>

    <?= $form->field($model, 'kuvd') ?>

    <?= $form->field($model, 'date_receipt') ?>

    <?php // echo $form->field($model, 'version') ?>

    <?php // echo $form->field($model, 'is_top') ?>

    <?php // echo $form->field($model, 'date_version') ?>

    <?php // echo $form->field($model, 'status') ?>

    <?php // echo $form->field($model, 'date_issue') ?>

    <?php // echo $form->field($model, 'kuvd_id') ?>

    <?php // echo $form->field($model, 'date_load') ?>

    <div class="form-group">
        <?= Html::submitButton('Search', ['class' => 'btn btn-primary']) ?>
        <?= Html::resetButton('Reset', ['class' => 'btn btn-default']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
