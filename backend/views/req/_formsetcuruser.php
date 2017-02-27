<?php

use yii\helpers\Html;
use yii\helpers\ArrayHelper;
use yii\widgets\ActiveForm;

use backend\models\ReqSt;

/* @var $this yii\web\View */
/* @var $model backend\models\Req */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="req-setcuruser">

    <?php $form = ActiveForm::begin(); ?>

    <?= $form->field($model, 'cur_user')->textInput(['placeholder' => 'Фамилия И.О.']); ?>
    <?= $form->field($model, 'status')->radioList(ArrayHelper::map(ReqSt::find()->orderBy(['priority' => SORT_ASC])->all(),'id','text'),
            [
                'item' => function ($index, $label, $name, $checked, $value) {
                    return '<div class="radio"><label>' . Html::radio($name, $checked, ['value' => $value]) . $label . '</label></div>';
                },
            ]
        )->label('Статус');
    ?>
    <?= $form->field($model, 'coment')->textInput() ?>

    <div class="setcuruser-group">

        <?= Html::submitButton($model->isNewRecord ? 'Добавить заявку' : 'Назначить', ['class' => $model->isNewRecord ? 'btn btn-success' : 'btn btn-primary']) ?>

        <?php
        /*
        if(in_array("alvl3", Yii::$app->user->identity->groups) or in_array("alvl4", Yii::$app->user->identity->groups))
        {
            $url=Yii::$app->getUrlManager()->createUrl(['req/print','id'=>$model['id']]);

            echo Html::a('Печать', $url, ['target'=>'_blank', 'class' => 'btn btn-success']);
        }
        */
        ?>

    </div>

    <?php ActiveForm::end(); ?>

</div>
