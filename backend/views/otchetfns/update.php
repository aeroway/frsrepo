<?php

use yii\helpers\Html;

/* @var $this yii\web\View */
/* @var $model backend\models\Otchetfns */

$this->title = 'Редактировать: ' . $model->kn;
$this->params['breadcrumbs'][] = ['label' => 'Перечни без правообладателя', 'url' => ['index']];
$this->params['breadcrumbs'][] = ['label' => $model->id, 'url' => ['view', 'id' => $model->id]];
$this->params['breadcrumbs'][] = 'Редактировать';
?>
<div class="otchetfns-update">

    <h1><?php // echo Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
