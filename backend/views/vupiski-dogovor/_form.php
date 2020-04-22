<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;

/* @var $this yii\web\View */
/* @var $model backend\models\VupiskiDogovor */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="vupiski-dogovor-form">

    <?php $form = ActiveForm::begin(); ?>

    <?= $form->field($model, 'pr_name_f')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'pr_name_s')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'pr_name_l')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'pr_date_b')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'pr_mesto_b')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'pr_pol')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'pr_pasp_s')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'pr_pasp_n')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'pr_vudan')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'pr_vudan_data')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'pr_adres_reg')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'pr_kod_podrazd')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'pok_name_f')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'pok_name_s')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'pok_name_l')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'pok_date_b')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'pok_mesto_b')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'pok_pol')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'pok_pasp_s')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'pok_pasp_n')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'pok_vudan')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'pok_vudan_data')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'pok_adres_reg')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'pok_kod_podrazd')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'obj_type')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'obj_kn')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'obj_adres')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'obj_square')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'obj_square_l')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'obj_cnt_room')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'obj_floor')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'obj_pod')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'dop_info')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'cena')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'doc_osn')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'date_doc_osn')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'zapis_v_egrp')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'date_zapis_v_egrp')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'svid')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'date_svid')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, '_from')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'date_in')->textInput() ?>

    <?= $form->field($model, 'istochnik')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'ip')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'time_start')->textInput() ?>

    <?= $form->field($model, 'time_end')->textInput() ?>

    <?= $form->field($model, 'status')->textInput() ?>

    <?= $form->field($model, 'type_d')->textInput() ?>

    <?= $form->field($model, 'floors_dom')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'pod_oni')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'invn_oni')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'liter_oni')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'zem_oni')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'nazn_oni')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'square_oni_zu')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'square_oni_dom')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'kn_oni_dom')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'doc_osn_oni_dom')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'date_doc_osn_oni_dom')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'pravo_polz_zu')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'num_nej_pom')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'inv_ocenka')->textInput(['maxlength' => true]) ?>

    <div class="form-group">
        <?= Html::submitButton('Save', ['class' => 'btn btn-success']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
