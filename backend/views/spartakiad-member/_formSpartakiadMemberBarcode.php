<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;

/* @var $this yii\web\View */
/* @var $model frontend\models\SpartakiadMember */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="spartakiad-member-form-barcode">

    <?php $form = ActiveForm::begin(); ?>

    <?= $form->field($model, 'guidBarcode')->textInput(['autofocus' => 'autofocus', 'style' => 'width: 300px;']) ?>

    <?php ActiveForm::end(); ?>

</div>