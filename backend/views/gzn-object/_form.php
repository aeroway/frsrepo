<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;
use yii\jui\DatePicker;
use kartik\select2\Select2;
use yii\helpers\ArrayHelper;
use backend\models\GznAdmPunishment;
use backend\models\GznTypesPunishment;
use backend\models\GznTypeCheck;
use backend\models\AreaOtchet;
use backend\models\GznLandCategory;
use backend\models\GznLandUserCategory;
use wbraganca\dynamicform\DynamicFormWidget;

/* @var $this yii\web\View */
/* @var $model backend\models\GznObject */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="gzn-object-form">

    <?php $form = ActiveForm::begin(['id' => 'dynamic-form']); ?>

    <div class="row">
        <div class="col-md-6">
            <?= $form->field($model, 'gzn_type_check_id')->widget(Select2::classname(), [
                'data' => ArrayHelper::map(GznTypeCheck::find()->orderBy(['name' => SORT_ASC])->all(), 'id', 'name'),
                'language' => 'ru',
                'options' => ['placeholder' => 'Выберите тип мероприятия', 'onchange' => 'getSalutationValue(this.value)'],
                'pluginOptions' => [
                    'allowClear' => true
                ],
            ]);
            ?>
            <?= $form->field($model, 'description_violation')->widget(DatePicker::classname(), ['language' => 'ru', 'dateFormat' => 'yyyy-MM-dd', 'options' => ['class' => 'form-control', 'onchange' => 'changeViolationDate(this.value);'],]) ?>
            <?= $form->field($model, 'act_check')->textInput() ?>
            <?= $form->field($model, 'authoritie_check')->dropDownList(
                    ['МВД' => 'МВД', 'МЗК' => 'МЗК', 'КубЗК' => 'КубЗК', 'Прокуратура' => 'Прокуратура', 'ТО' => 'ТО', 'ТО внеплан' => 'ТО внеплан', 'ТО 28.1' => 'ТО 28.1', 'Другие' => 'Другие'],
                    ['prompt'=>'Выберите орган проводивший мероприятия']
            ) ?>
            <?= $form->field($model, 'order_check')->textInput() ?>
            <?= $form->field($model, 'land_user_category_id')->dropDownList(
                    ArrayHelper::map(GznLandUserCategory::find()->all(), 'id', 'name'),
                    ['prompt' => 'Выберите категорию землепользователя']
            ) ?>
            <?= $form->field($model, 'land_category_id')->dropDownList(
                    ArrayHelper::map(GznLandCategory::find()->all(), 'id', 'name'),
                    ['prompt' => 'Выберите категорию земель']
            ) ?>
            <?= $form->field($model, 'kn')->textInput() ?>
            <?= $form->field($model, 'kn_cost')->textInput() ?>

        </div>
        <div class="col-md-6">
            <?= $form->field($model, 'land_num')->textInput() ?>
            <?= $form->field($model, 'land_area')->textInput(['value' => Yii::$app->formatter->asDecimal($model->land_area, 1), 'pattern' => '\d+(\.\d{1})?']) ?>
            <?= $form->field($model, 'land_category')->textInput() ?>
            <?= $form->field($model, 'date_enforcement')->widget(DatePicker::classname(), ['language' => 'ru', 'dateFormat' => 'yyyy-MM-dd','options' => ['class' => 'form-control'],]) ?>
            <?= $form->field($model, 'address_land_plot')->textInput() ?>
            <?= $form->field($model, 'type_func_use')->textInput() ?>
            <?= $form->field($model, 'requisites_land_user')->textInput() ?>
            <?= $form->field($model, 'full_name_inspector')->textInput() ?>
            <?= $form->field($model, 'date_check')->textInput() ?>
            <?= $form->field($model, 'success')->checkbox(['onchange' => 'changeDescriptionViolation(this);']); ?>
            <?= $form->field($model, 'checklist')->checkbox();?>
            <?php
            foreach(Yii::$app->user->identity->groups as $value) {
                $pos = strpos($value, 'отдел gzn');
                if($pos !== FALSE) {
                    $idArea = AreaOtchet::find('id')->where(["name" => substr($value, 0, $pos + 10)])->one()["id"];
                    echo $form->field($model, 'area_id')->hiddenInput(['value' => $idArea])->label(false);
                }
            }
            ?>
        </div>
    </div>

    <?php DynamicFormWidget::begin([
        'widgetContainer' => 'dynamicform_wrapper', // required: only alphanumeric characters plus "_" [A-Za-z0-9_]
        'widgetBody' => '.container-items', // required: css class selector
        'widgetItem' => '.item', // required: css class
        'limit' => 7, // the maximum times, an element can be cloned (default 999)
        'min' => 0, // 0 or 1 (default 1)
        'insertButton' => '.add-item', // css class
        'deleteButton' => '.remove-item', // css class
        'model' => $modelsGznViolations[0],
        'formId' => 'dynamic-form',
        'formFields' => [
            //'gzn_obj_id',
            'adm_punishment_id',
            'violation_protocol',
            'decision_punishment',
            'amount_fine',
            'amount_fine_collected',
            'payment_doc',
            'violation_area',
            'date_due',
            'decision_appeal',
            'decision_cancellation',
            'violation_decision_end',
            'date_outgoing',
            'date_performance',
            'types_punishment_id',
        ],
    ]); ?>

    <div class="panel panel-default">
        <div class="panel-heading">
            <i class="fa fa-envelope"></i> Список нарушений
            <button type="button" class="pull-right add-item btn btn-success btn-xs"><i class="fa fa-plus"></i> Добавить нарушение</button>
            <div class="clearfix"></div>
        </div>
        <div class="panel-body container-items"><!-- widgetContainer -->
        <?php foreach ($modelsGznViolations as $i => $modelsGznViolations): ?>
            <div class="item panel panel-default"><!-- widgetBody -->
                <div class="panel-heading">
                    <h3 class="panel-title pull-left">Нарушение</h3>
                    <div class="pull-right">
                        <button type="button" class="add-item btn btn-success btn-xs"><i class="glyphicon glyphicon-plus"></i></button>
                        <button type="button" class="remove-item btn btn-danger btn-xs"><i class="glyphicon glyphicon-minus"></i></button>
                    </div>
                    <div class="clearfix"></div>
                </div>
                <div class="panel-body">
                    <?php
                        // necessary for update action.
                        if (!$modelsGznViolations->isNewRecord) {
                            echo Html::activeHiddenInput($modelsGznViolations, "[{$i}]id");
                        }
                    ?>
                    <div class="row">
                        <div class="col-sm-6">
                        <?= $form->field($modelsGznViolations, "[{$i}]adm_affairs")->textInput() ?>
                        <?= $form->field($modelsGznViolations, "[{$i}]note")->textArea(['rows' => '4']) ?>
                        <?= $form->field($modelsGznViolations, "[{$i}]adm_punishment_id")->dropDownList(ArrayHelper::map(GznAdmPunishment::find()->orderBy(['name' => SORT_ASC])->all(), 'id', 'name'), ['prompt' => 'Выберите статью']) ?>
                        <?= $form->field($modelsGznViolations, "[{$i}]violation_protocol")->widget(DatePicker::classname(), ['language' => 'ru', 'dateFormat' => 'yyyy-MM-dd','options' => ['class' => 'form-control'],]) ?>
                        <?= $form->field($modelsGznViolations, "[{$i}]place_proceeding")->widget(DatePicker::classname(), ['language' => 'ru', 'dateFormat' => 'yyyy-MM-dd','options' => ['class' => 'form-control'],]) ?>
                        <?= $form->field($modelsGznViolations, "[{$i}]decision_punishment")->widget(DatePicker::classname(), ['language' => 'ru', 'dateFormat' => 'yyyy-MM-dd','options' => ['class' => 'form-control', 'onchange' => 'changeDateDue(this.id)'],]) ?>
                        <?= $form->field($modelsGznViolations, "[{$i}]amount_fine")->textInput(['value' => Yii::$app->formatter->asDecimal($modelsGznViolations->amount_fine, 2), 'pattern' => '\d+(\.\d{2})?']) ?>
                        <?= $form->field($modelsGznViolations, "[{$i}]amount_fine_collected")->textInput(['value' => Yii::$app->formatter->asDecimal($modelsGznViolations->amount_fine_collected, 2), 'pattern' => '\d+(\.\d{2})?']) ?>
                        </div>
                        <div class="col-sm-6">
                        <?= $form->field($modelsGznViolations, "[{$i}]payment_doc")->textInput() ?>
                        <?= $form->field($modelsGznViolations, "[{$i}]violation_area")->textInput(['value' => Yii::$app->formatter->asDecimal($modelsGznViolations->violation_area, 1), 'pattern' => '\d+(\.\d{1})?']) ?>
                        <?= $form->field($modelsGznViolations, "[{$i}]date_due")->widget(DatePicker::classname(), ['language' => 'ru', 'dateFormat' => 'yyyy-MM-dd','options' => ['class' => 'form-control'],]) ?>
                        <?= $form->field($modelsGznViolations, "[{$i}]decision_appeal")->widget(DatePicker::classname(), ['language' => 'ru', 'dateFormat' => 'yyyy-MM-dd','options' => ['class' => 'form-control'],]) ?>
                        <?= $form->field($modelsGznViolations, "[{$i}]decision_cancellation")->widget(DatePicker::classname(), ['language' => 'ru', 'dateFormat' => 'yyyy-MM-dd','options' => ['class' => 'form-control'],]) ?>
                        <?= $form->field($modelsGznViolations, "[{$i}]violation_decision_end")->widget(DatePicker::classname(), ['language' => 'ru', 'dateFormat' => 'yyyy-MM-dd','options' => ['class' => 'form-control'],]) ?>
                        <?= $form->field($modelsGznViolations, "[{$i}]date_outgoing")->widget(DatePicker::classname(), ['language' => 'ru', 'dateFormat' => 'yyyy-MM-dd','options' => ['class' => 'form-control'],]) ?>
                        <?= $form->field($modelsGznViolations, "[{$i}]date_performance")->widget(DatePicker::classname(), ['language' => 'ru', 'dateFormat' => 'yyyy-MM-dd','options' => ['class' => 'form-control'],]) ?>
                        <?= $form->field($modelsGznViolations, "[{$i}]types_punishment_id")->dropDownList(ArrayHelper::map(GznTypesPunishment::find()->orderBy(['name' => SORT_ASC])->all(), 'id', 'name'), ['prompt' => 'Выберите вид наказания']) ?>
                        <?= $form->field($modelsGznViolations, "[{$i}]date_check")->textInput() ?>
                        </div>
                    </div><!-- .row -->
                </div>
            </div>
        <?php endforeach; ?>
        </div>
    </div>
    <?php DynamicFormWidget::end(); ?>

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

function getSalutationValue(value) {
    if(value == '3' ) {
        document.getElementById('gznobject-land_category').readOnly = true;
    } else {
        document.getElementById('gznobject-land_category').readOnly = false;
    }
}

function changeDateDue(value) {
    var lvAppeal = 'gznviolations-' + (+value.replace(/\D+/g,"")) + '-date_due';
    var lvPunishment = 'gznviolations-' + ((+value.replace(/\D+/g,""))) + '-decision_punishment';
    nextDay = new Date();
    document.getElementById(lvAppeal).value = addDays(document.getElementById(lvPunishment).value, 40);
}

function changeDescriptionViolation(element) {
    var checked = $(element).is(':checked');
    if (checked) {
        $('#gznobject-description_violation').val('');
        document.getElementById('gznobject-description_violation').readOnly = true;
    } else {
        document.getElementById('gznobject-description_violation').readOnly = false;
    }
}

function changeViolationDate(value) {

    if (value.length) {
        $('#gznobject-date_enforcement').val('');
        document.getElementById('gznobject-date_enforcement').readOnly = true;
    } else {
        document.getElementById('gznobject-date_enforcement').readOnly = false;
    }

}
</script>