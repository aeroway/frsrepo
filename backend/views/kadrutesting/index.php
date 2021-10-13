<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;
use kartik\select2\Select2;
use yii\helpers\ArrayHelper;
use backend\models\Otdel;

/* @var $this yii\web\View */

$this->title = 'Тестирование';
$this->params['breadcrumbs'][] = $this->title;
?>

<div class="kadrutesting-index">

    <?php if (Yii::$app->session->hasFlash('success')): ?>
        <div class="alert alert-success alert-dismissable">
            <button aria-hidden="true" data-dismiss="alert" class="close" type="button">×</button>
            <?= Yii::$app->session->getFlash('success') ?>
        </div>
    <?php endif; ?>

    <?php $form = ActiveForm::begin(); ?>

    <?= $form->field($model, 'otdel_id')->widget(Select2::classname(), [
            'data' => ArrayHelper::map(Otdel::find()
                ->innerJoin('vopros', 'otdel.id = vopros.otdel_id')
                ->where(['and', 
                    ['<=', 'otdel.date_start', date("Y-m-d H:i:s.000")],
                    ['>=', 'otdel.date_stop', date("Y-m-d H:i:s.000")]
                ])
                ->orderBy(['text' => SORT_ASC])
                ->all(), 'id', 'text'),
            'language' => 'ru',
            'options' => ['placeholder' => 'Выберите раздел'],
            'pluginOptions' => [
                'allowClear' => true,
                'tags' => false,
            ],
        ])->label('Раздел');
    ?>

    <?= $form->field($model, 'username')->textInput([
        'readonly' => true,
        'value' => empty(Yii::$app->user->identity->fio) ? Yii::$app->user->identity->username : Yii::$app->user->identity->fio
    ]); ?>

    <div class="form-group">
        <?= Html::submitButton('Далее', ['class' => 'btn btn-success']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>