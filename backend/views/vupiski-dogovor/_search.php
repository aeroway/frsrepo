<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;

/* @var $this yii\web\View */
/* @var $model backend\models\VupiskiDogovorSearch */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="vupiski-dogovor-search">

    <?php $form = ActiveForm::begin([
        'action' => ['index'],
        'method' => 'get',
    ]); ?>

    <?= $form->field($model, 'id') ?>

    <?= $form->field($model, 'pr_name_f') ?>

    <?= $form->field($model, 'pr_name_s') ?>

    <?= $form->field($model, 'pr_name_l') ?>

    <?= $form->field($model, 'pr_date_b') ?>

    <?php // echo $form->field($model, 'pr_mesto_b') ?>

    <?php // echo $form->field($model, 'pr_pol') ?>

    <?php // echo $form->field($model, 'pr_pasp_s') ?>

    <?php // echo $form->field($model, 'pr_pasp_n') ?>

    <?php // echo $form->field($model, 'pr_vudan') ?>

    <?php // echo $form->field($model, 'pr_vudan_data') ?>

    <?php // echo $form->field($model, 'pr_adres_reg') ?>

    <?php // echo $form->field($model, 'pr_kod_podrazd') ?>

    <?php // echo $form->field($model, 'pok_name_f') ?>

    <?php // echo $form->field($model, 'pok_name_s') ?>

    <?php // echo $form->field($model, 'pok_name_l') ?>

    <?php // echo $form->field($model, 'pok_date_b') ?>

    <?php // echo $form->field($model, 'pok_mesto_b') ?>

    <?php // echo $form->field($model, 'pok_pol') ?>

    <?php // echo $form->field($model, 'pok_pasp_s') ?>

    <?php // echo $form->field($model, 'pok_pasp_n') ?>

    <?php // echo $form->field($model, 'pok_vudan') ?>

    <?php // echo $form->field($model, 'pok_vudan_data') ?>

    <?php // echo $form->field($model, 'pok_adres_reg') ?>

    <?php // echo $form->field($model, 'pok_kod_podrazd') ?>

    <?php // echo $form->field($model, 'obj_type') ?>

    <?php // echo $form->field($model, 'obj_kn') ?>

    <?php // echo $form->field($model, 'obj_adres') ?>

    <?php // echo $form->field($model, 'obj_square') ?>

    <?php // echo $form->field($model, 'obj_square_l') ?>

    <?php // echo $form->field($model, 'obj_cnt_room') ?>

    <?php // echo $form->field($model, 'obj_floor') ?>

    <?php // echo $form->field($model, 'obj_pod') ?>

    <?php // echo $form->field($model, 'dop_info') ?>

    <?php // echo $form->field($model, 'cena') ?>

    <?php // echo $form->field($model, 'doc_osn') ?>

    <?php // echo $form->field($model, 'date_doc_osn') ?>

    <?php // echo $form->field($model, 'zapis_v_egrp') ?>

    <?php // echo $form->field($model, 'date_zapis_v_egrp') ?>

    <?php // echo $form->field($model, 'svid') ?>

    <?php // echo $form->field($model, 'date_svid') ?>

    <?php // echo $form->field($model, '_from') ?>

    <?php // echo $form->field($model, 'date_in') ?>

    <?php // echo $form->field($model, 'istochnik') ?>

    <?php // echo $form->field($model, 'ip') ?>

    <?php // echo $form->field($model, 'time_start') ?>

    <?php // echo $form->field($model, 'time_end') ?>

    <?php // echo $form->field($model, 'status') ?>

    <?php // echo $form->field($model, 'type_d') ?>

    <?php // echo $form->field($model, 'floors_dom') ?>

    <?php // echo $form->field($model, 'pod_oni') ?>

    <?php // echo $form->field($model, 'invn_oni') ?>

    <?php // echo $form->field($model, 'liter_oni') ?>

    <?php // echo $form->field($model, 'zem_oni') ?>

    <?php // echo $form->field($model, 'nazn_oni') ?>

    <?php // echo $form->field($model, 'square_oni_zu') ?>

    <?php // echo $form->field($model, 'square_oni_dom') ?>

    <?php // echo $form->field($model, 'kn_oni_dom') ?>

    <?php // echo $form->field($model, 'doc_osn_oni_dom') ?>

    <?php // echo $form->field($model, 'date_doc_osn_oni_dom') ?>

    <?php // echo $form->field($model, 'pravo_polz_zu') ?>

    <?php // echo $form->field($model, 'num_nej_pom') ?>

    <?php // echo $form->field($model, 'inv_ocenka') ?>

    <div class="form-group">
        <?= Html::submitButton('Search', ['class' => 'btn btn-primary']) ?>
        <?= Html::resetButton('Reset', ['class' => 'btn btn-outline-secondary']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
