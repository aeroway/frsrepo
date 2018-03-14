<?php

use yii\helpers\Html;
use yii\widgets\DetailView;

/* @var $this yii\web\View */
/* @var $model backend\models\Plantask */

$this->params['breadcrumbs'][] = ['label' => 'Вид обращения', 'url' => ['planview/index']];
$this->title = $model->name;
$this->params['breadcrumbs'][] = ['label' => 'Задания', 'url' => ['index', 'id' => $model->pview_id, 'pid' => !empty($_GET['pid']) ? $_GET['pid'] : '',],];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="plantask-view">

    <h1><?= Html::encode($this->title) ?></h1>

    <p>
        <?= Html::a('Редактировать', ['update', 'id' => $model->id], ['class' => 'btn btn-primary']) ?>
        <?php /* echo Html::a('Удалить', ['delete', 'id' => $model->id], [
            'class' => 'btn btn-danger',
            'data' => [
                'confirm' => 'Are you sure you want to delete this item?',
                'method' => 'post',
            ],
        ]) */ ?>
    </p>

    <?= DetailView::widget([
        'model' => $model,
        'attributes' => [
            //'id',
            'name',
            'username',
            [
                'attribute' => 'date_task',
                'format' =>  ['date', 'php:d M Y'],
            ],
            //'pview_id',
            [
                'attribute' => 'planviewName',
                'label' => 'Вид обращения',
            ],
        ],
    ]) ?>

</div>
