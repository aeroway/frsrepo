<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;

/* @var $this yii\web\View */
/* @var $model backend\models\Lbo */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="lbo-form">

    <?php $form = ActiveForm::begin(); ?>

    <?= $form->field($model, 'sum')->textInput() ?>

    <?= $form->field($model, 'comment')->textInput() ?>

    <?= $form->field($model, 'year')->textInput() ?>

    <?= $form->field($model, 'date')->textInput(['readonly' => true, 'value' => date("Y-m-d H:i:s") ]) ?>

    <div class="form-group">
        <?= Html::submitButton($model->isNewRecord ? 'Создать' : 'Редактировать', ['class' => $model->isNewRecord ? 'btn btn-success' : 'btn btn-primary']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
