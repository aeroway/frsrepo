<?php

use yii\helpers\Html;
use yii\helpers\ArrayHelper;
use yii\widgets\ActiveForm;
use backend\models\Otdelreq;
use backend\models\Type;
use backend\models\Cel;
use backend\models\Req;
use backend\models\ReqSt;

/* @var $this yii\web\View */
/* @var $model backend\models\Req */
/* @var $form yii\widgets\ActiveForm */
?>



<div class="req-form">

    <?php $form = ActiveForm::begin(); ?>

    <?= $form->field($model, 'otdel')->dropDownList(
            ArrayHelper::map(Otdelreq::find()->all(),'id','text'),
            ['prompt'=>'Выберите отдел']
    ) ?>

    <?= $form->field($model, 'type')->dropDownList(
            ArrayHelper::map(Type::find()->all(),'id','text'),
            ['prompt'=>'Выберите материал']
    ) ?>

    <?= $form->field($model, 'scan_doc')->textInput() ?>

    <?= $form->field($model, 'cel')->dropDownList(
            ArrayHelper::map(Cel::find()->all(),'id','text'),
            ['prompt'=>'Выберите цель']
    ) ?>

    <?= $form->field($model, 'zayavitel_fio')->textInput() ?>

    <?= $form->field($model, 'obj_addr')->textInput() ?>

    <?= $form->field($model, 'kn')->textInput() ?>

    <?= $form->field($model, 'kuvd')->textInput() ?>
    <?php
        //print_r(Yii::$app->user->identity->groups);
    ?>
    <?= $form->field($model, 'user_text')->textInput(['readonly' => true, 'value' => Yii::$app->user->identity->username]) ?>

    <?= $form->field($model, 'user_to')->textInput() ?>

    <?= $form->field($model, 'fast')->dropDownList(
            ['0' => 'Обычная','1' => 'Срочная'],
            ['prompt'=>'Выберите срочность']
    ) ?>

    <?= '<p>* Необходимо устанавливать только в случае действительной срочности.</p>' ?>

    <?php // $form->field($model, 'zayavitel_num')->textInput() ?>

    <?php //$form->field($model, 'obj_id')->textInput() ?>

    <?php //$form->field($model, 'kuvd_id')->textInput() ?>

    <?php //$form->field($model, 'status')->textInput() ?>

    <?php //$form->field($model, 'date_in')->textInput() ?>

    <?php //$form->field($model, 'coment')->textInput() ?>

    <?php //$form->field($model, 'cur_user')->textInput() ?>

    <?php //$form->field($model, 'date_end')->textInput() ?>

    <?php //$form->field($model, 'phone')->textInput() ?>

    <?php //$form->field($model, 'vedomost_num')->textInput() ?>

    <?php //$form->field($model, 'user_last')->textInput() ?>

    <?php //$form->field($model, 'vedomost_unform')->textInput() ?>

    <?php //$form->field($model, 'srok')->textInput() ?>

    <?php //$form->field($model, 'user_print')->textInput() ?>

    <?php //$form->field($model, 'print_date')->textInput() ?>

    <?php //$form->field($model, 'code_mesto')->textInput() ?>

    <?php //$form->field($model, 'date_v')->textInput() ?>

    <?php //$form->field($model, 'area_id')->textInput() ?>

    <?php //$form->field($model, 'org')->textInput() ?>

    <?php //$form->field($model, 'inn')->textInput() ?>

    <div class="form-group">
        <?= Html::submitButton($model->isNewRecord ? 'Добавить заявку' : 'Обновить', ['class' => $model->isNewRecord ? 'btn btn-success' : 'btn btn-primary']) ?>
        <?= Html::a('Отменить', ['index'], ['class'=>'btn btn-warning']) ?>
    </div>

    <?php ActiveForm::end(); ?>



</div>
