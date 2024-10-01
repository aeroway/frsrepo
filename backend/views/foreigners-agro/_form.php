<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;
use yii\jui\DatePicker;

/** @var yii\web\View $this */
/** @var backend\models\ForeignersAgro $model */
/** @var yii\widgets\ActiveForm $form */
?>

<div class="foreigners-agro-form">

    <?php $form = ActiveForm::begin(); ?>

    <?= $form->field($model, 'kn')->textInput(['maxlength' => true])->label('Кадастровый номер ЗУ') ?>

    <?= $form->field($model, 'address')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'category')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'permit_use')->textInput(['maxlength' => true])->label('Вид разрешенного использования') ?>

    <?= $form->field($model, 'num_reg')->textInput(['maxlength' => true])->label('Номер регистрации') ?>

    <?= $form->field($model, 'date_reg')->widget(DatePicker::classname(), ['language' => 'ru', 'dateFormat' => 'yyyy-MM-dd', 'options' => ['class' => 'form-control'],])->label('Дата регистрации права') ?>

    <?= $form->field($model, 'date_term_right')->widget(DatePicker::classname(), ['language' => 'ru', 'dateFormat' => 'yyyy-MM-dd', 'options' => ['class' => 'form-control'],])->label('Дата прекращения права') ?>

    <?= $form->field($model, 'fio')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'citizenship')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'notice_ogv_oms')->textInput(['maxlength' => true])->label('Извещения в ОГВ, ОМС о неисполнении собственником земельного 
        участка требований по отчуждению земельного участка в течение года с момента возникновения у него права на такой земельный участок (исходящий номер, дата)') ?>

    <?= $form->field($model, 'notice_prosecutor')->textInput(['maxlength' => true])->label('Уведомления, направленные в органы прокуратуры по истечении 6 месяцев с 
        момента направления извещения о непринятии органами государственной власти мер по понуждению собственников к отчуждению земельных участков') ?>

    <?= $form->field($model, 'sent_claims_ogv')->textInput(['maxlength' => true])->label('Направленные органами государственной власти иски в 
        судебные органы о понуждении собственника к отчуждению земельного участка') ?>

    <?= $form->field($model, 'notice_interior_portal')->textInput(['maxlength' => true])->label('Извещения в органы государственной власти, органы местного 
        самоуправления, размещённые на внутреннем портале Росреестра, поскольку по истечении 9 месяцев с момента направления такого извещения, земельный участок 
        по-прежнему остаётся в собственности иностранного лица (с целью дальнейшего доведения такой информации до Генеральной прокуратуры Российской Федерации) (из графы 8)') ?>

    <div class="form-group">
        <?= Html::submitButton('Сохранить', ['class' => 'btn btn-success']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
