<?php

use yii\helpers\Html;

/* @var $this yii\web\View */
/* @var $model backend\models\Planstages */

$this->params['breadcrumbs'][] = ['label' => 'Вид обращения', 'url' => ['planview/index']];
$this->params['breadcrumbs'][] = ['label' => 'Задания', 'url' => ['plantask/index', 'id' => !empty($_GET['pid']) ? $_GET['pid'] : '']];
$this->title = 'Редактировать: ' . $model->id;
$this->params['breadcrumbs'][] = ['label' => 'Этапы', 'url' => ['index', 'id' => $model->ptask_id, 'pid' => !empty($_GET['pid']) ? $_GET['pid'] : '']];
$this->params['breadcrumbs'][] = ['label' => $model->name, 'url' => ['view', 'id' => $model->id, 'pid' => !empty($_GET['pid']) ? $_GET['pid'] : '']];
$this->params['breadcrumbs'][] = 'Редактировать';
?>
<div class="planstages-update">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
        'modelsPlannotes' => $modelsPlannotes,
    ]) ?>

</div>
