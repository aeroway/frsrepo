<?php

use yii\helpers\Html;


/* @var $this yii\web\View */
/* @var $model backend\models\AbSystems */

$this->title = 'Добавить Систему';
$this->params['breadcrumbs'][] = ['label' => 'Блокировка', 'url' => ['abemployee/index']];
$this->params['breadcrumbs'][] = ['label' => 'Системы', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="ab-systems-create">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
