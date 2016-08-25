<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;
use yii\helpers\ArrayHelper;
use backend\models\InventoryTypeparts;

/* @var $this yii\web\View */
/* @var $model backend\models\InventoryParts */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="inventory-parts-form">

    <?php $form = ActiveForm::begin(); ?>

    <?= $form->field($model, 'nameparts')->textInput() ?>

    <?= $form->field($model, 'id_typeparts')->dropDownList(
			ArrayHelper::map(InventoryTypeparts::find()->orderBy(['name' => SORT_ASC])->all(),'id','name'),
			['prompt'=>'Выберите тип']
	); ?>

    <?= $form->field($model, 'amount')->textInput() ?>

    <?= $form->field($model, 'location')->textInput() ?>

    <?= $form->field($model, 'comment_parts')->textInput() ?>

    <div class="form-group">
        <?= Html::submitButton($model->isNewRecord ? 'Создать' : 'Обновить', ['class' => $model->isNewRecord ? 'btn btn-success' : 'btn btn-primary']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
