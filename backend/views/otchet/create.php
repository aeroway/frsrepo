<?php

use yii\helpers\Html;


/* @var $this yii\web\View */
/* @var $model backend\models\Otchet */

$this->title = 'Создать Отчёт';
$this->params['breadcrumbs'][] = ['label' => 'Отчёт', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="otchet-create">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
