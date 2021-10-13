<?php

use yii\helpers\Html;
use yii\helpers\ArrayHelper;
use yii\bootstrap\ActiveForm;
use kartik\select2\Select2;
use backend\models\Otdel;

/* @var $this yii\web\View */

$this->title = 'Тестирование';
$this->params['breadcrumbs'][] = $this->title;
?>

<div class="kadrutesting-answers">

    <?php $form = ActiveForm::begin(); ?>

    <h3><?= $questionRes->text; ?></h3>

    <?= Html::img(Yii::$app->request->baseUrl . 'uploads/kadru/' . $questionRes->image, ['class' => 'img-responsive', 'style' => '']); ?>

    <?= $form->field($modelRes, 'id_vopros')
        ->hiddenInput(['value' => $questionRes->id])
        ->label(false);
    ?>

    <?= $form->field($modelRes, 'id_otvet')
        ->inline(false)
        ->radioList(ArrayHelper::map($answers, 'id', 'text'))
        ->label(false);
    ?>

    <?= $form->field($modelRes, 'otdel_id')
        ->hiddenInput(['value' => $questionRes->otdel_id])
        ->label(false);
    ?>

    <div class="form-group">
        <?= Html::submitButton('Далее', ['class' => 'btn btn-success']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>