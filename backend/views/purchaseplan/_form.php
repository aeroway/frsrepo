<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;
use yii\helpers\ArrayHelper;
use backend\models\Lbo;

/* @var $this yii\web\View */
/* @var $model backend\models\PurchasePlan */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="purchase-plan-form">

<?php
    if(Yii::$app->session->hasFlash('false'))
        echo "<div class='alert alert-danger'>" . Yii::$app->session->getFlash('false') . "</div>";
?>

    <?php $form = ActiveForm::begin(); ?>

    <?= $form->field($model, 'type')->textInput() ?>

    <?= $form->field($model, 'okpd')->textInput() ?>

    <?= $form->field($model, 'name_object')->textInput() ?>

    <?= $form->field($model, 'outlay')->textInput() ?>

    <?= $form->field($model, 'p_year')->textInput() ?>

    <?= $form->field($model, 'c_year')->textInput() ?>

    <?= $form->field($model, 'special')->textInput() ?>

    <?= $form->field($model, 'sum')->textInput() ?>

    <?= $form->field($model, 'year')->dropDownList(
            ArrayHelper::map(Lbo::find()->all(), 'year', 'year'),
            ['prompt'=>'Выберите год']
    ); ?>

    <?= $form->field($model, 'st_id')->hiddenInput(['value' => $id])->label(false); ?>

    <div class="form-group">
        <?= Html::submitButton($model->isNewRecord ? 'Создать' : 'Редактировать', ['class' => $model->isNewRecord ? 'btn btn-success' : 'btn btn-primary']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
