<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;
use kartik\select2\Select2;
use yii\helpers\ArrayHelper;
use backend\models\AreaOtchet;
use yii\jui\DatePicker;
use backend\models\VedjustAddress;
use backend\models\VedjustSubdivision;

/** @var yii\web\View $this */
/** @var backend\models\Otcheterlmfc $model */
/** @var yii\widgets\ActiveForm $form */

$modelVedjustAddress = new VedjustAddress();
?>

<div class="otcheterlmfc-form">

    <?php $form = ActiveForm::begin(); ?>

    <?= $form->field($model, 'area_id')->widget(Select2::classname(), [
        'data' => ArrayHelper::map(AreaOtchet::find()
            ->where(['IS NOT', 'name_2', NULL])
            ->orderBy(['name_2' => SORT_ASC])
            ->all(), 'id', 'name'),
        'language' => 'ru',
        'options' => ['placeholder' => 'Выберите отдел'],
        'pluginOptions' => [
            'allowClear' => false,
            'tags' => false
        ],
    ]);
    ?>

    <?= $form->field($model, 'ref_num')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'application_date')->widget(DatePicker::classname(), ['language' => 'ru', 'dateFormat' => 'yyyy-MM-dd', 'options' => ['class' => 'form-control'],]); ?>

    <?= $form->field($model, 'address')->widget(Select2::classname(), [
        'data' => ArrayHelper::map($modelVedjustAddress->addressIdName(), 'name', 'name'),
        'language' => 'ru',
        'options' => ['placeholder' => 'Выберите адрес'],
        'pluginOptions' => [
            'allowClear' => false,
            'tags' => false
        ],
    ]);
    ?>

    <?= $form->field($model, 'fio_mfc')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'description')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'username')->textInput(['readonly' => true, 'value' => Yii::$app->user->identity->username]) ?>

    <div class="form-group">
        <?= Html::submitButton('Save', ['class' => 'btn btn-success']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
