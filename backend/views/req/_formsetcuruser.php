<?php

use yii\helpers\Html;
use yii\helpers\ArrayHelper;
use yii\widgets\ActiveForm;

//use backend\models\ReqSt;

/* @var $this yii\web\View */
/* @var $model backend\models\Req */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="req-setcuruser">

    <?php $form = ActiveForm::begin(); ?>

    <?= $form->field($model, 'cur_user')->textInput(['placeholder' => 'Фамилия И.О.']); ?>

    <div class="setcuruser-group">
        <?= Html::submitButton($model->isNewRecord ? 'Добавить заявку' : 'Обновить', ['class' => $model->isNewRecord ? 'btn btn-success' : 'btn btn-primary']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
