<?php

use yii\helpers\Html;

/* @var $this yii\web\View */
/* @var $model backend\models\DocSrchReq */

$this->title = 'Редактирование: ' . $model->id;
$this->params['breadcrumbs'][] = ['label' => 'Запрос на поиск документов для передачи в МФЦ', 'url' => ['index']];
$this->params['breadcrumbs'][] = ['label' => $model->id, 'url' => ['view', 'id' => $model->id]];
$this->params['breadcrumbs'][] = 'Редактировать';
?>
<div class="doc-srch-req-update">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
