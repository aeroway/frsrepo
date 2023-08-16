<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;

/* @var $this yii\web\View */
/* @var $model backend\models\Otchetfns */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="otchetfns-form">

    <?php $form = ActiveForm::begin(); ?>

    <?php // echo $form->field($model, 'area')->textInput(['maxlength' => true]) ?>

    <?php // echo $form->field($model, 'type_obj')->textInput(['maxlength' => true]) ?>

    <?php // echo $form->field($model, 'kn')->textInput(['maxlength' => true]) ?>

    <?php // echo $form->field($model, 'address')->textInput(['maxlength' => true]) ?>

    <?php // echo $form->field($model, 'category')->textInput(['maxlength' => true]) ?>

    <?php // echo $form->field($model, 'permit_use')->textInput(['maxlength' => true]) ?>

    <?php // echo $form->field($model, 'square')->textInput(['maxlength' => true]) ?>

    <?php // echo $form->field($model, 'date_reg')->textInput() ?>

    <?php // echo $form->field($model, 'info_tax')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'flag')->hiddenInput(['value' => '0'])->label(false) ?>

    <?= $form->field($model, 'status')->dropDownList(
            ['Взят в работу (ОМС)' => 'Взят в работу (ОМС)', 'Снят с учёта' => 'Снят с учёта', 'Выявлен правообладатель (внесено в ЕГРН)' => 'Выявлен правообладатель (внесено в ЕГРН)', 'Зарегистрировано право' => 'Зарегистрировано право', 'Не подлежит выявлению' => 'Не подлежит выявлению'],
            ['prompt'=>'Выберите']
    ) ?>

    <?= $form->field($model, 'info_gfd')->dropDownList(
            ['Да' => 'Да', 'Нет' => 'Нет'],
            ['prompt'=>'Выберите']
    ) ?>

    <?php /* echo $form->field($model, 'in_process')->dropDownList(
            ['Да' => 'Да', 'Нет' => 'Нет'],
            ['prompt'=>'Выберите']
    ) */ ?>

    <?php /* echo $form->field($model, 'remove_reg')->dropDownList(
            ['Да' => 'Да', 'Нет' => 'Нет'],
            ['prompt'=>'Выберите']
    ) */ ?>

    <?php /* echo $form->field($model, 'identified')->dropDownList(
            ['Да' => 'Да', 'Нет' => 'Нет'],
            ['prompt'=>'Выберите']
    ) */ ?>

    <?= $form->field($model, 'comment')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'date')->textInput(['readonly' => true, 'value' => date("Y-m-d H:i:s") ]) ?>

    <?= $form->field($model, 'username')->textInput(['readonly' => true, 'value' => Yii::$app->user->identity->username]) ?>

    <?php // echo $form->field($model, 'filename')->textInput(['maxlength' => true]) ?>

    <?php // echo $form->field($model, 'date_update')->textInput() ?>

    <?php // echo $form->field($model, 'date_load')->textInput() ?>

    <div class="form-group">
        <?= Html::submitButton('Сохранить', ['class' => 'btn btn-success']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
