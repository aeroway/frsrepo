<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;
use kartik\select2\Select2;

/* @var $this yii\web\View */
/* @var $model backend\models\Otchet */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="otchet-form">

    <?php $form = ActiveForm::begin(); ?>

    <?php
        $arr = Yii::$app->request->get();

        if($arr["table"] == 'otchet21') {
            echo $form->field($model, 'kn')->textInput();
        } else {
            echo $form->field($model, 'kn')->textInput(['readonly' => true]);
        }

        if($arr["table"] == 'otchet22' or $arr["table"] == 'otchet36' or $arr["table"] == 'otchet37' or $arr["table"] == 'otchet38' or $arr["table"] == 'otchet39') {
            echo $form->field($model, 'description')->textInput(['readonly' => true]);
        } else {
            echo $form->field($model, 'description')->textInput();
        }
    ?>

    <?= $form->field($model, 'status')->dropDownList(
            ['Исправлен' => 'Исправлен','Невозможно исправить' => 'Невозможно исправить','В работе' => 'В работе'],
            ['prompt'=>'Выберите Статус']
    ) ?>

    <?php
        $arr = Yii::$app->request->get();

        if($arr["table"] == 'otchet15' or $arr["table"] == 'otchet16') {
            echo $form->field($model, 'comment')->textArea(['readonly' => true, 'placeholder' => 'Текст уведомления о внесённых изменениях для уведомления правообладателя.']);
        } elseif($arr["table"] == 'otchet22' or $arr["table"] == 'otchet36' or $arr["table"] == 'otchet37' or $arr["table"] == 'otchet38') {
            echo $form->field($model, 'comment')->textArea(['readonly' => true]);
        } else {
            if ($arr["table"] != 'otchet39')
                echo $form->field($model, 'comment')->textArea(['placeholder' => 'Текст уведомления о внесённых изменениях для уведомления правообладателя.']);
        }
    ?>

    <?= $form->field($model, 'date')->textInput(['readonly' => true, 'value' => date("Y-m-d H:i:s") ]) ?>

    <?= $form->field($model, 'username')->textInput(['readonly' => true, 'value' => '23UPR\\' . Yii::$app->user->identity->username]) ?>

    <?= $form->field($model, 'flag')->hiddenInput(['value' => '0'])->label(false) ?>

    <?php
        if($arr["table"] == 'otchet39') {
            echo $form->field($model, 'protocol')->widget(Select2::classname(), [
                'data' => ["Данные не найдены" => "Данные не найдены", "Найдено более одного СНИЛС" => "Найдено более одного СНИЛС"],
                'language' => 'ru',
                'options' => ['placeholder' => 'Выберите причину или напишите свою'],
                'pluginOptions' => [
                    'allowClear' => true,
                    'tags' => true
                ],
            ]);
        } else {
            echo $form->field($model, 'protocol')->textInput(['maxlength' => 100]);
        }
    ?>
    <?php //echo $form->field($model, 'protocol')->textInput(['maxlength' => 100]) ?>

    <div class="form-group">
        <?= Html::submitButton($model->isNewRecord ? 'Создать' : 'Обновить', ['class' => $model->isNewRecord ? 'btn btn-success' : 'btn btn-primary']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
