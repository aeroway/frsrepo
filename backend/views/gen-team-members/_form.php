<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;

/** @var yii\web\View $this */
/** @var backend\models\GenTeamMembers $model */
/** @var yii\widgets\ActiveForm $form */
?>

<div class="gen-team-members-form">

    <?php $form = ActiveForm::begin(); ?>

    <?= $form->field($model, 'full_name')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'position')->dropDownList(
            ['Участник' => 'Участник', 'Модератор' => 'Модератор', 'Жюри' => 'Жюри', 'Зритель' => 'Зритель', 'Специалист' => 'Специалист'],
            ['prompt'=>'Выберите']
    ) ?>

    <?= $form->field($model, 'agency_id')->dropDownList(
            ['1' => 'УРР', '2' => 'ППК', '3' => 'РБ'],
            ['prompt'=>'Выберите']
    ) ?>

    <div class="form-group">
        <?= Html::submitButton('Сохранить', ['class' => 'btn btn-success']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
