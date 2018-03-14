<?php

use yii\helpers\Html;
use yii\widgets\DetailView;

/* @var $this yii\web\View */
/* @var $model backend\models\Planstages */

$this->params['breadcrumbs'][] = ['label' => 'Вид обращения', 'url' => ['planview/index']];
$this->params['breadcrumbs'][] = ['label' => 'Задания', 'url' => ['plantask/index', 'id' => !empty($_GET['pid']) ? $_GET['pid'] : '',]];
$this->title = $model->name;
$this->params['breadcrumbs'][] = ['label' => 'Этапы', 'url' => ['index', 'id' => $model->ptask_id, 'pid' => !empty($_GET['pid']) ? $_GET['pid'] : '',],];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="planstages-view">

    <h1><?= Html::encode($this->title) ?></h1>

    <p>
        <?= Html::a('Редактировать', ['update', 'id' => $model->id, 'pid' => !empty($_GET['pid']) ? $_GET['pid'] : '',], ['class' => 'btn btn-primary']) ?>
        <?php /* Html::a('Удалить', ['delete', 'id' => $model->id], [
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
            'executor',
            [
                'attribute' => 'textNote',
                'label' => 'Замечания',
                'format' => 'html',
            ],
            [
                'attribute' => 'plannotesAction',
                'label' => 'Действие',
                'format' => 'html',
            ],
            //'ptask_id',
        ],
    ]) ?>

</div>
