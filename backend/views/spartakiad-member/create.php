<?php

use yii\helpers\Html;

/** @var yii\web\View $this */
/** @var backend\models\SpartakiadMember $model */

$this->title = 'Добавить';
$this->params['breadcrumbs'][] = ['label' => 'Участники', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="spartakiad-member-create">

    <h1><?php // Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
