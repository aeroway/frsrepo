<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;

/* @var $this yii\web\View */
/* @var $model backend\models\Otchetn */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="otchetn-form">

    <?php $form = ActiveForm::begin(); ?>

    <?php //= $form->field($model, 'area')->textInput() ?>

	<?= $form->field($model, 'status')->dropDownList(
			['Исправлен' => 'Исправлен','Невозможно исправить' => 'Невозможно исправить','В работе' => 'В работе'],
			['prompt'=>'Выберите Статус']
	) ?>

	<?= $form->field($model, 'reason1')->dropDownList(
			[
				'Не поставлен на кадастровый учёт' => 'Не поставлен на кадастровый учёт',
				'Отправлен на постановку на КУ, но ответ не поступил от КП' => 'Отправлен на постановку на кадастровый учёт, но ответ не поступил от КП',
				'Объект состоит на КУ, но сведения о КН не внесены в ЕГРП' => 'Объект состоит на КУ, но сведения о КН не внесены в ЕГРП'
			],
			['prompt'=>'Выберите причину']
	) ?>

    <?= $form->field($model, 'reason2')->textInput(['placeholder' => 'Количество объектов недвижимости с разбивкой по причинам']) ?>

    <?= $form->field($model, 'offer')->textInput(['placeholder' => 'Предложения по выходу из ситуации (по каждому блоку причин)']) ?>

    <?= $form->field($model, 'comment')->textInput() ?>

	<?= $form->field($model, 'dateon')->textInput(['readonly' => true, 'value' => date("Y-m-d H:i:s") ]) ?>

	<?= $form->field($model, 'usernameon')->textInput(['readonly' => true, 'value' => '23UPR\\' . Yii::$app->user->identity->username]) ?>

	<?= $form->field($model, 'flag')->hiddenInput(['value' => '0'])->label(false) ?>

    <?php //=$form->field($model, 'condnum')->textInput() ?>

    <div class="form-group">
        <?= Html::submitButton($model->isNewRecord ? 'Create' : 'Update', ['class' => $model->isNewRecord ? 'btn btn-success' : 'btn btn-primary']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
