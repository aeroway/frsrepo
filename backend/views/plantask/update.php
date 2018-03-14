<?php

use yii\helpers\Html;

/* @var $this yii\web\View */
/* @var $model backend\models\Plantask */

$this->params['breadcrumbs'][] = ['label' => 'Вид обращения', 'url' => ['planview/index']];
$this->title = 'Редактировать: ' . $model->id;;
$this->params['breadcrumbs'][] = ['label' => 'Задания', 'url' => ['index', 'id' => $model->pview_id, 'pid' => !empty($_GET['pid']) ? $_GET['pid'] : '']];
$this->params['breadcrumbs'][] = ['label' => $model->name, 'url' => ['view', 'id' => $model->id]];
$this->params['breadcrumbs'][] = 'Редактировать';
?>
<div class="plantask-update">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
