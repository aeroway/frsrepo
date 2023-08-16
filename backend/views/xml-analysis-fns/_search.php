<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;

/* @var $this yii\web\View */
/* @var $model backend\models\XmlAnalysisFnsSearch */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="xml-analysis-fns-search">

    <?php $form = ActiveForm::begin([
        'action' => ['index'],
        'method' => 'get',
    ]); ?>

    <?= $form->field($model, 'kn') ?>

    <?php // echo $form->field($model, 'address') ?>

    <?php // echo $form->field($model, 'filename') ?>

    <?php // echo $form->field($model, 'id') ?>

    <div class="form-group">
        <?= Html::submitButton('Поиск', ['class' => 'btn btn-primary']) ?>
        <?php // echo Html::resetButton('Reset', ['class' => 'btn btn-outline-secondary']) ?>
        <?= Html::a(NULL, ['index'], ['class' => 'btn btn-warning glyphicon glyphicon-refresh', 'title' => 'Сброс фильтров']); ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
