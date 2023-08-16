<?php

use yii\helpers\Html;
use kartik\grid\GridView;
use kartik\export\ExportMenu;
use yii\helpers\ArrayHelper;
use backend\models\Employee;
use backend\models\Otchetpriost;
use backend\models\SuspensionArticles;
use backend\models\OtchetpriostSuspension;
use backend\models\OtchetpriostMarks;
use backend\models\AreaOtchet;

/* @var $this yii\web\View */
/* @var $searchModel backend\models\OtchetpriostSearch */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = 'Отчёты';
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="otchetpriost-index">

    <h1><?= Html::encode($this->title) ?></h1>
    <?php // echo $this->render('_search', ['model' => $searchModel]); ?>

    <p><?= Html::a('Создать', ['create'], ['class' => 'btn btn-success']) ?></p>

    <p> </p>
    <?php
        $gridColumns = [
            'area.name',
            'kuvd',
            'date_suspend',
            'urd',
            'mark.name',
            'fio_sro',
            'suspensionAsString',
            'description',
            'offer',
            // 'comment',
            'executor',
            'username',
            // 'protocol',
            // 'date',
        ];
    ?>
    <?= ExportMenu::widget([
            'dataProvider' => $dataProvider,
            'columns' => $gridColumns,
            'exportConfig' => [
                ExportMenu::FORMAT_HTML => false,
                ExportMenu::FORMAT_TEXT => false,
                ExportMenu::FORMAT_PDF => false,
            ],
            'filename' => 'exported-data_' . date('Y-m-d_H-i-s'),
        ]);
    ?>
    <p> </p>

    <?= GridView::widget([
        'dataProvider' => $dataProvider,
        'filterModel' => $searchModel,
        'columns' => [
            ['class' => 'yii\grid\SerialColumn'],
            [
                'attribute' => 'area_id',
                'value' => 'area.name',
                'filter' => Html::activeDropDownList($searchModel, 'area_id', ArrayHelper::map(AreaOtchet::find()->asArray()->where(['IS NOT', 'name_2', NULL])->orderBy(['name_2' => SORT_ASC])->all(), 'name', 'name'), ['class'=>'form-control','prompt' => '']),
            ],
            'kuvd',
            [
                'attribute' => 'date_suspend',
                'format' =>  ['date', 'php:d.m.Y'],
            ],
            'urd',
            [
                'attribute' => 'mark_id',
                'value' => 'mark.name',
            ],
            'fio_sro',
            [
                'attribute' => 'suspensionId',
                'value' => 'suspensionAsString',
                'format' => 'html'
            ],
            [
                'attribute' => 'description',
                'contentOptions' => ['title'=>'Количество объектов недвижимости с разбивкой по причинам'],
            ],
            [
                'attribute' => 'offer',
                'contentOptions' => ['title'=>'Предложения по выходу из ситуации (по каждому блоку причин)'],
            ],
            // 'comment',
            // [
            //     'attribute' => 'date',
            //     'format' =>  ['date', 'php:d M Y'],
            //     'contentOptions' => ['style' => 'text-align: center;'],
            // ],
            'executor',
            // 'username',
            [
                'class' => 'yii\grid\ActionColumn',
                'template' => '{view} {update} {delete}',
            ],
        ],
    ]); ?>
    <?= Html::endForm();?> 

</div>
