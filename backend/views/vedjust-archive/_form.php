<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;

/* @var $this yii\web\View */
/* @var $model backend\models\VedomostCheckForm */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="vedomost-check-form-form">

    <?php $form = ActiveForm::begin(); ?>

    <?php // echo $form->field($model, 'date_in')->textInput(['readonly' => true, 'value' => date("Y-m-d H:i:s") ]) ?>

    <?= $form->field($model, 'vedomost_num')->textInput() ?>

    <?php // echo $form->field($model, 'user_in')->textInput(['readonly' => true, 'value' => Yii::$app->user->identity->username]) ?>

    <?php // echo $form->field($model, 'vedomost_date')->textInput() ?>

    <?php // echo $form->field($model, 'vedomost_res')->textInput() ?>

    <?php // echo $form->field($model, 'check_type')->textInput() ?>

    <?php // echo $form->field($model, 'module')->textInput(['maxlength' => true]) ?>

    <?php // echo $form->field($model, 'sektors_ip')->textInput() ?>

    <div class="form-group">
        <?= Html::submitButton('Сохранить', ['class' => 'btn btn-success']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
