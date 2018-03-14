<?php

use yii\helpers\Html;
use yii\widgets\DetailView;
use backend\models\Otchetur;

/* @var $this yii\web\View */
/* @var $model backend\models\Otchetur */

$this->title = $model->name;
$this->params['breadcrumbs'][] = ['label' => 'Администрирование доходов', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;

$otchetur = new Otchetur();
Yii::$app->session->setFlash('table', Otchetur::$name);
?>
<div class="otchetur-view">

    <h1><?= Html::encode($this->title) ?></h1>

    <p>
        <?= Html::a('Редактировать', ['update', 'id' => $model->id, 'table' => Otchetur::$name], ['class' => 'btn btn-primary']) ?>
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
            'number_book',
            'full_name',
            'inn',
            'name',
            'kn',
            'adr_txt',
            'name1',
            'name2',
            'name3',
            'fl',
            'status',
            'comment',
            [
                'attribute' => 'date',
                'format' =>  ['date', 'php:d M Y'],
            ],
            'username',
            'flag',
            'filename',
            [
                'attribute' => 'date_update',
                'format' =>  ['date', 'php:d M Y'],
            ],
            [
                'attribute' => 'date_load',
                'format' =>  ['date', 'php:d M Y'],
            ],
            'cost',
        ],
    ]) ?>

</div>
