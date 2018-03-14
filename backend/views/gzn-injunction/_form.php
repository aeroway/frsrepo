<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;
use kartik\select2\Select2;
use yii\helpers\ArrayHelper;
use backend\models\GznViolations;
use yii\jui\DatePicker;

/* @var $this yii\web\View */
/* @var $model backend\models\GznInjunction */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="gzn-injunction-form">

    <?php $form = ActiveForm::begin(); ?>

    <div class="row">
        <div class="col-md-4">
        <?= $form->field($model, 'count_term_execution')->widget(DatePicker::classname(), ['language' => 'ru', 'dateFormat' => 'yyyy-MM-dd','options' => ['class' => 'form-control'],]) ?>
        <?= $form->field($model, 'not_done')->textInput()->widget(DatePicker::classname(), ['language' => 'ru', 'dateFormat' => 'yyyy-MM-dd','options' => ['class' => 'form-control'],]) ?>
        <?= $form->field($model, 'act_checking')->textInput() ?>
        </div>
        <div class="col-md-4">
        <?= $form->field($model, 'date_protocol')->widget(DatePicker::classname(), ['language' => 'ru', 'dateFormat' => 'yyyy-MM-dd','options' => ['class' => 'form-control'],]) ?>
        <?= $form->field($model, 'repeated')->widget(DatePicker::classname(), ['language' => 'ru', 'dateFormat' => 'yyyy-MM-dd','options' => ['class' => 'form-control'],]) ?>
        <?= $form->field($model, 'decision_judge')->widget(DatePicker::classname(), ['language' => 'ru', 'dateFormat' => 'yyyy-MM-dd','options' => ['class' => 'form-control'],]) ?>
        </div>
        <div class="col-md-4">
        <?= $form->field($model, 'decision_judge_j')->textInput() ?>
        <?= $form->field($model, 'disobedience')->textInput() ?>
        <?php
        if(strpos(Yii::$app->request->get("r"), 'create')) {
            if (!empty($_GET['sid'])) {
                echo $form->field($model, 'gzn_violations_id')->hiddenInput(['value' => $_GET['sid']])->label(false);
            } else {
                echo $form->field($model, 'gzn_violations_id')->widget(Select2::classname(), [
                    'data' => ArrayHelper::map(GznViolations::find()->orderBy(['decision_punishment' => SORT_ASC])->all(), 'id', 'decision_punishment'),
                    'language' => 'ru',
                    'options' => ['placeholder' => 'Выберите нарушение'],
                    'pluginOptions' => [
                        'allowClear' => true
                    ],
                ]);
            }
        } else {
            echo $form->field($model, 'gzn_violations_id')->hiddenInput(['value' => $model->gzn_violations_id])->label(false);
        }
        ?>
        </div>
    </div>

    <div class="form-group">
        <?= Html::submitButton($model->isNewRecord ? 'Создать' : 'Сохранить', ['class' => $model->isNewRecord ? 'btn btn-success' : 'btn btn-primary']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
