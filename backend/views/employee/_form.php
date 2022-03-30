<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;

/* @var $this yii\web\View */
/* @var $model backend\models\Employee */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="employee-form">

    <?php $form = ActiveForm::begin(); ?>

    <?= $form->field($model, 'fam')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'name')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'otch')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'pasp_s')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'pasp_n')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'pasp_date_v')->textInput() ?>

    <?= $form->field($model, 'pasp_kem_v')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'adres_f')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'adres_reg')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'date_priem')->textInput() ?>

    <?= $form->field($model, 'gsdp_y')->textInput() ?>

    <?= $form->field($model, 'gsdp_m')->textInput() ?>

    <?= $form->field($model, 'gsdp_d')->textInput() ?>

    <?= $form->field($model, 'otsdp_y')->textInput() ?>

    <?= $form->field($model, 'otsdp_m')->textInput() ?>

    <?= $form->field($model, 'otsdp_d')->textInput() ?>

    <?= $form->field($model, 'ver')->textInput() ?>

    <?= $form->field($model, 'is_top')->textInput() ?>

    <?= $form->field($model, 'date_nazn')->textInput() ?>

    <?= $form->field($model, 'idm_otdel')->textInput() ?>

    <?= $form->field($model, 'idm_doljn')->textInput() ?>

    <?= $form->field($model, 'oklad')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'nadbavka')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'osnovanie')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'date_in')->textInput() ?>

    <?= $form->field($model, 'brak')->textInput() ?>

    <?= $form->field($model, 'suprug')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'phone')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'prikazi')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'status')->textInput() ?>

    <?= $form->field($model, 'data_b')->textInput() ?>

    <?= $form->field($model, 'tgs_y')->textInput() ?>

    <?= $form->field($model, 'tgs_m')->textInput() ?>

    <?= $form->field($model, 'tgs_d')->textInput() ?>

    <?= $form->field($model, 'date_stazh')->textInput() ?>

    <?= $form->field($model, 'voen_uch')->textInput() ?>

    <?= $form->field($model, 'voen_kom')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'inn')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'snils')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'voen_zvanie')->textInput() ?>

    <?= $form->field($model, 'stat')->textInput() ?>

    <?= $form->field($model, 'gos_reg')->textInput() ?>

    <?= $form->field($model, 'gos_inspect')->textInput() ?>

    <?= $form->field($model, 'status_to')->textInput() ?>

    <?= $form->field($model, 'foto')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'tos_y')->textInput() ?>

    <?= $form->field($model, 'tos_m')->textInput() ?>

    <?= $form->field($model, 'tos_d')->textInput() ?>

    <?= $form->field($model, 'pol')->textInput() ?>

    <?= $form->field($model, 'doplata_ur_percent')->textInput() ?>

    <?= $form->field($model, 'doplata_ur_prikaz')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'doplata_ur_data')->textInput() ?>

    <?= $form->field($model, 'nadbavka_stazh')->textInput() ?>

    <?= $form->field($model, 'nadbavka_stazh_raschet')->textInput() ?>

    <?= $form->field($model, 'login_upr')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'login_just')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'check_is_login')->textInput() ?>

    <?= $form->field($model, 'skud_card_num')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'date_uvolnen')->textInput() ?>

    <div class="form-group">
        <?= Html::submitButton('Save', ['class' => 'btn btn-success']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
