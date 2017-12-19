<?php

use yii\helpers\Html;
use yii\grid\GridView;

/* @var $this yii\web\View */
/* @var $searchModel backend\models\OtchetPaySearch */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = 'Ошибка в платежах';
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="otchet-pay-index">

    <h1><?= Html::encode($this->title) ?></h1>
    <?php // echo $this->render('_search', ['model' => $searchModel]); ?>

    <p>
        <?php 
            //Html::a('Create Otchet Pay', ['create'], ['class' => 'btn btn-success']) 
        ?>
    </p>
    <?= GridView::widget([
        'dataProvider' => $dataProvider,
        'filterModel' => $searchModel,
        'columns' => [
            ['class' => 'yii\grid\SerialColumn'],

            //'id',
            'number',
            'payer_name',
            'sum',
            'payer_id',
            [
                'attribute' => 'payer_date',
                'format' =>  ['date', 'php:d M Y'],
                'contentOptions' => ['style'=>'width: 120px; text-align: center;'],
            ],
            'note',
            // 'date_load',
            'status',

            //['class' => 'yii\grid\ActionColumn'],
            [
                'class' => 'yii\grid\ActionColumn',
                'buttons'=>
                [
                    'view'=>function ($url, $model) 
                    {
                        $customurl=Yii::$app->getUrlManager()->createUrl(['otchet-pay/view', 'id'=>$model['id']]);

                        return Html::a('<span class="glyphicon glyphicon-eye-open"></span>', $customurl);
                    },
                    'update'=>function ($url, $model) 
                    {
                        $customurl=Yii::$app->getUrlManager()->createUrl(['otchet-pay/update', 'id'=>$model['id']]);

                        return Html::a('<span class="glyphicon glyphicon-pencil"></span>', $customurl);
                    }
                ],
                'template' => '{view} {update}',
            ],
        ],
    ]); ?>
</div>
