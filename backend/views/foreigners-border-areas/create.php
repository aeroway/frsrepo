<?php

use yii\helpers\Html;

/** @var yii\web\View $this */
/** @var backend\models\ForeignersBorderAreas $model */

$this->title = 'Добавить';
$this->params['breadcrumbs'][] = ['label' => 'Иностранцы приграничные территории', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="foreigners-border-areas-create">

    <h1><?php // echo Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
