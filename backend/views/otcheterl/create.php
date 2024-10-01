<?php

use yii\helpers\Html;

/** @var yii\web\View $this */
/** @var backend\models\Otcheterl $model */

$this->title = 'Добавить';
$this->params['breadcrumbs'][] = ['label' => 'Журнал запросов', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="otcheterl-create">

    <h1><?php // echo Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
