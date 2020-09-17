<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;
use yii\helpers\ArrayHelper;
use kartik\select2\Select2;
use backend\models\Otdel;

/* @var $this yii\web\View */
/* @var $model backend\models\RstEnfProc */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="rst-enf-proc-form">

    <?php $form = ActiveForm::begin(); ?>

    <?= $form->field($model, 'otdel_id')->widget(Select2::classname(), [
        'data' => ArrayHelper::map(Otdel::find()->innerJoin('employee', 'otdel.id = employee.idm_otdel')->where(['<>', 'employee.status', 2])->orderBy(['text' => SORT_ASC])->all(), 'id', 'text'),
        'language' => 'ru',
        'options' => ['placeholder' => 'Указывается наименование структурного подразделения Управления Росреестра по Краснодарскому краю, например, отдел государственной регистрации недвижимости или Абинский сектор межмуниципального отдела по Адинскому и Крымскому районам'],
        'pluginOptions' => [
            'allowClear' => true,
            'tags' => true
        ],
    ]);
    ?>

    <?= $form->field($model, 'num_req')->textInput(['maxlength' => true, 'placeholder' => 'Указывается номер записи КУВД и(или) входящий номер и дата, присвоенный при регистрации входящей корреспонденции СЭД']) ?>

    <?= $form->field($model, 'agency')->textInput(['maxlength' => true, 'placeholder' => 'Наименование органа, издавшего требование по исполнительному производству, например, судебный пристав-исполнитель Центральный РОСП г. Сочи УФССП по Краснодарскому краю']) ?>

    <?= $form->field($model, 'num_enf_proc')->textInput(['maxlength' => true, 'placeholder' => 'Указывается номер исполнительного производства, например,  № 525199/20/23072-ИП']) ?>

    <?= $form->field($model, 'decision')->widget(Select2::classname(), [
        'data' => ['Положительное' => 'Положительное', 'Отрицательное' => 'Отрицательное'],
        'language' => 'ru',
        'options' => ['placeholder' => 'Указывается принятое решение: в случае внесения регистрационной записи о проведении регистрационных действий - "положительно"; В случае невозможности внесения или отказе в регистрации - "отрицательно"'],
        'pluginOptions' => [
            'allowClear' => true,
            'tags' => true
        ],
    ]);
    ?>

    <?= $form->field($model, 'num_notice')->textInput(['maxlength' => true, 'placeholder' => 'Указывается номер и дата уведомления о регистрации в ФГИС ЕГРН и(или) ответа, в случае направления письма']) ?>

    <?= $form->field($model, 'comment')->textInput(['maxlength' => true, 'placeholder' => 'Указывается номер и дата исходящих документов (запросов)']) ?>

    <?= $form->field($model, 'num_appeal')->textInput(['maxlength' => true, 'placeholder' => 'Указывается исходящий номер и дата заявления в суд о прекращении (приостановлении) исполнительного производства']) ?>

    <?= $form->field($model, 'result')->textInput(['maxlength' => true, 'placeholder' => 'Указывается номер и дата документа, на основании которого прекращено исполнительное производство']) ?>

    <?= $form->field($model, 'date_edit')->hiddenInput(['value' => date("Y-m-d H:i:s") ])->label(false) ?>

    <?= $form->field($model, 'username')->textInput(['readonly' => true, 'value' => Yii::$app->user->identity->username ]) ?>

    <div class="form-group">
        <?= Html::submitButton('Сохранить', ['class' => 'btn btn-success']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
