<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;

use wbraganca\dynamicform\DynamicFormWidget;
use backend\models\Inventory;
use backend\models\InventoryParts;
use backend\models\InventoryOrder;
use kartik\select2\Select2;
use yii\helpers\ArrayHelper;

/* @var $this yii\web\View */
/* @var $model backend\models\InventoryPartsorder */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="inventory-partsorder-form">

    <?php
		$form = ActiveForm::begin([
			'id' => 'dynamic-form',
		]);
	?>

	<?= $form->field($model, 'invnum_invor')->widget(Select2::classname(), [
		'data' => ArrayHelper::map(Inventory::find()->select('invnum')->distinct()->orderBy(['invnum' => SORT_ASC])->all(),'invnum','invnum'),
		'language' => 'ru',
		'options' => [
			'placeholder' => 'Инв. номер',
			'onchange' => '
				$.post( "index.php?r=inventory-order/lists&id='.'"+$(this).val(), function( data ) {
					$( "input#inventoryorder-invname_invor" ).val( data );
				});'
		],
		'pluginOptions' => [
			'allowClear' => true,
			'tags' => true,
		],
	]);
	?>

	<?= $form->field($model, 'invname_invor')->textInput(); ?>

	
	<?= $form->field($model, 'ip_invor')->textInput(['readonly' => true, 'value' => Yii::$app->getRequest()->getUserIP()]); ?>
	
	<?= $form->field($model, 'user_invor')->textInput(['readonly' => true, 'value' => Yii::$app->user->identity->username ]) ?>
	

    <div class="form-group">
        <?= Html::submitButton($model->isNewRecord ? 'Создать' : 'Обновить', ['class' => $model->isNewRecord ? 'btn btn-success' : 'btn btn-primary']) ?>
    </div>

	<div class="row">
	    <div class="panel panel-default">
	        <div class="panel-heading"><h4><i class="glyphicon glyphicon-envelope"></i> Запчасти</h4></div>
	        <div class="panel-body">
	             <?php DynamicFormWidget::begin([
	                'widgetContainer' => 'dynamicform_wrapper', // required: only alphanumeric characters plus "_" [A-Za-z0-9_]
	                'widgetBody' => '.container-items', // required: css class selector
	                'widgetItem' => '.item', // required: css class
	                'limit' => 4, // the maximum times, an element can be cloned (default 999)
	                'min' => 1, // 0 or 1 (default 1)
	                'insertButton' => '.add-item', // css class
	                'deleteButton' => '.remove-item', // css class
	                'model' => $modelsPoItem[0],
	                'formId' => 'dynamic-form',
	                'formFields' => [
	                    'partsname_invpo',
	                    'count_invpo',
	                ],
	            ]); ?>

	            <div class="container-items"><!-- widgetContainer -->
	            <?php foreach ($modelsPoItem as $i => $modelsPoItem): ?>
	                <div class="item panel panel-default"><!-- widgetBody -->
	                    <div class="panel-heading">
	                        <h3 class="panel-title pull-left">Запчасть</h3>
	                        <div class="pull-right">
	                            <button type="button" class="add-item btn btn-success btn-xs"><i class="glyphicon glyphicon-plus"></i></button>
	                            <button type="button" class="remove-item btn btn-danger btn-xs"><i class="glyphicon glyphicon-minus"></i></button>
	                        </div>
	                        <div class="clearfix"></div>
	                    </div>
	                    <div class="panel-body">
	                        <?php
	                            // necessary for update action.
	                            if (! $modelsPoItem->isNewRecord) {
	                                echo Html::activeHiddenInput($modelsPoItem, "[{$i}]id");
	                            }
	                        ?>
	                        <div class="row">
	                            <div class="col-sm-6">
	                                <?= $form->field($modelsPoItem, "[{$i}]partsname_invpo")->widget(Select2::classname(), [
											'data' => ArrayHelper::map(InventoryParts::find()->select('nameparts')->orderBy(['nameparts' => SORT_ASC])->all(),'nameparts','nameparts'),
											'language' => 'ru',
											'options' => [
												'placeholder' => 'Наим. зап. части',
											],
											'pluginOptions' => [
												'allowClear' => true,
												'tags' => true,
												'maxlength' => true
											],
										]);
									?>
	                            </div>
	                            <div class="col-sm-6">
	                                <?= $form->field($modelsPoItem, "[{$i}]count_invpo")->textInput(
											[
												'maxlength' => true,
												'onchange' => '
													$.get( "index.php?r=inventory-order/validation&count='.'"+$(this).val()+"'.'&namepart='.'"+$("select#inventorypartsorder-'.'"+( (event.target.id).substring(20,21) )+"'.'-partsname_invpo").val(), function( data ) {
														if(data) {$("input#inventorypartsorder-'.'"+( (event.target.id).substring(20,21) )+"'.'-count_invpo").val( data );}
													});'
											]) ?>
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

    <?php ActiveForm::end(); ?>

</div>
