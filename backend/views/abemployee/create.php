<?php

use yii\helpers\Html;


/* @var $this yii\web\View */
/* @var $model backend\models\AbEmployee */

$this->title = 'Добавить блокировку';
$this->params['breadcrumbs'][] = ['label' => 'Блокировка', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="ab-employee-create">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
