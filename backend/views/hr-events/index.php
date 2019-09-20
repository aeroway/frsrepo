<?php

use yii\helpers\Html;
use yii\grid\GridView;

/* @var $this yii\web\View */
/* @var $searchModel backend\models\HrEventsSearch */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = 'Hr Events';
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="hr-events-index">

    <h1><?= Html::encode($this->title) ?></h1>

    <p>
        <?= Html::a('Create Hr Events', ['create'], ['class' => 'btn btn-success']) ?>
    </p>

    <?php // echo $this->render('_search', ['model' => $searchModel]); ?>

    <?= GridView::widget([
        'dataProvider' => $dataProvider,
        'filterModel' => $searchModel,
        'columns' => [
            ['class' => 'yii\grid\SerialColumn'],

            'id',
            'event_date',
            'event_type',
            'event_subject',
            'event_member',
            //'event_comment',

            ['class' => 'yii\grid\ActionColumn'],
        ],
    ]); ?>


</div>
