<?php

use yii\helpers\Html;
use yii\helpers\Url;
use yii\grid\ActionColumn;
use kartik\grid\GridView;
use kartik\export\ExportMenu;

/* @var $this yii\web\View */
/* @var $searchModel backend\models\XmlAnalysisSearch */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = 'ГИС ЖКХ';
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="xml-analysis-index">

    <h1><?php // echo Html::encode($this->title) ?></h1>

    <p>
        <?php // echo Html::a('Create Xml Analysis', ['create'], ['class' => 'btn btn-success']) ?>
    </p>

    <?= $this->render('_search', ['model' => $searchModel]); ?>

    <?php
        $gridColumns = [
            'kn',
            'address',
            'filename',
            [
                'attribute' => 'filenameDate',
                'label' => 'Дата',
                'format' => 'html',
                'value' => 'filenameDate',
            ],
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
    ]); ?>

    <?= GridView::widget([
        'dataProvider' => $dataProvider,
        'filterModel' => $searchModel,
        'columns' => [
            ['class' => 'kartik\grid\SerialColumn'],

            'kn',
            'address',
            'filename',
            [
                'attribute' => 'filenameDate',
                'label' => 'Дата',
                'format' => 'html',
                'value' => 'filenameDate',
                'contentOptions' => ['style'=>'width: 200px;'],
            ],
            // 'id',
            // [
            //     'class' => ActionColumn::className(),
            //     'urlCreator' => function ($action, XmlAnalysis $model, $key, $index, $column) {
            //         return Url::toRoute([$action, 'id' => $model->id]);
            //      }
            // ],
        ],
    ]); ?>


</div>
