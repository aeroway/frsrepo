<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;

/* @var $this yii\web\View */
/* @var $model backend\models\EmployeeSearch */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="employee-search">

    <?php $form = ActiveForm::begin([
        'action' => ['index'],
        'method' => 'get',
    ]); ?>

    <?= $form->field($model, 'id') ?>

    <?= $form->field($model, 'fam') ?>

    <?= $form->field($model, 'name') ?>

    <?= $form->field($model, 'otch') ?>

    <?= $form->field($model, 'pasp_s') ?>

    <?php // echo $form->field($model, 'pasp_n') ?>

    <?php // echo $form->field($model, 'pasp_date_v') ?>

    <?php // echo $form->field($model, 'pasp_kem_v') ?>

    <?php // echo $form->field($model, 'adres_f') ?>

    <?php // echo $form->field($model, 'adres_reg') ?>

    <?php // echo $form->field($model, 'date_priem') ?>

    <?php // echo $form->field($model, 'gsdp_y') ?>

    <?php // echo $form->field($model, 'gsdp_m') ?>

    <?php // echo $form->field($model, 'gsdp_d') ?>

    <?php // echo $form->field($model, 'otsdp_y') ?>

    <?php // echo $form->field($model, 'otsdp_m') ?>

    <?php // echo $form->field($model, 'otsdp_d') ?>

    <?php // echo $form->field($model, 'ver') ?>

    <?php // echo $form->field($model, 'is_top') ?>

    <?php // echo $form->field($model, 'date_nazn') ?>

    <?php // echo $form->field($model, 'idm_otdel') ?>

    <?php // echo $form->field($model, 'idm_doljn') ?>

    <?php // echo $form->field($model, 'oklad') ?>

    <?php // echo $form->field($model, 'nadbavka') ?>

    <?php // echo $form->field($model, 'osnovanie') ?>

    <?php // echo $form->field($model, 'date_in') ?>

    <?php // echo $form->field($model, 'brak') ?>

    <?php // echo $form->field($model, 'suprug') ?>

    <?php // echo $form->field($model, 'phone') ?>

    <?php // echo $form->field($model, 'prikazi') ?>

    <?php // echo $form->field($model, 'status') ?>

    <?php // echo $form->field($model, 'data_b') ?>

    <?php // echo $form->field($model, 'tgs_y') ?>

    <?php // echo $form->field($model, 'tgs_m') ?>

    <?php // echo $form->field($model, 'tgs_d') ?>

    <?php // echo $form->field($model, 'date_stazh') ?>

    <?php // echo $form->field($model, 'voen_uch') ?>

    <?php // echo $form->field($model, 'voen_kom') ?>

    <?php // echo $form->field($model, 'inn') ?>

    <?php // echo $form->field($model, 'snils') ?>

    <?php // echo $form->field($model, 'voen_zvanie') ?>

    <?php // echo $form->field($model, 'stat') ?>

    <?php // echo $form->field($model, 'gos_reg') ?>

    <?php // echo $form->field($model, 'gos_inspect') ?>

    <?php // echo $form->field($model, 'status_to') ?>

    <?php // echo $form->field($model, 'foto') ?>

    <?php // echo $form->field($model, 'tos_y') ?>

    <?php // echo $form->field($model, 'tos_m') ?>

    <?php // echo $form->field($model, 'tos_d') ?>

    <?php // echo $form->field($model, 'pol') ?>

    <?php // echo $form->field($model, 'doplata_ur_percent') ?>

    <?php // echo $form->field($model, 'doplata_ur_prikaz') ?>

    <?php // echo $form->field($model, 'doplata_ur_data') ?>

    <?php // echo $form->field($model, 'nadbavka_stazh') ?>

    <?php // echo $form->field($model, 'nadbavka_stazh_raschet') ?>

    <?php // echo $form->field($model, 'login_upr') ?>

    <?php // echo $form->field($model, 'login_just') ?>

    <?php // echo $form->field($model, 'check_is_login') ?>

    <?php // echo $form->field($model, 'skud_card_num') ?>

    <?php // echo $form->field($model, 'date_uvolnen') ?>

    <div class="form-group">
        <?= Html::submitButton('Search', ['class' => 'btn btn-primary']) ?>
        <?= Html::resetButton('Reset', ['class' => 'btn btn-outline-secondary']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
