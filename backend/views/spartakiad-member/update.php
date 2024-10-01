<?php

use yii\helpers\Html;

/** @var yii\web\View $this */
/** @var backend\models\SpartakiadMember $model */

$this->title = 'Редактировать: ' . $model->name;
$this->params['breadcrumbs'][] = ['label' => 'Участники', 'url' => ['index']];
$this->params['breadcrumbs'][] = ['label' => $model->name, 'url' => ['view', 'id' => $model->id]];
$this->params['breadcrumbs'][] = 'Редактировать';
?>
<div class="spartakiad-member-update">

    <h1><?php // Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
