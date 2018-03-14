<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;
use backend\models\Planviewnames;
use yii\helpers\ArrayHelper;
use kartik\select2\Select2;

/* @var $this yii\web\View */
/* @var $model backend\models\Planview */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="planview-form">

    <?php $form = ActiveForm::begin(); ?>

    <?= $form->field($model, 'name')->widget(Select2::classname(), [
        'data' => ArrayHelper::map(Planviewnames::find()->select('name')->distinct()->orderBy(['name' => SORT_ASC])->all(),'name','name'),
        'language' => 'ru',
        'options' => ['placeholder' => 'Выберите название'],
        'pluginOptions' => [
            'allowClear' => true,
            'tags' => true
        ],
    ]);
    ?>

    <?= $form->field($model, 'type')->dropDownList(
            ['РП' => 'РП', 'КУ' => 'КУ', 'РП + КУ' => 'РП + КУ',],
            ['prompt'=>'Выберите действие',]
    ) ?>

    <div class="form-group">
        <?= Html::submitButton('Сохранить', ['class' => 'btn btn-success']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
