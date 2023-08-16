<?php

use yii\helpers\Html;


/* @var $this yii\web\View */
/* @var $model backend\models\Otchetpriost */

$this->title = 'Добавить запись';
$this->params['breadcrumbs'][] = ['label' => 'Отчёты', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="otchetpriost-create">

    <h1><?php // echo Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
