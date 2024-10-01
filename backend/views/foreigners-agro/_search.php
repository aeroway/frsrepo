<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;

/** @var yii\web\View $this */
/** @var backend\models\ForeignersAgroSearch $model */
/** @var yii\widgets\ActiveForm $form */
?>

<div class="foreigners-agro-search">

    <?php $form = ActiveForm::begin([
        'action' => ['index'],
        'method' => 'get',
    ]); ?>

    <?= $form->field($model, 'id') ?>

    <?= $form->field($model, 'kn') ?>

    <?= $form->field($model, 'address') ?>

    <?= $form->field($model, 'category') ?>

    <?= $form->field($model, 'permit_use') ?>

    <?php // echo $form->field($model, 'num_reg') ?>

    <?php // echo $form->field($model, 'date_reg') ?>

    <?php // echo $form->field($model, 'date_term_right') ?>

    <?php // echo $form->field($model, 'fio') ?>

    <?php // echo $form->field($model, 'citizenship') ?>

    <?php // echo $form->field($model, 'notice_ogv_oms') ?>

    <?php // echo $form->field($model, 'notice_prosecutor') ?>

    <?php // echo $form->field($model, 'sent_claims_ogv') ?>

    <?php // echo $form->field($model, 'notice_interior_portal') ?>

    <div class="form-group">
        <?= Html::submitButton('Search', ['class' => 'btn btn-primary']) ?>
        <?= Html::resetButton('Reset', ['class' => 'btn btn-outline-secondary']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
