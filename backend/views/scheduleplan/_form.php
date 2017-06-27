<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;
use yii\helpers\ArrayHelper;
use backend\models\PurchaseMethod;
use yii\jui\DatePicker;

/* @var $this yii\web\View */
/* @var $model backend\models\SchedulePlan */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="schedule-plan-form">

<?php
    if(Yii::$app->session->hasFlash('false'))
        echo "<div class='alert alert-danger'>" . Yii::$app->session->getFlash('false') . "</div>";
?>

    <?php $form = ActiveForm::begin(); ?>

    <?= $form->field($model, 'name')->textInput() ?>

    <?= $form->field($model, 'sum')->textInput() ?>

    <?= $form->field($model, 'comment')->textInput() ?>

    <?= $form->field($model, 'sum_fact')->textInput() ?>

    <?= $form->field($model, 'pm_id')->dropDownList(
            ArrayHelper::map(PurchaseMethod::find()->orderBy(['name' => SORT_ASC])->all(), 'id', 'name'),
            ['prompt'=>'Выберите способ закупки']
    ); ?>

    <?= $form->field($model, 'pp_id')->hiddenInput(['value' => $sid])->label(false); ?>

    <?= $form->field($model, 'name_doc')->textInput() ?>


    <?= $form->field($model, 'date_doc')->widget(DatePicker::classname(), ['language' => 'ru', 'dateFormat' => 'yyyy-MM-dd', 'options' => ['class' => 'form-control'],]) ?>

    <?= $form->field($model, 'date_exp_from')->widget(DatePicker::classname(), ['language' => 'ru', 'dateFormat' => 'yyyy-MM-dd', 'options' => ['class' => 'form-control'],]) ?>

    <?= $form->field($model, 'date_exp_to')->widget(DatePicker::classname(), ['language' => 'ru', 'dateFormat' => 'yyyy-MM-dd', 'options' => ['class' => 'form-control'],]) ?>

    <?= $form->field($model, 'inn')->textInput() ?>

    <?= $form->field($model, 'name_org')->textInput() ?>

    <div class="form-group">
        <?= Html::submitButton($model->isNewRecord ? 'Создать' : 'Редактировать', ['class' => $model->isNewRecord ? 'btn btn-success' : 'btn btn-primary']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
