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
        <?= Html::a('Инструкции', '/docs/instructions.zip', ['class' => 'btn btn-success']); ?>
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
        'layout' => "{summary}\n{pager}\n{items}\n{pager}",
        'columns' => [
            ['class' => 'yii\grid\SerialColumn'],

            //'id',
            [
                'attribute' => 'name_list',
                'value' => function($data) {
                    if($data->table_list == 'otchetn')
                        return "<a href='/index.php?r=otchetn/index'>$data->name_list</a>";
                    elseif($data->table_list == 'otchet_pay')
                        return "<a href='/index.php?r=otchet-pay/index'>$data->name_list</a>";
                    elseif($data->table_list == 'otchetur' || $data->table_list == 'otchet999')
                        return "<a href='/index.php?r=otchetur/index&table=$data->table_list'>$data->name_list</a>";
                    elseif($data->table_list == 'otchetfiz')
                        return "<a href='/index.php?r=otchetfiz/index'>$data->name_list</a>";
                    else
                        return "<a href='/index.php?r=otchett/index&table=$data->table_list'>$data->name_list</a>";

                    return '';
                },
                'format' => 'html',
                'contentOptions' => ['style'=>'width: 18%;'],
            ],
            //'table_list',
            //'status_list',
            [
                'attribute' => 'description_list',
                'format' => 'html',
                'contentOptions' => ['style'=>'width: 60%;'],
            ],
            [
                'attribute' => 'statistic_list',
                'value' => function($data) {
                    return $data->getStatusOtchetlist($data->table_list);
                },
                'format' => 'html',
                'contentOptions' => ['style'=>'width: 17%;'],
            ],

            //['class' => 'yii\grid\ActionColumn'],
            $button,
        ],
    ]); ?>
</div>
