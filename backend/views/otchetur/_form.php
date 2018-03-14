<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;

/* @var $this yii\web\View */
/* @var $model backend\models\Otchetur */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="otchetur-form">

    <?php $form = ActiveForm::begin(); ?>

    <?php /* $form->field($model, 'number_book')->textInput() */ ?>

    <?php /* $form->field($model, 'full_name')->textInput() */ ?>

    <?php /* $form->field($model, 'inn')->textInput() */ ?>

    <?php /* $form->field($model, 'name')->textInput() */ ?>

    <?php /* $form->field($model, 'kn')->textInput() */ ?>

    <?php /* $form->field($model, 'adr_txt')->textInput() */ ?>

    <?php /* $form->field($model, 'name1')->textInput() */ ?>

    <?php /* $form->field($model, 'name2')->textInput() */ ?>

    <?php /* $form->field($model, 'name3')->textInput() */ ?>

    <?php /* $form->field($model, 'fl')->textInput() */ ?>

    <?= $form->field($model, 'status')->dropDownList(
            [
                'Исправлен' => 'Исправлен',
                'Невозможно исправить' => 'Невозможно исправить',
                'В работе' => 'В работе'
            ],
            ['prompt'=>'Выберите Статус']
    ) ?>

    <?= $form->field($model, 'comment')->textInput() ?>

    <?php /* $form->field($model, 'date')->textInput() */ ?>

    <?php /* $form->field($model, 'username')->textInput() */ ?>

    <?php /* $form->field($model, 'flag')->textInput() */ ?>

    <?php /* $form->field($model, 'filename')->textInput() */ ?>

    <?php /* $form->field($model, 'date_update')->textInput() */ ?>

    <?php /* $form->field($model, 'date_load')->textInput() */ ?>

    <?= $form->field($model, 'cost')->textInput() ?>

    <?= $form->field($model, 'username')->textInput(['readonly' => true, 'value' => '23UPR\\' . Yii::$app->user->identity->username]) ?>

    <?= $form->field($model, 'date')->textInput(['readonly' => true, 'value' => date("Y-m-d H:i:s") ]) ?>

    <?= $form->field($model, 'flag')->hiddenInput(['value' => '0'])->label(false) ?>

    <div class="form-group">
        <?= Html::submitButton('Сохранить', ['class' => 'btn btn-success']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
