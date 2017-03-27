<?php

use yii\helpers\Html;

/* @var $this yii\web\View */
/* @var $model backend\models\Lbo */

$this->title = 'Редактировать ЛБО: ' . $model->id;
$this->params['breadcrumbs'][] = ['label' => 'ЛБО', 'url' => ['index']];
$this->params['breadcrumbs'][] = ['label' => $model->id, 'url' => ['view', 'id' => $model->id]];
$this->params['breadcrumbs'][] = 'Редактировать';
?>
<div class="lbo-update">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
