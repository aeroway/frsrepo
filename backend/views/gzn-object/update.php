<?php

use yii\helpers\Html;

/* @var $this yii\web\View */
/* @var $model backend\models\GznObject */

$this->title = 'Редактировать объект: ' . $model->id;
$this->params['breadcrumbs'][] = ['label' => 'Объект проверок', 'url' => ['index']];
$this->params['breadcrumbs'][] = ['label' => $model->id, 'url' => ['view', 'id' => $model->id]];
$this->params['breadcrumbs'][] = 'Редактировать';
?>
<div class="gzn-object-update">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
        'modelsGznViolations' => $modelsGznViolations,
    ]) ?>

</div>
