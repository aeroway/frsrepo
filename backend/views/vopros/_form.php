<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;
use kartik\select2\Select2;
use yii\helpers\ArrayHelper;
use backend\models\Otdel;
use kartik\date\DateTimePicker;
use yii\helpers\Url;

/* @var $this yii\web\View */
/* @var $model backend\models\Vopros */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="vopros-form">

    <?php $form = ActiveForm::begin(['options' => ['enctype' => 'multipart/form-data']]); ?>

    <?php if (!Yii::$app->request->get('id') > 0 && !Yii::$app->request->get('otdel_id') > 0) : ?>
        <?= $form->field($model, 'otdel_id')->widget(Select2::classname(), [
                'data' => ArrayHelper::map(Otdel::find()
                    ->innerJoin('employee', 'otdel.id = employee.idm_otdel')
                    ->leftJoin('vopros', 'otdel.id = vopros.otdel_id')
                    ->where(['and', ['<>', 'employee.status', 2], ['=', 'vopros.id', NULL]])
                    ->orderBy(['text' => SORT_ASC])
                    ->all(), 'id', 'text'),
                'language' => 'ru',
                'options' => ['placeholder' => 'Выберите отдел'],
                'pluginOptions' => [
                    'allowClear' => true,
                    'tags' => true,
                ],
            ]);
        ?>
    <?php endif; ?>

    <?php if (Yii::$app->request->get('otdel_id') > 0 && $model->ind === NULL) : ?>
        <?= $form->field($model, 'text')->textInput(); ?>
    <?php endif; ?>

    <?php if (!Yii::$app->request->get('otdel_id') > 0) : ?>
        <?= $form->field($model, 'text')->textInput(['maxlength' => true])->label('Вопрос'); ?>
    <?php endif; ?>

    <?php if (!Yii::$app->request->get('id') > 0) : ?>
        <?= $form->field($model,'date_start')->textInput(['value' => date('Y-m-d H:i')]); ?>
        <?= $form->field($model,'date_stop')->textInput(['value' => date('Y-m-d H:i', strtotime('+1 hours'))]); ?>
    <?php endif; ?>

    <?php if (Yii::$app->request->get('id') > 0) : ?>
        <?= Html::img(Yii::$app->request->baseUrl . 'uploads/kadru/' . $model->image, ['class' => 'img-responsive', 'style' => '']); ?>
        <?= $form->field($model, 'image')->fileInput() ?>
    <?php endif; ?>

    <div class="form-group">
        <?= Html::submitButton('Сохранить', ['class' => 'btn btn-success']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
