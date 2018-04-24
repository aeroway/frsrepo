<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;
use yii\jui\DatePicker;
use kartik\select2\Select2;
use yii\helpers\ArrayHelper;
use backend\models\GznObject;
use backend\models\GznAdmPunishment;
use backend\models\GznTypesPunishment;

/* @var $this yii\web\View */
/* @var $model backend\models\GznViolations */
/* @var $form yii\widgets\ActiveForm */

?>

<div class="gzn-violations-form">

    <?php $form = ActiveForm::begin(); ?>

    <div class="row">
        <div class="col-md-4">
        <?= $form->field($model, 'adm_affairs')->textInput() ?>
        <?= $form->field($model, 'note')->textArea(['rows' => '4']) ?>
        <?= $form->field($model, 'adm_punishment_id')->dropDownList(
                ArrayHelper::map(GznAdmPunishment::find()->orderBy(['name' => SORT_ASC])->all(), 'id', 'name'),
                ['prompt' => 'Выберите статью']
        ) ?>
        <?= $form->field($model, 'violation_protocol')->widget(DatePicker::classname(), ['language' => 'ru', 'dateFormat' => 'yyyy-MM-dd','options' => ['class' => 'form-control'],]) ?>
        <?= $form->field($model, 'place_proceeding')->widget(DatePicker::classname(), ['language' => 'ru', 'dateFormat' => 'yyyy-MM-dd','options' => ['class' => 'form-control'],]) ?>
        </div>
        <div class="col-md-4">
        <?= $form->field($model, 'decision_punishment')->widget(DatePicker::classname(), ['language' => 'ru', 'dateFormat' => 'yyyy-MM-dd','options' => ['class' => 'form-control', 'onchange' => 'changeDateDue(this.value)'],]) ?>
        <?= $form->field($model, 'violation_area')->textInput(['value' => Yii::$app->formatter->asDecimal($model->violation_area, 1), 'pattern' => '\d+(\.\d{1})?']) ?>
        <?= $form->field($model, 'types_punishment_id')->dropDownList(
                ArrayHelper::map(GznTypesPunishment::find()->orderBy(['name' => SORT_ASC])->all(), 'id', 'name'),
                ['prompt' => 'Выберите вид наказания']
        ) ?>
        <?= $form->field($model, 'amount_fine')->textInput(['value' => Yii::$app->formatter->asDecimal($model->amount_fine, 2), 'pattern' => '\d+(\.\d{2})?']) ?>
        <?= $form->field($model, 'amount_fine_collected')->textInput(['value' => Yii::$app->formatter->asDecimal($model->amount_fine_collected, 2), 'pattern' => '\d+(\.\d{2})?']) ?>
        <?= $form->field($model, 'payment_doc')->textInput() ?>
        <?php
        if(strpos(Yii::$app->request->get("r"), 'create')) {
            if (!empty($_GET['sid'])) {
                echo $form->field($model, 'gzn_obj_id')->hiddenInput(['value' => $_GET['sid']])->label(false);
            } else {
                echo $form->field($model, 'gzn_obj_id')->widget(Select2::classname(), [
                        'data' => ArrayHelper::map(GznObject::find()->orderBy(['name_entity' => SORT_ASC])->all(), 'id', 'name_entity'),
                        'language' => 'ru',
                        'options' => ['placeholder' => 'Выберите объект проверки'],
                        'pluginOptions' => [
                            'allowClear' => true
                        ],
                    ]);
            }
        } else {
            echo $form->field($model, 'gzn_obj_id')->hiddenInput(['value' => $model->gzn_obj_id])->label(false);
        }
        ?>
        </div>
        <div class="col-md-4">
        <?= $form->field($model, 'date_due')->widget(DatePicker::classname(), ['language' => 'ru', 'dateFormat' => 'yyyy-MM-dd','options' => ['class' => 'form-control'],]) ?>
        <?= $form->field($model, 'decision_appeal')->widget(DatePicker::classname(), ['language' => 'ru', 'dateFormat' => 'yyyy-MM-dd','options' => ['class' => 'form-control'],]) ?>
        <?= $form->field($model, 'decision_cancellation')->widget(DatePicker::classname(), ['language' => 'ru', 'dateFormat' => 'yyyy-MM-dd','options' => ['class' => 'form-control'],]) ?>
        <?= $form->field($model, 'violation_decision_end')->widget(DatePicker::classname(), ['language' => 'ru', 'dateFormat' => 'yyyy-MM-dd','options' => ['class' => 'form-control'],]) ?>
        <?= $form->field($model, 'date_outgoing')->widget(DatePicker::classname(), ['language' => 'ru', 'dateFormat' => 'yyyy-MM-dd','options' => ['class' => 'form-control'],]) ?>
        <?= $form->field($model, 'date_performance')->widget(DatePicker::classname(), ['language' => 'ru', 'dateFormat' => 'yyyy-MM-dd','options' => ['class' => 'form-control'],]) ?>
        <?= $form->field($model, 'date_check')->textInput() ?>
        </div>
    </div>

    <div class="form-group">
        <?= Html::submitButton($model->isNewRecord ? 'Создать' : 'Сохранить', ['class' => $model->isNewRecord ? 'btn btn-success' : 'btn btn-primary']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>

<script>
/* Add some days */
function addDays(data, day) {
    data = data.split('-');
    data = new Date(data[0], +data[1] - 1, +data[2] + day, 0, 0, 0, 0);
    data = [data.getFullYear(), data.getMonth() + 1, data.getDate()];
    data = data.join('-').replace(/(^|\/)(\d)(?=\/)/g, "$10$2");

    return data;
}

function changeDateDue(value) {
    var lvAppeal = 'gznviolations-date_due';
    var lvPunishment = 'gznviolations-decision_punishment';
    nextDay = new Date();
    document.getElementById(lvAppeal).value = addDays(document.getElementById(lvPunishment).value, 40);
}
</script>