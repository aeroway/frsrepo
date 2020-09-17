<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;
use backend\models\Subdivision;
use kartik\select2\Select2;
use yii\helpers\ArrayHelper;

/* @var $this yii\web\View */
/* @var $model backend\models\DocSrchReq */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="doc-srch-req-form">

    <?php $form = ActiveForm::begin(); ?>

    <?= $form->field($model, 'full_name')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'req_num')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'email')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'subdivision_id')->widget(Select2::classname(), [
        'data' => ArrayHelper::map(Subdivision::find()->all(),'id','name'),
        'language' => 'ru',
        'options' => ['placeholder' => 'Выберите название'],
        'pluginOptions' => [
            'allowClear' => true,
            'tags' => true
        ],
    ]);
    ?>

    <?= $form->field($model, 'date_update')->textInput(['readonly' => true, 'value' => date("Y-m-d")]) ?>

    <?= $form->field($model, 'username')->textInput(['maxlength' => true, 'readonly' => true, 'value' => Yii::$app->user->identity->username]) ?>

    <?php if (!$model->isNewRecord) : ?>
        <?= $form->field($model, 'answer')->textArea(['rows' => '6', 'maxlength' => true]) ?>
    <?php endif; ?>

    <div class="form-group">
        <?= Html::submitButton('Сохранить', ['class' => 'btn btn-success']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>