<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;

/* @var $this yii\web\View */
/* @var $model backend\models\GznObjectSearch */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="gzn-object-search">

    <?php $form = ActiveForm::begin([
        'action' => ['index'],
        'method' => 'get',
    ]); ?>

    <?= $form->field($model, 'id') ?>

    <?= $form->field($model, 'gzn_type_check_id') ?>

    <?= $form->field($model, 'authoritie_check') ?>

    <?= $form->field($model, 'kn') ?>

    <?php // echo $form->field($model, 'land_num') ?>

    <?php // echo $form->field($model, 'land_area') ?>

    <?php // echo $form->field($model, 'kn_cost') ?>

    <?php // echo $form->field($model, 'order_check') ?>

    <?php // echo $form->field($model, 'act_check') ?>

    <?php // echo $form->field($model, 'date_enforcement') ?>

    <?php // echo $form->field($model, 'land_category') ?>

    <?php // echo $form->field($model, 'requisites_land_user') ?>

    <?php // echo $form->field($model, 'address_land_plot') ?>

    <?php // echo $form->field($model, 'type_func_use') ?>

    <?php // echo $form->field($model, 'description_violation') ?>

    <?php // echo $form->field($model, 'full_name_inspector') ?>

    <div class="form-group">
        <?= Html::submitButton('Search', ['class' => 'btn btn-primary']) ?>
        <?= Html::resetButton('Reset', ['class' => 'btn btn-default']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
