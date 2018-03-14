<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;
use kartik\select2\Select2;
use yii\helpers\ArrayHelper;
use backend\models\Plantask;
use wbraganca\dynamicform\DynamicFormWidget;

/* @var $this yii\web\View */
/* @var $model backend\models\Planstages */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="planstages-form">

    <?php $form = ActiveForm::begin(['id' => 'dynamic-form']); ?>

    <?= $form->field($model, 'name')->textInput() ?>

    <?= $form->field($model, 'executor')->hiddenInput(['readonly' => true, 'value' => '23UPR\\' . Yii::$app->user->identity->username])->label(false) ?>

    <?php
    if(strpos(Yii::$app->request->get("r"), 'create')) {
        if (!empty($_GET['sid'])) {
            echo $form->field($model, 'ptask_id')->hiddenInput(['value' => $_GET['sid']])->label(false);
        } else {
            echo $form->field($model, 'ptask_id')->widget(Select2::classname(), [
                    'data' => ArrayHelper::map(Plantask::find()->orderBy(['name' => SORT_ASC])->all(), 'id', 'name'),
                    'language' => 'ru',
                    'options' => ['placeholder' => 'Выберите задание'],
                    'pluginOptions' => [
                        'allowClear' => true
                    ],
                ]);
        }
    } else {
        echo $form->field($model, 'ptask_id')->hiddenInput(['value' => $model->ptask_id])->label(false);
    }
    ?>

    <div class="row">
        <div class="panel panel-default">
            <div class="panel-heading"><h4><i class="glyphicon glyphicon-envelope"></i> Замечания</h4></div>
            <div class="panel-body">
                 <?php DynamicFormWidget::begin([
                    'widgetContainer' => 'dynamicform_wrapper', // required: only alphanumeric characters plus "_" [A-Za-z0-9_]
                    'widgetBody' => '.container-items', // required: css class selector
                    'widgetItem' => '.item', // required: css class
                    'limit' => 7, // the maximum times, an element can be cloned (default 999)
                    'min' => 1, // 0 or 1 (default 1)
                    'insertButton' => '.add-item', // css class
                    'deleteButton' => '.remove-item', // css class
                    'model' => $modelsPlannotes[0],
                    'formId' => 'dynamic-form',
                    'formFields' => [
                        'pstages_id',
                        'text',
                    ],
                ]); ?>

                <div class="container-items"><!-- widgetContainer -->
                <?php foreach ($modelsPlannotes as $i => $modelsPlannotes): ?>
                    <div class="item panel panel-default"><!-- widgetBody -->
                        <div class="panel-heading">
                            <h3 class="panel-title pull-left">Комментарий</h3>
                            <div class="pull-right">
                                <button type="button" class="add-item btn btn-success btn-xs"><i class="glyphicon glyphicon-plus"></i></button>
                                <button type="button" class="remove-item btn btn-danger btn-xs"><i class="glyphicon glyphicon-minus"></i></button>
                            </div>
                            <div class="clearfix"></div>
                        </div>
                        <div class="panel-body">
                            <?php
                                // necessary for update action.
                                if (! $modelsPlannotes->isNewRecord) {
                                    echo Html::activeHiddenInput($modelsPlannotes, "[{$i}]id");
                                }
                            ?>
                            <div class="row">
                                <div class="col-sm-6">
                                    <?= $form->field($modelsPlannotes, "[{$i}]text")->textarea(['rows' => '5']) ?>
                                </div>
                                <div class="col-sm-6">
                                    <?= $form->field($modelsPlannotes, "[{$i}]status")->dropDownList(
                                            ['0' => 'Некритичное', '1' => 'Критичное', '2' => 'Нет замечаний'],
                                            ['prompt'=>'Выберите статус']
                                    ) ?>

                                    <?= $form->field($modelsPlannotes, "[{$i}]action")->dropDownList(
                                            ['РП' => 'РП', 'КУ' => 'КУ', 'РП + КУ' => 'РП + КУ',],
                                            ['prompt'=>'Выберите действие']
                                    ) ?>
                                </div>
                            </div><!-- .row -->
                        </div>
                    </div>
                <?php endforeach; ?>
                </div>
                <?php DynamicFormWidget::end(); ?>
            </div>
        </div>
    </div>

    <div class="form-group">
        <?= Html::submitButton('Сохранить', ['class' => 'btn btn-success']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
