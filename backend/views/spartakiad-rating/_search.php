<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;

/** @var yii\web\View $this */
/** @var backend\models\SpartakiadRatingSearch $model */
/** @var yii\widgets\ActiveForm $form */
?>

<div class="spartakiad-rating-search">

    <?php $form = ActiveForm::begin([
        'action' => ['index'],
        'method' => 'get',
    ]); ?>

    <?= $form->field($model, 'id') ?>

    <?= $form->field($model, 'department_id') ?>

    <?= $form->field($model, 'score1') ?>

    <?= $form->field($model, 'score2') ?>

    <?= $form->field($model, 'score3') ?>

    <?php // echo $form->field($model, 'score4') ?>

    <?php // echo $form->field($model, 'score5') ?>

    <?php // echo $form->field($model, 'score6') ?>

    <div class="form-group">
        <?= Html::submitButton('Search', ['class' => 'btn btn-primary']) ?>
        <?= Html::resetButton('Reset', ['class' => 'btn btn-outline-secondary']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
