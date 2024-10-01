<?php

use yii\helpers\Html;

/** @var yii\web\View $this */
/** @var backend\models\Otcheterl $model */

$this->title = 'Редактировать: ' . $model->kuvd;
$this->params['breadcrumbs'][] = ['label' => 'Журнал запросов', 'url' => ['index']];
$this->params['breadcrumbs'][] = ['label' => $model->kuvd, 'url' => ['view', 'id' => $model->id]];
$this->params['breadcrumbs'][] = 'Редактировать';
?>
<div class="otcheterl-update">

    <h1><?php // echo Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
