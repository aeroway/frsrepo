<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;

/* @var $this yii\web\View */
/* @var $model backend\models\RegistSearch */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="regist-search">

    <?php $form = ActiveForm::begin([
        'action' => ['index'],
        'method' => 'get',
    ]); ?>

    <?= $form->field($model, 'id') ?>

    <?= $form->field($model, 'developer') ?>

    <?= $form->field($model, 'object') ?>

    <?= $form->field($model, 'registered_object') ?>

    <?= $form->field($model, 'commission') ?>

    <?php // echo $form->field($model, 'permission') ?>

    <?php // echo $form->field($model, 'registrar') ?>

    <?php // echo $form->field($model, 'file_name') ?>

    <div class="form-group">
        <?= Html::submitButton('Search', ['class' => 'btn btn-primary']) ?>
        <?= Html::resetButton('Reset', ['class' => 'btn btn-default']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
