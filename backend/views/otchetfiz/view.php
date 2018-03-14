<?php

use yii\helpers\Html;
use yii\widgets\DetailView;

/* @var $this yii\web\View */
/* @var $model backend\models\Otchetfiz */

$this->title = $model->name;
$this->params['breadcrumbs'][] = ['label' => 'Администрирование доходов физ. лица', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="otchetfiz-view">

    <h1><?= Html::encode($this->title) ?></h1>

    <p>
        <?= Html::a('Редактировать', ['update', 'id' => $model->id], ['class' => 'btn btn-primary']) ?>
        <?php /* echo Html::a('Delete', ['Удалить', 'id' => $model->id], [
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
            'birth_date',
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
