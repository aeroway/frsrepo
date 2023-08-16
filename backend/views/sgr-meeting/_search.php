<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;

/* @var $this yii\web\View */
/* @var $model backend\models\SgrMeetingSearch */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="sgr-meeting-search">

    <?php $form = ActiveForm::begin([
        'action' => ['index'],
        'method' => 'get',
    ]); ?>

    <?= $form->field($model, 'id') ?>

    <?= $form->field($model, 'date_event') ?>

    <?= $form->field($model, 'status') ?>

    <?= $form->field($model, 'protocol') ?>

    <?= $form->field($model, 'year') ?>

    <?php // echo $form->field($model, 'questions') ?>

    <?php // echo $form->field($model, 'questions_file') ?>

    <div class="form-group">
        <?= Html::submitButton('Search', ['class' => 'btn btn-primary']) ?>
        <?= Html::resetButton('Reset', ['class' => 'btn btn-outline-secondary']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
