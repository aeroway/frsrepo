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

    <?php $form = ActiveForm::begin(['action' => 'index.php?r=purchaseplan/create&id=' . $_GET['id'] . '&fe=' . $fe]); ?>

    <?php // echo $form->field($model, 'type')->textInput() ?>

    <?php
    if(strpos(Yii::$app->request->get("r"), 'create'))
    {
        echo $form->field($model, 'okpd')->textInput();
    }
    else
    {
        echo $form->field($model, 'okpd')->textInput(['readonly' => 'true']);
    }
    ?>

    <?php
    if(strpos(Yii::$app->request->get("r"), 'create'))
    {
        echo $form->field($model, 'name_object')->textInput();
    }
    else
    {
        echo $form->field($model, 'name_object')->textInput(['readonly' => 'true']);
    }
    ?>

    <?= $form->field($model, 'outlay')->textInput() ?>

    <?= $form->field($model, 'p_year')->textInput() ?>

    <?= $form->field($model, 'c_year')->textInput() ?>

    <?= $form->field($model, 'special')->textInput() ?>

    <?php // $form->field($model, 'sum')->textInput() ?>

    <?php
    if(strpos(Yii::$app->request->get("r"), 'create'))
    {
        echo $form->field($model, 'year')->dropDownList(ArrayHelper::map(Lbo::find()->all(), 'year', 'year'), ['prompt' => 'Выберите год']);
    }
    else
    {
        echo $form->field($model, 'year')->textInput(['value' => $model->year, 'readonly' => 'true']);
    }
    ?>

    <?php
    if(strpos(Yii::$app->request->get("r"),'create'))
    {
        echo $form->field($model, 'st_id')->hiddenInput(['value' => $id])->label(false);
    }
    else
    {
        echo $form->field($model, 'st_id')->hiddenInput(['value' => $model->st_id])->label(false);
        echo $form->field($model, 'f_row')->hiddenInput(['value' => $model->f_row])->label(false);
        echo $form->field($model, 'type')->hiddenInput(['value' => $model->type])->label(false);
    }
    ?>

    <?= $form->field($model, 'is_percent')->checkbox(); ?>

    <div class="form-group">
        <?= Html::submitButton($model->isNewRecord ? 'Создать' : 'Редактировать', ['class' => $model->isNewRecord ? 'btn btn-success' : 'btn btn-primary']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
