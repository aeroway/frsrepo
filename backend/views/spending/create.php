<?php

use yii\helpers\Html;


/* @var $this yii\web\View */
/* @var $model backend\models\Spending */

$this->title = 'Создать смету';
$this->params['breadcrumbs'][] = ['label' => 'Смета', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="spending-create">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
