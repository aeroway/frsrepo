<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;

/** @var yii\web\View $this */
/** @var backend\models\SpartakiadRating $model */
/** @var yii\widgets\ActiveForm $form */
?>

<div class="spartakiad-rating-form">

    <?php $form = ActiveForm::begin(); ?>

    <?php // $form->field($model, 'department_id')->textInput() ?>

    <?= $form->field($model, 'score1')->textInput() ?>

    <?= $form->field($model, 'score2')->textInput() ?>

    <?= $form->field($model, 'score3')->textInput() ?>

    <?= $form->field($model, 'score4')->textInput() ?>

    <?= $form->field($model, 'score5')->textInput() ?>

    <?= $form->field($model, 'score6')->textInput() ?>

    <div class="form-group">
        <?= Html::submitButton('Сохранить', ['class' => 'btn btn-success']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
