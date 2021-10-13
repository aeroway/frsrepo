<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;

/* @var $this yii\web\View */
/* @var $model backend\models\Otvet */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="otvet-form">

    <?php $form = ActiveForm::begin(); ?>

    <?= $form->field($model, 'text')->textInput(['maxlength' => true]) ?>

    <?php // $form->field($model, 'vopros_id')->textInput() ?>

    <?= $form->field($model, 'pr')->dropDownList(
            ['0' => 'Нет','1' => 'Да'],
            ['prompt'=>'Выберите из списка']
    ) ?>

    <div class="form-group">
        <?= Html::submitButton('Сохранить', ['class' => 'btn btn-success']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
