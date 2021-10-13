<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;

/* @var $this yii\web\View */
/* @var $model backend\models\InventoryRepair */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="inventory-repair-form">

    <?php $form = ActiveForm::begin(); ?>

    <div class="form-group">
        <?= Html::submitButton('Сохранить', ['class' => 'btn btn-success']) ?>
    </div>

    <?= $form->field($model, 'area')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'name')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'invnum')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'inventory_moo')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'inventory_status')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'note')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'email')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'username')->hiddenInput(['readonly' => true, 'value' => Yii::$app->user->identity->username])->label(false) ?>

    <?= $form->field($model, 'date_edit')->hiddenInput(['readonly' => true, 'value' => date("Y-m-d H:i:s")])->label(false) ?>

    <?php ActiveForm::end(); ?>

</div>
