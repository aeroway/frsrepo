<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;
use dosamigos\ckeditor\CKEditor;

/* @var $this yii\web\View */
/* @var $model backend\models\SgrMeeting */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="sgr-meeting-form">

    <?php $form = ActiveForm::begin(); ?>

    <?= $form->field($model, 'questions')->widget(CKEditor::className(), [
		'options' => ['rows' => 6],
		'preset' => 'standard'
	]) ?>

    <?= $form->field($model, 'questions_file')->fileInput() ?>

    <?= $form->field($model, 'dateTimeEvent')->textInput(['value' => empty($model->date_event) ? date('d.m.Y H:i') : $model->getDateEvent($model->date_event)]) ?>

    <?= $form->field($model, 'status')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'protocol')->fileInput() ?>


    <div class="form-group">
        <?= Html::submitButton('Сохранить', ['class' => 'btn btn-success']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
