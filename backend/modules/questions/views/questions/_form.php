<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;
//use yii\helpers\ArrayHelper;
//use backend\modules\questions\models\Questions;
//use kartik\select2\Select2;


/* @var $this yii\web\View */
/* @var $model backend\modules\questions\models\Questions */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="questions-form">

    <?php
    if(!strpos(Yii::$app->request->get("r"),'create'))
    {
        echo '
            <div class="form-group">
                <div class="input-group">
                    <input type="text" name="search_text" id="search_text" placeholder="Поиск" class="form-control" />
                </div>
            </div>
            <div id="result"></div>
        ';
    }

    if(strpos(Yii::$app->request->get("r"),'create'))
    {
        $form = ActiveForm::begin();

        echo $form->field($model, 'question')->textInput();
        echo $form->field($model, 'answer')->textInput();
        echo "<div class=\"form-group\">
                ".Html::submitButton($model->isNewRecord ? 'Создать' : 'Обновить', ['class' => $model->isNewRecord ? 'btn btn-success' : 'btn btn-primary'])."
            </div>";

        ActiveForm::end();
    }
    ?>

</div>
