<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;

use backend\models\Inventory;
use yii\helpers\ArrayHelper;

use kartik\select2\Select2;

/* @var $this yii\web\View */
/* @var $model backend\models\InventoryParts */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="inventory-parts-form">

    <?php $form = ActiveForm::begin(); ?>

	<?= $form->field($model, 'invnum_inventory')->widget(Select2::classname(), [
		'data' => ArrayHelper::map(Inventory::find()->all(),'invnum','invnum'),
		'language' => 'ru',
		'options' => ['placeholder' => 'Выберите инвентарный номер'],
		'pluginOptions' => [
			'allowClear' => true
		],
	]);
	?>

    <?= $form->field($model, 'amount_ipl')->textInput() ?>

    <?= $form->field($model, 'id_inventory_parts')->hiddenInput(['value' => Yii::$app->request->get('id')])->label(false) ?>

    <div class="form-group">
        <?= Html::submitButton($model->isNewRecord ? 'Создать' : 'Обновить', ['class' => $model->isNewRecord ? 'btn btn-success' : 'btn btn-primary']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
