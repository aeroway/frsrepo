<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;

/* @var $this yii\web\View */
/* @var $model backend\models\Otchetlist */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="otchetlist-form">

    <?php $form = ActiveForm::begin(); ?>

    <?= $form->field($model, 'name_list')->textInput() ?>

    <?= $form->field($model, 'table_list')->textInput() ?>

    <?= $form->field($model, 'status_list')->textInput() ?>

    <?= $form->field($model, 'description_list')->textarea(['rows' => 6]) ?>

    <div class="form-group">
        <?= Html::submitButton($model->isNewRecord ? 'Create' : 'Update', ['class' => $model->isNewRecord ? 'btn btn-success' : 'btn btn-primary']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
