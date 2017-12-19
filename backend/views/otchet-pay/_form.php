<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;

/* @var $this yii\web\View */
/* @var $model backend\models\OtchetPay */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="otchet-pay-form">

    <?php $form = ActiveForm::begin(); ?>

    <?php //$form->field($model, 'number')->textInput() ?>

    <?php //$form->field($model, 'payer_name')->textInput() ?>

    <?php //$form->field($model, 'sum')->textInput() ?>

    <?php //$form->field($model, 'payer_id')->textInput() ?>

    <?php //$form->field($model, 'payer_date')->textInput() ?>

    <?php //$form->field($model, 'note')->textInput() ?>

    <?php //$form->field($model, 'date_load')->textInput() ?>

    <?= $form->field($model, 'status')->dropDownList(
            [
                'Исправлен' => 'Исправлен',
                'Невозможно исправить' => 'Невозможно исправить',
                'В работе' => 'В работе'
            ],
            ['prompt'=>'Выберите Статус']
    ) ?>

    <?= $form->field($model, 'username')->textInput(['readonly' => true, 'value' => '23UPR\\' . Yii::$app->user->identity->username]) ?>

    <?= $form->field($model, 'date')->textInput(['readonly' => true, 'value' => date("Y-m-d H:i:s") ]) ?>

    <?= $form->field($model, 'flag')->hiddenInput(['value' => '0'])->label(false) ?>

    <div class="form-group">
        <?= Html::submitButton($model->isNewRecord ? 'Создать' : 'Редактировать', ['class' => $model->isNewRecord ? 'btn btn-success' : 'btn btn-primary']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
