<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;

/* @var $this yii\web\View */
/* @var $model backend\models\XmlAnalysisSearch */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="xml-analysis-search">

    <?php $form = ActiveForm::begin([
        'action' => ['index'],
        'method' => 'get',
    ]); ?>

    <?= $form->field($model, 'kn') ?>

    <?= $form->field($model, 'knGroup')->hint('Разделитель точка с запятой ;') ?>

    <?php // echo $form->field($model, 'address') ?>

    <?=$form->field($model, 'filename') ?>

    <?php // echo $form->field($model, 'id') ?>

    <div class="form-group">
        <?= Html::submitButton('Поиск', ['class' => 'btn btn-primary']) ?>
        <?php // echo Html::resetButton('Reset', ['class' => 'btn btn-outline-secondary']) ?>
        <?= Html::a(NULL, ['index'], ['class' => 'btn btn-warning glyphicon glyphicon-refresh', 'title' => 'Сброс фильтров']); ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
