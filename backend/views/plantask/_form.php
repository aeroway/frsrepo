<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;
use kartik\select2\Select2;
use yii\helpers\ArrayHelper;
use backend\models\Planview;

/* @var $this yii\web\View */
/* @var $model backend\models\Plantask */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="plantask-form">

    <?php $form = ActiveForm::begin(); ?>

    <?= $form->field($model, 'name')->textInput() ?>

    <?= $form->field($model, 'username')->hiddenInput(['readonly' => true, 'value' => '23UPR\\' . Yii::$app->user->identity->username])->label(false) ?>

    <?= $form->field($model, 'date_task')->hiddenInput(['readonly' => true, 'value' => date("Y-m-d H:i:s") ])->label(false) ?>

    <?php
    if(strpos(Yii::$app->request->get("r"), 'create')) {
        if (!empty($_GET['sid'])) {
            echo $form->field($model, 'pview_id')->hiddenInput(['value' => $_GET['sid']])->label(false);
        } else {
            echo $form->field($model, 'pview_id')->widget(Select2::classname(), [
                    'data' => ArrayHelper::map(Planview::find()->orderBy(['name' => SORT_ASC])->all(), 'id', 'name'),
                    'language' => 'ru',
                    'options' => ['placeholder' => 'Выберите вид обращения'],
                    'pluginOptions' => [
                        'allowClear' => true
                    ],
                ]);
        }
    } else {
        echo $form->field($model, 'pview_id')->hiddenInput(['value' => $model->pview_id])->label(false);
    }
    ?>

    <div class="form-group">
        <?= Html::submitButton('Сохранить', ['class' => 'btn btn-success']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
