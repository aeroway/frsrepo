<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;

/* @var $this yii\web\View */
/* @var $model backend\models\GznObjectSearch */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="gzn-object-search">

    <?php $form = ActiveForm::begin([
        'action' => ['index'],
        'method' => 'get',
    ]); ?>

    <?= $form->field($model, 'date_check', [
            'template' => '<div class="input-group col-xs-2">{input}<span class="input-group-btn">' .
            Html::submitButton('Поиск', ['class' => 'btn btn-default']) . '</span></div>',
        ])->textInput(['placeholder' => 'Год']);
    ?>

    <?php // echo $form->field($model, 'description_violation') ?>

    <?php ActiveForm::end(); ?>

</div>
