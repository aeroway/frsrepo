<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;

/* @var $this yii\web\View */
/* @var $model backend\models\ReqSearch */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="req-search">

    <?php $form = ActiveForm::begin([
        'action' => ['index'],
        'method' => 'get',
    ]); ?>

    <?= $form->field($model, 'id', 
        [
            'template' => '<div class="input-group col-xs-2">{input}<span class="input-group-btn">' .
            Html::submitButton('Поиск', ['class' => 'btn btn-default']) . '</span></div>',
        ])->textInput(['placeholder' => 'УИД']);
    ?>

    <?= $form->field($model, 'status')->hiddenInput(['value' => ''])->label(false); ?>

    <?php ////$form->field($model, 'obj_addr') ?>

    <?php ////$form->field($model, 'zayavitel_num') ?>

    <?php ////$form->field($model, 'zayavitel_fio') ?>

    <?php ////$form->field($model, 'obj_id') ?>

    <?php // echo $form->field($model, 'kuvd') ?>

    <?php // echo $form->field($model, 'kuvd_id') ?>

    <?php // echo $form->field($model, 'user_text') ?>

    <?php // echo $form->field($model, 'status') ?>

    <?php // echo $form->field($model, 'date_in') ?>

    <?php // echo $form->field($model, 'user_to') ?>

    <?php // echo $form->field($model, 'kn') ?>

    <?php // echo $form->field($model, 'coment') ?>

    <?php // echo $form->field($model, 'type') ?>

    <?php // echo $form->field($model, 'otdel') ?>

    <?php // echo $form->field($model, 'cel') ?>

    <?php // echo $form->field($model, 'cur_user') ?>

    <?php // echo $form->field($model, 'date_end') ?>

    <?php // echo $form->field($model, 'fast') ?>

    <?php // echo $form->field($model, 'phone') ?>

    <?php // echo $form->field($model, 'vedomost_num') ?>

    <?php // echo $form->field($model, 'user_last') ?>

    <?php // echo $form->field($model, 'vedomost_unform') ?>

    <?php // echo $form->field($model, 'srok') ?>

    <?php // echo $form->field($model, 'user_print') ?>

    <?php // echo $form->field($model, 'print_date') ?>

    <?php // echo $form->field($model, 'code_mesto') ?>

    <?php // echo $form->field($model, 'date_v') ?>

    <?php // echo $form->field($model, 'area_id') ?>

    <?php // echo $form->field($model, 'org') ?>

    <?php // echo $form->field($model, 'inn') ?>

    <div class="form-group">
        <?php //Html::submitButton('Search', ['class' => 'btn btn-primary']) ?>
        <?php //Html::resetButton('Reset', ['class' => 'btn btn-default']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
