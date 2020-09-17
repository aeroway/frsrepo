<?php

use yii\helpers\Html;
use yii\grid\GridView;

/* @var $this yii\web\View */
/* @var $searchModel backend\models\DocSrchReqSearch */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = 'Запрос на поиск документов для передачи в МФЦ';
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="doc-srch-req-index">

    <h1><?= Html::encode($this->title) ?></h1>

    <p>
        <?= Html::a('Создать запрос', ['create'], ['class' => 'btn btn-success']) ?>
    </p>

    <?php // echo $this->render('_search', ['model' => $searchModel]); ?>

    <?= GridView::widget([
        'dataProvider' => $dataProvider,
        'filterModel' => $searchModel,
        'columns' => [
            ['class' => 'yii\grid\SerialColumn'],

            // 'id',
            'full_name',
            'email:email',
            'req_num',
            [
                'attribute' => 'subdivision_id',
                'value' => 'subdivision.name',
            ],
            'date_update',
            'username',
            // 'answer',

            ['class' => 'yii\grid\ActionColumn'],
        ],
    ]); ?>


</div>
