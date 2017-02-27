<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;

use yii\jui\DatePicker;
use yii\helpers\ArrayHelper;
use backend\models\Otdel;
use backend\models\AbSystems;
use backend\models\AbStatus;

/* @var $this yii\web\View */
/* @var $model backend\models\AbEmployee */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="ab-employee-form">

    <?php $form = ActiveForm::begin(); ?>

    <?php
    if(strpos(Yii::$app->request->get("r"),'create'))
    {
        echo '<div class="form-group field-abemployee-status required">';
        echo '<label class="control-label">Отдел</label>';
        echo '<select class="form-control" id="yourSelect">';
        echo '<option value="">Выберите Отдел</option>';
        foreach(ArrayHelper::map(Otdel::find()->orderBy(['text' => SORT_ASC])->all(),'id','text') as $key => $value)
        {
            echo '<option value="'.$key.'">'.$value.'</option>';
        }
        echo '</select>';
        echo '<div class="help-block"></div>';
        echo '</div>';

        echo $form->field($model, 'id_employee')->dropDownList([''=>'Для начала выберите Отдел']);

        echo $form->field($model, 'systemslist')->dropDownList(
                    ArrayHelper::map(AbSystems::find()->all(),'id','name'),
                    ['multiple' => 'true']
                );

        echo $form->field($model, 'id_status')->dropDownList(
                    ArrayHelper::map(AbStatus::find()->all(),'id','name'),
                    ['prompt'=>'Выберите статус']
                );
    }
    ?>

    <?= $form->field($model, 'act')->dropDownList(
            ['0' => 'Неактивно','1' => 'Активно'],
            ['prompt'=>'Выберите активность']
    ) ?>

    <?= $form->field($model, 'dt1')->widget(DatePicker::classname(), ['language' => 'ru', 'dateFormat' => 'yyyy-MM-dd','options' => ['class' => 'form-control'],]) ?>

    <?= $form->field($model, 'dt2')->widget(DatePicker::classname(), ['language' => 'ru', 'dateFormat' => 'yyyy-MM-dd','options' => ['class' => 'form-control'],]) ?>

    <div class="form-group">
        <?= Html::submitButton($model->isNewRecord ? 'Создать' : 'Обновить', ['class' => $model->isNewRecord ? 'btn btn-success' : 'btn btn-primary']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
