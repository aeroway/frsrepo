<?php

use yii\helpers\Html;
use yii\helpers\Url;
use yii\grid\ActionColumn;
use yii\grid\GridView;
use backend\models\SgrRegulations;

/* @var $this yii\web\View */
/* @var $searchModel backend\models\SgrRegulationsSearch */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = 'Регламент Совета';
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="sgr-regulations-index">

    <h1><?= Html::encode($this->title) ?></h1>

    <p>
        <?= Html::a('Добавить', ['create'], ['class' => 'btn btn-success']) ?>
        <?= Html::a('Заседания', ['sgr-meeting/index'], ['class' => 'btn btn-warning']) ?>
        <?= Html::a('Состав совета', ['sgr-members/index'], ['class' => 'btn btn-warning']) ?>
    </p>

    <?php // echo $this->render('_search', ['model' => $searchModel]); ?>

    <?= GridView::widget([
        'dataProvider' => $dataProvider,
        'filterModel' => $searchModel,
        'columns' => [
            ['class' => 'yii\grid\SerialColumn'],

            // 'id',
            [
                'attribute' => 'name_doc',
                'value' => 'NameDoc',
                'format' => 'html',
            ],
            [
                'class' => ActionColumn::className(),
                'urlCreator' => function ($action, SgrRegulations $model, $key, $index, $column) {
                    return Url::toRoute([$action, 'id' => $model->id]);
                 }
            ],
        ],
    ]); ?>


</div>
