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

        if($arr["table"] == 'otchet22' or
            $arr["table"] == 'otchet36' or
            $arr["table"] == 'otchet37' or
            $arr["table"] == 'otchet38' or
            $arr["table"] == 'otchet39' or
            $arr["table"] == 'otchet41' or
            $arr["table"] == 'otchet47' or
            $arr["table"] == 'otchet44' or
            $arr["table"] == 'otchet29' or
            $arr["table"] == 'otchet35' or
            $arr["table"] == 'otchet46' or
            $arr["table"] == 'otchet48' or
            $arr["table"] == 'otchet49' or
            $arr["table"] == 'otchet50' or
            $arr["table"] == 'otchet51' or
            $arr["table"] == 'otchet52' or
            $arr["table"] == 'otchet53' or
            $arr["table"] == 'otchet54' or
            $arr["table"] == 'otchet55' or
            $arr["table"] == 'otchet56' or
            $arr["table"] == 'otchet57' or
            $arr["table"] == 'otchet58' or
            $arr["table"] == 'otchet9' or 
            $arr["table"] == 'otchet42') {
            echo $form->field($model, 'description')->textInput(['readonly' => true]);
        } else {
            echo $form->field($model, 'description')->textInput();
        }
    ?>

    <?php if($arr["table"] == 'otchet41' or $arr["table"] == 'otchet47' or $arr["table"] == 'otchet42' or $arr["table"] == 'otchet44') : ?>
        <?= $form->field($model, 'status')->hiddenInput(['readonly' => true, 'value' => 'Исправлен'])->label(false); ?>
    <?php else : ?>
        <?= $form->field($model, 'status')->dropDownList(
                ['Исправлен' => 'Исправлен', 'Невозможно исправить' => 'Невозможно исправить', 'В работе' => 'В работе'],
                ['prompt'=>'Выберите Статус']
        ) ?>
    <?php endif; ?>

    <?php
        $arr = Yii::$app->request->get();

        if($arr["table"] == 'otchet15' or $arr["table"] == 'otchet16' or $arr["table"] == 'otchet41' or $arr["table"] == 'otchet47' or $arr["table"] == 'otchet42' or $arr["table"] == 'otchet44') {
            echo $form->field($model, 'comment')->textArea(['readonly' => true, 'placeholder' => 'Текст уведомления о внесённых изменениях для уведомления правообладателя.']);
        } elseif($arr["table"] == 'otchet22' or 
            $arr["table"] == 'otchet36' or 
            $arr["table"] == 'otchet37' or 
            $arr["table"] == 'otchet48' or 
            $arr["table"] == 'otchet49' or 
            $arr["table"] == 'otchet50' or 
            $arr["table"] == 'otchet51' or 
            $arr["table"] == 'otchet52' or
            $arr["table"] == 'otchet53' or
            $arr["table"] == 'otchet54' or
            $arr["table"] == 'otchet56' or
            // $arr["table"] == 'otchet57' or
            $arr["table"] == 'otchet58' or
            $arr["table"] == 'otchet29' or 
            $arr["table"] == 'otchet35' or 
            $arr["table"] == 'otchet9' or 
            $arr["table"] == 'otchet38') {
            echo $form->field($model, 'comment')->textArea(['readonly' => true]);
        } else {
            if ($arr["table"] != 'otchet39' && $arr["table"] != 'otchet46')
                echo $form->field($model, 'comment')->textArea(['placeholder' => 'Текст уведомления о внесённых изменениях для уведомления правообладателя.']);
        }
    ?>

    <?= $form->field($model, 'date')->textInput(['readonly' => true, 'value' => date("Y-m-d H:i:s") ]) ?>

    <?php if ($arr["table"] == 'otchet41' or $arr["table"] == 'otchet42' or $arr["table"] == 'otchet47' or $arr["table"] == 'otchet44') : ?>
        <?= $form->field($model, 'username')->textInput(['readonly' => true, 'value' => Yii::$app->user->identity->username]) ?>
    <?php else : ?>
        <?= $form->field($model, 'username')->textInput(['readonly' => true, 'value' => '23UPR\\' . Yii::$app->user->identity->username]) ?>
    <?php endif; ?>

    <?= $form->field($model, 'flag')->hiddenInput(['value' => '0'])->label(false) ?>

    <?php
        if($arr["table"] == 'otchet39' || $arr["table"] == 'otchet46') {
            echo $form->field($model, 'protocol')->widget(Select2::classname(), [
                'data' => ["Данные не найдены" => "Данные не найдены", "Найдено более одного СНИЛС" => "Найдено более одного СНИЛС"],
                'language' => 'ru',
                'options' => ['placeholder' => 'Выберите причину или напишите свою'],
                'pluginOptions' => [
                    'allowClear' => true,
                    'tags' => true
                ],
            ]);
        } elseif($arr["table"] == 'otchet41' or $arr["table"] == 'otchet42' or $arr["table"] == 'otchet47' or $arr["table"] == 'otchet44') {
            echo $form->field($model, 'protocol')->widget(Select2::classname(), [
                'data' => ["Возврат по причине приостановки" => "Возврат по причине приостановки", "Зарегистрировано" => "Зарегистрировано", 
                    "Ненадлежащее рег. действие" => "Ненадлежащее рег. действие", "Ошибка миграции" => "Ошибка миграции", "Возврат по причине приостановки (повторно)" => "Возврат по причине приостановки (повторно)", "Забрали обратно" => "Забрали обратно", "Отказать в выполнении УРД" => "Отказать в выполнении УРД"],
                'language' => 'ru',
                'options' => ['placeholder' => 'Выберите статус обработки'],
                'pluginOptions' => [
                    'allowClear' => true,
                    //'tags' => true,
                    'initialize' => true,
                ],
            ])->label('Результат');
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
