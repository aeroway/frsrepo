<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;
use kartik\select2\Select2;
use yii\helpers\ArrayHelper;
use backend\models\AreaOtchet;
use backend\models\OtchetpriostMarks;
use backend\models\SuspensionArticles;
use yii\jui\DatePicker;

/* @var $this yii\web\View */
/* @var $model backend\models\otchetpriost */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="otchetpriost-form">

    <?php $form = ActiveForm::begin(); ?>

    <?php // echo $form->field($model, 'area_id')->textInput() ?>
    <?= $form->field($model, 'area_id')->widget(Select2::classname(), [
        'data' => ArrayHelper::map(AreaOtchet::find()->where(['IS NOT', 'name_2', NULL])->orderBy(['name_2' => SORT_ASC])->all(), 'id', 'name_2'),
        'language' => 'ru',
        'options' => ['placeholder' => 'Выберите отдел'],
        'pluginOptions' => [
            'allowClear' => false,
            'tags' => false
        ],
    ]);
    ?>

    <?= $form->field($model, 'kuvd')->textInput() ?>

    <?= $form->field($model, 'date_suspend')->widget(DatePicker::classname(), ['language' => 'ru', 'dateFormat' => 'yyyy-MM-dd', 'options' => ['class' => 'form-control'],]); ?>

    <?= $form->field($model, 'urd')->dropDownList(
            ['ГКУ' => 'ГКУ', 'ГРП' => 'ГРП', 'ЕП' => 'ЕП'],
            ['prompt'=>'Выберите вид рег. действия']
    ) ?>

    <?= $form->field($model, 'mark_id')->widget(Select2::classname(), [
        'data' => ArrayHelper::map(OtchetpriostMarks::find()->orderBy(['name' => SORT_ASC])->all(), 'id', 'name'),
        'language' => 'ru',
        'options' => ['placeholder' => 'Выберите один из пунктов'],
        'pluginOptions' => [
            'allowClear' => true,
            'tags' => false
        ],
    ]);
    ?>

    <?= $form->field($model, 'fio_sro')->textInput() ?>

    <?= $form->field($model, 'suspensionId')->widget(Select2::classname(), [
        'data' => ArrayHelper::map(SuspensionArticles::find()->orderBy(['name' => SORT_ASC])->all(), 'id', 'name'),
        'language' => 'ru',
        'options' => ['placeholder' => 'Выберите причину'],
        'pluginOptions' => [
            'allowClear' => true,
            'tags' => false,
            'multiple' => true,
        ],
    ]);
    ?>

    <?= $form->field($model, 'description')->textInput() ?>

    <?= $form->field($model, 'offer')->textInput() ?>

    <?= $form->field($model, 'executor')->textInput(['placeholder' => 'ФИО']) ?>

    <?php // echo $form->field($model, 'comment')->textInput() ?>

    <?= $form->field($model, 'date')->hiddenInput(['value' => date("Y-m-d H:i:s")])->label(false) ?>

    <?= $form->field($model, 'username')->hiddenInput(['value' => Yii::$app->user->identity->username])->label(false) ?>

    <?= $form->field($model, 'flag')->hiddenInput(['value' => '0'])->label(false) ?>

    <div class="form-group">
        <?= Html::submitButton($model->isNewRecord ? 'Создать' : 'Редактировать', ['class' => $model->isNewRecord ? 'btn btn-success' : 'btn btn-primary']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
