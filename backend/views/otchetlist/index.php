<?php

use yii\helpers\Html;
use yii\grid\GridView;

/* @var $this yii\web\View */
/* @var $searchModel backend\models\OtchetlistSearch */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = 'Отчёты';
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="otchetlist-index">

    <h1><?= Html::encode($this->title) ?></h1>
    <?php // echo $this->render('_search', ['model' => $searchModel]); ?>

    <p>
        <?php
        if(in_array("ИТО", Yii::$app->user->identity->groups))
        {
            echo Html::a('Создать отчёт', ['create'], ['class' => 'btn btn-success']);
        }
        ?>
        <?= Html::a('Инструкции', '/backend/docs/instructions.zip', ['class' => 'btn btn-success']); ?>
    </p>

    <?php
    if(in_array("ИТО", Yii::$app->user->identity->groups))
    {
        $button =
        [
            'class' => 'yii\grid\ActionColumn',
            'template'=>'{view} {update}',
        ];
    } else 
    {
        $button =
        [
            'class' => 'yii\grid\ActionColumn',
            'template'=>'{view}',
        ];
    }
    ?>

    <?= GridView::widget([
        'dataProvider' => $dataProvider,
        'filterModel' => $searchModel,
        'columns' => [
            ['class' => 'yii\grid\SerialColumn'],

            //'id',
            [
                'attribute' => 'name_list',
                'value' => function($data) {
                    if($data->table_list == 'otchetn')
                        return "<a href='/backend/index.php?r=otchetn/index'>$data->name_list</a>";
                    else
                        return "<a href='/backend/index.php?r=otchett/index&table=$data->table_list'>$data->name_list</a>";

                    return '';
                },
                'format' => 'html',
            ],
            //'table_list',
            //'status_list',
            'description_list:html',
            [
                'attribute' => 'statistic_list',
                'value' => function($data) {
                    return $data->getStatusOtchetlist($data->table_list);
                },
                'format' => 'html',
                'contentOptions' => ['style'=>'width: 250px;'],
            ],
            

            //['class' => 'yii\grid\ActionColumn'],
            $button,
        ],
    ]); ?>
</div>
