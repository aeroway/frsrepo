<?php

use yii\helpers\Html;

/* @var $this yii\web\View */
/* @var $model backend\models\SgrRegulations */

$this->title = 'Добавить';
$this->params['breadcrumbs'][] = ['label' => 'Регламент Совета', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="sgr-regulations-create">

    <h1><?php // echo Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
