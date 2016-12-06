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
            //'description_list:html',
            [
                'attribute' => 'description_list',
                'value' => function($data) {
                    $arr_tab = array('otchet3', 'otchetn', 'otchet9', 'otchet7', 'otchet14', 'otchet17');

                    if(in_array($data->table_list, $arr_tab))
                    {
                        if($data->table_list == 'otchet9')
                        {
                            return $data->description_list . $data->getAltArea($data->table_list, 'kn');
                        }
                        else
                        {
                            return $data->description_list . $data->getAltArea($data->table_list, 'area');
                        }
                    }
                    else
                    {
                        return $data->description_list . $data->getArea($data->table_list);
                    }
                },
                'format' => 'html',
            ],
            [
                'attribute' => 'statistic_list',
                'value' => function($data) {
                    return $data->getStatusOtchetlist($data->table_list);
                },
                'format' => 'html',
                'contentOptions' => ['style'=>'width: 250px;'],
                
            ],
        ],
    ]); ?>
</div>
