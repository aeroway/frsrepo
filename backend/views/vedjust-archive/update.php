<?php

use yii\helpers\Html;

/* @var $this yii\web\View */
/* @var $model backend\models\VedomostCheckForm */

$this->title = 'Редактировать: ' . $model->vedomost_num;
$this->params['breadcrumbs'][] = ['label' => 'Приём дел в архив', 'url' => ['index']];
$this->params['breadcrumbs'][] = ['label' => $model->vedomost_num, 'url' => ['view', 'id' => $model->id]];
$this->params['breadcrumbs'][] = 'Редактировать';
?>
<div class="vedomost-check-form-update">

    <h1><?php // echo Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
