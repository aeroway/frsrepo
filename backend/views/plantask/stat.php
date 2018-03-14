<?php

use yii\helpers\Html;
use backend\models\Plantask;

$this->params['breadcrumbs'][] = ['label' => 'Вид обращения', 'url' => ['planview/index']];
$this->title = 'Статистика заданий по районам (все обращения)';
$this->params['breadcrumbs'][] = ['label' => 'Задания', 'url' => ['index', 'id' => !empty($_GET['sid']) ? $_GET['sid'] : '',],];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="plantask-stat-view">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= Plantask::getEmployeeDepartmentCount() ?>

</div>
