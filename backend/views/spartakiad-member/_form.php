<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;
use kartik\select2\Select2;
use yii\helpers\ArrayHelper;
use backend\models\SpartakiadDepartment;

/** @var yii\web\View $this */
/** @var backend\models\SpartakiadMember $model */
/** @var yii\widgets\ActiveForm $form */
?>

<div class="spartakiad-member-form">

    <?php $form = ActiveForm::begin(); ?>

    <?= $form->field($model, 'department_id')->widget(Select2::classname(), [
                'data' => ArrayHelper::map(SpartakiadDepartment::find()
                    ->orderBy(['name' => SORT_ASC])
                    ->all(), 'id', 'name'),
                'language' => 'ru',
                'options' => ['placeholder' => 'Выберите Управление'],
                'pluginOptions' => [
                    'allowClear' => true,
                    'tags' => false,
                ],
            ]);
        ?>

    <?= $form->field($model, 'name')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'sport_type')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'flag')->hiddenInput(['value'=> 0])->label(false); ?>

    <div class="form-group">
        <?= Html::submitButton('Сохранить', ['class' => 'btn btn-success']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
