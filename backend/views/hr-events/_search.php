<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;

/* @var $this yii\web\View */
/* @var $model backend\models\HrEventsSearch */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="hr-events-search">

    <?php $form = ActiveForm::begin([
        'action' => ['index'],
        'method' => 'get',
    ]); ?>

    <?= $form->field($model, 'id') ?>

    <?= $form->field($model, 'event_date') ?>

    <?= $form->field($model, 'event_type') ?>

    <?= $form->field($model, 'event_subject') ?>

    <?= $form->field($model, 'event_member') ?>

    <?php // echo $form->field($model, 'event_comment') ?>

    <div class="form-group">
        <?= Html::submitButton('Search', ['class' => 'btn btn-primary']) ?>
        <?= Html::resetButton('Reset', ['class' => 'btn btn-outline-secondary']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
