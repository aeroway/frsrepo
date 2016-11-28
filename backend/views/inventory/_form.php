<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;
use yii\helpers\ArrayHelper;
use backend\models\Inventory;
use backend\models\InventoryMoo;
use backend\models\InventoryStatus;
use backend\models\InventoryTypetech;
use yii\jui\DatePicker;
use kartik\select2\Select2;

/* @var $this yii\web\View */
/* @var $model backend\models\Inventory */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="inventory-form">

    <?php $form = ActiveForm::begin(); ?>

    <?= $form->field($model, 'invname')->widget(Select2::classname(), [
        'data' => ArrayHelper::map(Inventory::find()->select('invname')->distinct()->orderBy(['invname' => SORT_ASC])->all(),'invname','invname'),
        'language' => 'ru',
        'options' => ['placeholder' => 'Выберите название'],
        'pluginOptions' => [
            'allowClear' => true,
            'tags' => true
        ],
    ]);
    ?>

    <?= $form->field($model, 'invnum')->widget(Select2::classname(), [
        'data' => ArrayHelper::map(Inventory::find()->select('invnum')->distinct()->orderBy(['invnum' => SORT_ASC])->all(),'invnum','invnum'),
        'language' => 'ru',
        'options' => ['placeholder' => 'Выберите название'],
        'pluginOptions' => [
            'allowClear' => true,
            'tags' => true
        ],
    ]);
    ?>

    <?= $form->field($model, 'id_moo')->widget(Select2::classname(), [
        'data' => ArrayHelper::map(InventoryMoo::find()->orderBy(['name' => SORT_ASC])->all(),'id','name'),
        'language' => 'ru',
        'options' => ['placeholder' => 'Выберите ответственного'],
        'pluginOptions' => [
            'allowClear' => true
        ],
    ]);
    ?>

    <?= $form->field($model, 'location')->textInput() ?>

    <?= $form->field($model, 'id_typetech')->dropDownList(
            ArrayHelper::map(InventoryTypetech::find()->orderBy(['name' => SORT_ASC])->all(),'id','name'),
            ['prompt'=>'Выберите Тип']
    ); ?>

    <?= $form->field($model, 'date')->textInput(['readonly' => true, 'value' => date("Y-m-d H:i:s") ]) ?>

    <?= $form->field($model, 'id_status')->dropDownList(
            ArrayHelper::map(InventoryStatus::find()->orderBy(['name' => SORT_ASC])->all(),'id','name'),
            ['prompt'=>'Выберите статус']
    ); ?>

    <?= $form->field($model, 'comment')->textInput() ?>

    <?= $form->field($model, 'authority')->dropDownList(
            ['0' => '-','1' => 'Да'],
            ['prompt'=>'Выберите наличие доверенности']
    ) ?>

    <?= $form->field($model, 'waybill')->dropDownList(
            ['0' => '-','1' => 'Да'],
            ['prompt'=>'Выберите наличие накладной']
    ) ?>

    <?= $form->field($model, 'username')->textInput(['readonly' => true, 'value' => Yii::$app->user->identity->username ]) ?>

    <div class="form-group">
        <?= Html::submitButton($model->isNewRecord ? 'Создать' : 'Обновить', ['class' => $model->isNewRecord ? 'btn btn-success' : 'btn btn-primary']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
