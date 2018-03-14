<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;
use kartik\select2\Select2;
use yii\helpers\ArrayHelper;
use backend\models\Planstages;

/* @var $this yii\web\View */
/* @var $model backend\models\Plannotes */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="plannotes-form">

    <?php $form = ActiveForm::begin(); ?>

    <?= $form->field($model, 'text')->textInput() ?>

    <?= $form->field($model, 'status')->dropDownList(
            ['0' => 'Некритичное', '1' => 'Критичное', '2' => 'Нет замечаний'],
            ['prompt'=>'Выберите статус']
    ) ?>

    <?= $form->field($model, 'action')->dropDownList(
            ['РП' => 'РП', 'КУ' => 'КУ'],
            ['prompt'=>'Выберите действие']
    ) ?>

    <?php
    if(strpos(Yii::$app->request->get("r"), 'create')) {
        if (!empty($_GET['sid'])) {
            echo $form->field($model, 'pstages_id')->hiddenInput(['value' => $_GET['sid']])->label(false);
        } else {
            echo $form->field($model, 'pstages_id')->widget(Select2::classname(), [
                    'data' => ArrayHelper::map(Planstages::find()->orderBy(['name' => SORT_ASC])->all(), 'id', 'name'),
                    'language' => 'ru',
                    'options' => ['placeholder' => 'Выберите задание'],
                    'pluginOptions' => [
                        'allowClear' => true
                    ],
                ]);
        }
    } else {
        echo $form->field($model, 'pstages_id')->hiddenInput(['value' => $model->pstages_id])->label(false);
    }
    ?>

    <div class="form-group">
        <?= Html::submitButton('Сохранить', ['class' => 'btn btn-success']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
