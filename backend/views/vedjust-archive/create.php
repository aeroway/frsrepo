<?php

use yii\helpers\Html;

/* @var $this yii\web\View */
/* @var $model backend\models\VedomostCheckForm */

$this->title = 'Добавить';
$this->params['breadcrumbs'][] = ['label' => 'Приём дел в архив', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="vedomost-check-form-create">

    <h1><?php // echo Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
