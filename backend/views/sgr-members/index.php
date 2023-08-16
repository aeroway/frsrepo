<?php

use yii\helpers\Html;
use yii\helpers\Url;
use yii\grid\ActionColumn;
use yii\grid\GridView;

/* @var $this yii\web\View */
/* @var $searchModel backend\models\SgrMembersSearch */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = 'Состав Совета';
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="sgr-members-index">

    <h1><?= Html::encode($this->title) ?></h1>

    <p>
        <?= Html::a('Добавить', ['create'], ['class' => 'btn btn-success']) ?>
        <?= Html::a('Председатели', ['index', 'pr' => 0], ['class' => 'btn btn-info', 'title' => 'Председатели']); ?>
        <?= Html::a('Рабочая группа', ['index', 'pr' => 1], ['class' => 'btn btn-info', 'title' => 'Рабочая группа']); ?>
        <?= Html::a('Члены Совета', ['index', 'pr' => 2], ['class' => 'btn btn-info', 'title' => 'Члены совета']); ?>
        <?= Html::a('Общий список', ['index', 'pr' => 3], ['class' => 'btn btn-info', 'title' => 'Общий список']); ?>
        <?= Html::a('Заседания', ['sgr-meeting/index'], ['class' => 'btn btn-warning']) ?>
        <?= Html::a('Регламент Совета', ['sgr-regulations/index'], ['class' => 'btn btn-warning']) ?>
    </p>

    <?php // echo $this->render('_search', ['model' => $searchModel]); ?>

    <?= GridView::widget([
        'dataProvider' => $dataProvider,
        'filterModel' => $searchModel,
        'columns' => [
            ['class' => 'yii\grid\SerialColumn'],

            // 'id',
            'fio',
            'position',
            // 'contact',
            'status',
            // 'photo',

            [
                'class' => ActionColumn::className(),
                'urlCreator' => function ($action, \backend\models\SgrMembers $model, $key, $index, $column) {
                    return Url::toRoute([$action, 'id' => $model->id]);
                },
                // 'template' => '{view} {update}',
            ],
        ],
    ]); ?>


</div>
