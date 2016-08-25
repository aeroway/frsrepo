<?php

use yii\helpers\Html;
use yii\helpers\ArrayHelper;
use yii\widgets\ActiveForm;

use yii\jui\DatePicker;
use backend\models\Req;

/* @var $this yii\web\View */
/* @var $model backend\models\Req */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="req-formstatus">

    <?php $form = ActiveForm::begin(); ?>


	<?= $form->field($model, 'date_return')->widget(DatePicker::classname(), ['language' => 'ru', 'dateFormat' => 'yyyy-MM-dd','options' => ['class' => 'form-control'],]); ?>

    <div class="formstatus-group">
        <?= Html::submitButton($model->isNewRecord ? 'Добавить заявку' : 'Обновить', ['class' => $model->isNewRecord ? 'btn btn-success' : 'btn btn-primary']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
