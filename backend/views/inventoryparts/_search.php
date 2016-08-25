<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;

/* @var $this yii\web\View */
/* @var $model app\models\InventoryPartsSearch */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="inventory-parts-search">

    <?php $form = ActiveForm::begin([
        'action' => ['index'],
        'method' => 'get',
    ]); ?>

    <?= $form->field($model, 'id') ?>

    <?= $form->field($model, 'nameparts') ?>

    <?= $form->field($model, 'id_typeparts') ?>

    <?= $form->field($model, 'amount') ?>

    <?= $form->field($model, 'location') ?>

    <?= $form->field($model, 'comment_parts') ?>

    <div class="form-group">
        <?= Html::submitButton('Search', ['class' => 'btn btn-primary']) ?>
        <?= Html::resetButton('Reset', ['class' => 'btn btn-default']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
