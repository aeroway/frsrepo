<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;

/* @var $this yii\web\View */
/* @var $model backend\models\Otchet */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="otchet-form">

    <?php $form = ActiveForm::begin(); ?>

    <?= $form->field($model, 'kn')->textInput(['readonly' => true]) ?>

    <?= $form->field($model, 'description')->textInput() ?>

	<?= $form->field($model, 'status')->dropDownList(
			['Исправлен' => 'Исправлен','Невозможно исправить' => 'Невозможно исправить','В работе' => 'В работе'],
			['prompt'=>'Выберите Статус']
	) ?>

    <?= $form->field($model, 'comment')->textArea(['placeholder' => 'Текст уведомления о внесённых изменениях для уведомления правообладателя.']) ?>

	<?= $form->field($model, 'date')->textInput(['readonly' => true, 'value' => date("Y-m-d H:i:s") ]) ?>

	<?= $form->field($model, 'username')->textInput(['readonly' => true, 'value' => '23UPR\\' . Yii::$app->user->identity->username]) ?>

	<?= $form->field($model, 'flag')->hiddenInput(['value' => '0'])->label(false) ?>

	<?= $form->field($model, 'protocol')->textInput() ?>

    <div class="form-group">
        <?= Html::submitButton($model->isNewRecord ? 'Создать' : 'Обновить', ['class' => $model->isNewRecord ? 'btn btn-success' : 'btn btn-primary']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
