<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;

/* @var $this yii\web\View */
/* @var $model backend\models\OtcheturSearch */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="otchetur-search">

    <?php $form = ActiveForm::begin([
        'action' => ['index'],
        'method' => 'get',
    ]); ?>

    <?= $form->field($model, 'id') ?>

    <?= $form->field($model, 'number_book') ?>

    <?= $form->field($model, 'full_name') ?>

    <?= $form->field($model, 'inn') ?>

    <?= $form->field($model, 'name') ?>

    <?php // echo $form->field($model, 'kn') ?>

    <?php // echo $form->field($model, 'adr_txt') ?>

    <?php // echo $form->field($model, 'name1') ?>

    <?php // echo $form->field($model, 'name2') ?>

    <?php // echo $form->field($model, 'name3') ?>

    <?php // echo $form->field($model, 'fl') ?>

    <?php // echo $form->field($model, 'status') ?>

    <?php // echo $form->field($model, 'comment') ?>

    <?php // echo $form->field($model, 'date') ?>

    <?php // echo $form->field($model, 'username') ?>

    <?php // echo $form->field($model, 'flag') ?>

    <?php // echo $form->field($model, 'filename') ?>

    <?php // echo $form->field($model, 'date_update') ?>

    <?php // echo $form->field($model, 'date_load') ?>

    <?php // echo $form->field($model, 'cost') ?>

    <div class="form-group">
        <?= Html::submitButton('Search', ['class' => 'btn btn-primary']) ?>
        <?= Html::resetButton('Reset', ['class' => 'btn btn-default']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
