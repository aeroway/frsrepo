<?php

use yii\helpers\Html;

/** @var yii\web\View $this */
/** @var backend\models\ForeignersAgro $model */

$this->title = 'Добавить';
$this->params['breadcrumbs'][] = ['label' => 'Иностранцы с/х', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="foreigners-agro-create">

    <h1><?php // echo Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
