<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;

/* @var $this yii\web\View */
/* @var $model backend\models\VedjustArchiveSearch */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="vedomost-check-form-add">

    <?php $form = ActiveForm::begin([
        'action' => ['index'],
        'method' => 'post',
    ]); ?>

    <?= $form->field($model, 'vedomost_num', [
            'template' => '<div class="input-group col-sm-2">{input}<span class="input-group-btn">' .
                '<div id="vedjustvedsearch-strict-search-affairs" role="radiogroup">'
                    . Html::submitButton('<span class="glyphicon glyphicon-plus"></span>', ['class' => 'btn btn-success', 'title' => 'Добавить']) .
                '</div>
            </span></div>',
        ])->textInput(['placeholder' => 'Номер ведомости', 'autofocus' => 'autofocus']); 
    ?>

    <?php ActiveForm::end(); ?>

</div>
