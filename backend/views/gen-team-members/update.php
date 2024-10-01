<?php

use yii\helpers\Html;

/** @var yii\web\View $this */
/** @var backend\models\GenTeamMembers $model */

$this->title = 'Редактирование: ' . $model->id;
$this->params['breadcrumbs'][] = ['label' => 'Участники', 'url' => ['index']];
$this->params['breadcrumbs'][] = ['label' => $model->full_name, 'url' => ['view', 'id' => $model->id]];
$this->params['breadcrumbs'][] = 'Редактирование';
?>
<div class="gen-team-members-update">

    <h1><?php // echo Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
