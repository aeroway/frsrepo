<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;

/** @var yii\web\View $this */
/** @var backend\models\OtcheterlSearch $model */
/** @var yii\widgets\ActiveForm $form */
?>

<div class="otcheterl-search">

    <?php $form = ActiveForm::begin([
        'action' => ['index'],
        'method' => 'get',
    ]); ?>

    <?= $form->field($model, 'id') ?>

    <?= $form->field($model, 'area_id') ?>

    <?= $form->field($model, 'kuvd') ?>

    <?= $form->field($model, 'application_date') ?>

    <?= $form->field($model, 'kn') ?>

    <?= $form->field($model, 'address') ?>

    <?= $form->field($model, 'fio_reg') ?>

    <?php // echo $form->field($model, 'coordinates') ?>

    <?php // echo $form->field($model, 'draft_number') ?>

    <?php // echo $form->field($model, 'draft_date') ?>

    <?php // echo $form->field($model, 'outgoing_number') ?>

    <?php // echo $form->field($model, 'outgoing_date') ?>

    <div class="form-group">
        <?= Html::submitButton('Search', ['class' => 'btn btn-primary']) ?>
        <?= Html::resetButton('Reset', ['class' => 'btn btn-outline-secondary']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
