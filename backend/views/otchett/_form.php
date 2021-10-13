<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;
use kartik\select2\Select2;
use yii\helpers\ArrayHelper;
use backend\models\AreaOtchet;

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
        } elseif ($arr["table"] == 'otchet67') {
            echo $form->field($model, 'kn')->textInput(['placeholder' => 'Номер обращения'])->label(false);
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
            $arr["table"] == 'otchet59' or
            $arr["table"] == 'otchet60' or
            $arr["table"] == 'otchet62' or
            $arr["table"] == 'otchet64' or
            $arr["table"] == 'otchet65' or
            $arr["table"] == 'otchet66' or
            $arr["table"] == 'otchet68' or
            $arr["table"] == 'otchet72' or
            $arr["table"] == 'otchet73' or
            $arr["table"] == 'otchet74' or
            $arr["table"] == 'otchet75' or
            $arr["table"] == 'otchet76' or
            $arr["table"] == 'otchet77' or
            $arr["table"] == 'otchet78' or
            $arr["table"] == 'otchet82' or
            $arr["table"] == 'otchet83' or
            $arr["table"] == 'otchet84' or
            $arr["table"] == 'otchet85' or
            $arr["table"] == 'otchet86' or
            $arr["table"] == 'otchet92' or
            $arr["table"] == 'otchet93' or
            $arr["table"] == 'otchet94' or
            $arr["table"] == 'otchet95' or
            $arr["table"] == 'otchet96' or
            $arr["table"] == 'otchet97' or
            $arr["table"] == 'otchet98' or
            $arr["table"] == 'otchet99' or
            $arr["table"] == 'otchet100' or
            $arr["table"] == 'otchet101' or
            $arr["table"] == 'otchet9' or 
            $arr["table"] == 'otchet42') {
            echo $form->field($model, 'description')->textInput(['readonly' => true]);
        } elseif ($arr["table"] == 'otchet67') {
            echo $form->field($model, 'description')->widget(Select2::classname(), [
                'data' => [
                    "Постановка на ГКУ и ГРП в связи с созданием (образованием) ОН" => "Постановка на ГКУ и ГРП в связи с созданием (образованием) ОН",
                    "Постановка на ГКУ ОН без одновременной ГРП" => "Постановка на ГКУ ОН без одновременной ГРП",
                    "Снятие с ГКУ ОН, права на который зарегистрированы в ЕГРН" => "Снятие с ГКУ ОН, права на который зарегистрированы в ЕГРН",
                    "Снятие с ГКУ ОН, права на который не зарегистрированы в ЕГРН" => "Снятие с ГКУ ОН, права на который не зарегистрированы в ЕГРН",
                    "Изменение основных характеристик ОН без одновременной ГРП" => "Изменение основных характеристик ОН без одновременной ГРП",
                    "Внесение сведений о ранее учтенном ОН" => "Внесение сведений о ранее учтенном ОН",
                    "Изменение вида ОН в рамках учета изменений основных характеристик ОН" => "Изменение вида ОН в рамках учета изменений основных характеристик ОН",
                    "ГРП без одновременного ГКУ (при наличии в ЕГРН сведений об ОНИ)" => "ГРП без одновременного ГКУ (при наличии в ЕГРН сведений об ОНИ)",
                    "ГР прекращения права на ОН без одновременного ГКУ (при наличии в ЕГРН сведений об ОНИ)" => "ГР прекращения права на ОН без одновременного ГКУ (при наличии в ЕГРН сведений об ОНИ)",
                    "Регистрация перехода права на ОН без одновременного ГКУ (при наличии в ЕГРН сведений об ОНИ)" => "Регистрация перехода права на ОН без одновременного ГКУ (при наличии в ЕГРН сведений об ОНИ)",
                    "Регистрация и погашение сделки об ограничении (обремениении) права" => "Регистрация и погашение сделки об ограничении (обремениении) права",
                    "Регистрация ограничений прав на ОН и обременений ОН" => "Регистрация ограничений прав на ОН и обременений ОН",
                    "Прекращение ограничений прав на ОН и обременений ОН" => "Прекращение ограничений прав на ОН и обременений ОН",
                    "Исправление технических ошибок в запиях ЕГРН" => "Исправление технических ошибок в запиях ЕГРН",
                    "Погашение ипотеки" => "Погашение ипотеки",
                    "Учет бесхозяйных недвижимых вещей" => "Учет бесхозяйных недвижимых вещей",
                    "Прием судебных актов или актов уполномоченного органа" => "Прием судебных актов или актов уполномоченного органа"
                ],
                'language' => 'ru',
                'options' => ['placeholder' => 'Выберите тип обращения'],
                'pluginOptions' => [
                    'allowClear' => true,
                    //'tags' => true,
                    'initialize' => true,
                ],
            ])->label(false);
        } else {
            echo $form->field($model, 'description')->textInput();
        }

        if ($arr["table"] == 'otchet67') {
            // echo $form->field($model, 'area')->textInput(['placeholder' => 'Район'])->label(false);

            echo $form->field($model, 'area')->widget(Select2::classname(), [
                'data' => ArrayHelper::map(AreaOtchet::find()->select('name_2')->where(['<>', 'name_2', 'Сочинский'])->orderBy(['name_2' => SORT_ASC])->all(), 'name_2', 'name_2'),
                'language' => 'ru',
                'options' => ['placeholder' => 'Выберите район'],
                'pluginOptions' => [
                    'allowClear' => true,
                    // 'tags' => true
                ],
            ])->label(false);

        }
    ?>

    <?php if($arr["table"] == 'otchet41' or $arr["table"] == 'otchet47' or $arr["table"] == 'otchet42' or $arr["table"] == 'otchet44') : ?>
        <?= $form->field($model, 'status')->hiddenInput(['readonly' => true, 'value' => 'Исправлен'])->label(false); ?>
    <?php elseif($arr["table"] == 'otchet67') : ?>
        <?= $form->field($model, 'status')->hiddenInput(['value' => 'Исправлен'])->label(false); ?>
    <?php elseif($arr["table"] == 'otchet78') : ?>
        <?= $form->field($model, 'status')->hiddenInput(['value' => 'не назначено'])->label(false); ?>
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
            $arr["table"] == 'otchet68' or
            $arr["table"] == 'otchet58' or
            $arr["table"] == 'otchet59' or
            $arr["table"] == 'otchet60' or
            $arr["table"] == 'otchet62' or
            $arr["table"] == 'otchet64' or
            $arr["table"] == 'otchet65' or
            $arr["table"] == 'otchet66' or
            $arr["table"] == 'otchet29' or 
            $arr["table"] == 'otchet35' or 
            $arr["table"] == 'otchet72' or
            $arr["table"] == 'otchet73' or
            $arr["table"] == 'otchet74' or
            $arr["table"] == 'otchet75' or
            $arr["table"] == 'otchet76' or
            $arr["table"] == 'otchet77' or
            $arr["table"] == 'otchet78' or
            $arr["table"] == 'otchet82' or
            $arr["table"] == 'otchet83' or
            $arr["table"] == 'otchet84' or
            $arr["table"] == 'otchet85' or
            $arr["table"] == 'otchet86' or
            $arr["table"] == 'otchet92' or
            $arr["table"] == 'otchet93' or
            $arr["table"] == 'otchet94' or
            $arr["table"] == 'otchet95' or
            $arr["table"] == 'otchet96' or
            $arr["table"] == 'otchet97' or
            $arr["table"] == 'otchet98' or
            $arr["table"] == 'otchet99' or
            $arr["table"] == 'otchet100' or
            $arr["table"] == 'otchet101' or
            $arr["table"] == 'otchet9' or 
            $arr["table"] == 'otchet38') {
            echo $form->field($model, 'comment')->textArea(['readonly' => true]);
        } elseif ($arr["table"] == 'otchet67') {
            echo $form->field($model, 'comment')->hiddenInput(['value' => ''])->label(false);
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
        } elseif($arr["table"] == 'otchet78') {
            echo $form->field($model, 'protocol')->textArea(['maxlength' => 3000])->label('Примечание');
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
