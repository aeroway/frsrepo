<?php

use yii\helpers\Html;

/* @var $this yii\web\View */
/* @var $model backend\models\HrEvents */

$this->title = 'Update Hr Events: ' . $model->id;
$this->params['breadcrumbs'][] = ['label' => 'Hr Events', 'url' => ['index']];
$this->params['breadcrumbs'][] = ['label' => $model->id, 'url' => ['view', 'id' => $model->id]];
$this->params['breadcrumbs'][] = 'Update';
?>
<div class="hr-events-update">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
