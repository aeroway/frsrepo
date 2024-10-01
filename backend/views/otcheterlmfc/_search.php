<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;

/** @var yii\web\View $this */
/** @var backend\models\OtcheterlmfcSearch $model */
/** @var yii\widgets\ActiveForm $form */
?>

<div class="otcheterlmfc-search">

    <?php $form = ActiveForm::begin([
        'action' => ['index'],
        'method' => 'get',
    ]); ?>

    <?= $form->field($model, 'id') ?>

    <?= $form->field($model, 'area_id') ?>

    <?= $form->field($model, 'ref_num') ?>

    <?= $form->field($model, 'application_date') ?>

    <?= $form->field($model, 'address') ?>

    <?php // echo $form->field($model, 'fio_mfc') ?>

    <?php // echo $form->field($model, 'description') ?>

    <?php // echo $form->field($model, 'username') ?>

    <?php // echo $form->field($model, 'date_create') ?>

    <div class="form-group">
        <?= Html::submitButton('Search', ['class' => 'btn btn-primary']) ?>
        <?= Html::resetButton('Reset', ['class' => 'btn btn-outline-secondary']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
