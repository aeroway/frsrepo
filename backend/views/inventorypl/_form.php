<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;
use yii\helpers\ArrayHelper;
use backend\models\InventoryParts;

/* @var $this yii\web\View */
/* @var $model backend\models\InventoryPartsLigament */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="inventory-parts-ligament-form">

    <?php $form = ActiveForm::begin(); ?>

    <?= $form->field($model, 'invnum_inventory')->textInput() ?>

    <?= $form->field($model, 'id_inventory_parts')->dropDownList(
            ArrayHelper::map(InventoryParts::find()->all(),'id','nameparts'),
            ['prompt'=>'Выберите Тип']
    ); ?>

    <?= $form->field($model, 'amount_ipl')->textInput() ?>

    <div class="form-group">
        <?= Html::submitButton($model->isNewRecord ? 'Создать' : 'Обновить', ['class' => $model->isNewRecord ? 'btn btn-success' : 'btn btn-primary']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
