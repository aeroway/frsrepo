<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;
use kartik\select2\Select2;
use yii\helpers\ArrayHelper;
use backend\models\AreaOtchet;
use yii\jui\DatePicker;
use dosamigos\ckeditor\CKEditor;

/** @var yii\web\View $this */
/** @var backend\models\Otcheterl $model */
/** @var yii\widgets\ActiveForm $form */
?>

<div class="otcheterl-form">

    <?php $form = ActiveForm::begin(); ?>

    <?= $form->field($model, 'area_id')->widget(Select2::classname(), [
        'data' => ArrayHelper::map(AreaOtchet::find()->where(['IS NOT', 'name_2', NULL])->orderBy(['name_2' => SORT_ASC])->all(), 'id', 
        function($model) {
            return $model['name'] . ' - ' . $model['email'];
        }),
        'language' => 'ru',
        'options' => ['placeholder' => 'Выберите отдел'],
        'pluginOptions' => [
            'allowClear' => false,
            'tags' => false
        ],
    ]);
    ?>

    <?= $form->field($model, 'kuvd')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'application_date')->widget(DatePicker::classname(), ['language' => 'ru', 'dateFormat' => 'yyyy-MM-dd', 'options' => ['class' => 'form-control'],]); ?>

    <?= $form->field($model, 'kn')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'coordinates')->widget(CKEditor::className(), [
		'options' => ['rows' => 6],
		'preset' => 'standard'
	]) ?>

    <?= $form->field($model, 'address')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'fio_reg')->widget(Select2::classname(), [
        'data' => ArrayHelper::map($model::find()->select('fio_reg')->distinct()->orderBy(['fio_reg' => SORT_ASC])->all(),'fio_reg', 'fio_reg'),
        'language' => 'ru',
        'options' => ['placeholder' => 'Введите регистратора'],
        'pluginOptions' => [
            'allowClear' => true,
            'tags' => true
        ],
    ]);
    ?>

    <?= $form->field($model, 'email_reg')->widget(Select2::classname(), [
        'data' => ArrayHelper::map($model::find()->select('email_reg')->distinct()->orderBy(['email_reg' => SORT_ASC])->all(), 'email_reg', 'email_reg'),
        'language' => 'ru',
        'options' => ['placeholder' => 'Введите e-mail регистратора'],
        'pluginOptions' => [
            'allowClear' => true,
            'tags' => true
        ],
    ]);
    ?>

    <?= $form->field($model, 'draft_number')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'draft_date')->widget(DatePicker::classname(), ['language' => 'ru', 'dateFormat' => 'yyyy-MM-dd', 'options' => ['class' => 'form-control'],]); ?>

    <?= $form->field($model, 'outgoing_number')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'outgoing_date')->widget(DatePicker::classname(), ['language' => 'ru', 'dateFormat' => 'yyyy-MM-dd', 'options' => ['class' => 'form-control'],]); ?>

    <?= $form->field($model, 'send')->dropDownList(
            ['0' => 'Нет', '1' => 'Да'],
            ['prompt'=>'Письмо отправлено?']
    ) ?>

    <div class="form-group">
        <?= Html::submitButton('Сохранить', ['class' => 'btn btn-success']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
