<?php

use backend\models\Otcheterlmfc;
use yii\helpers\Html;
use yii\helpers\Url;
use kartik\grid\ActionColumn;
use kartik\export\ExportMenu;
use kartik\grid\GridView;
use yii\helpers\ArrayHelper;
use backend\models\AreaOtchet;

/** @var yii\web\View $this */
/** @var backend\models\OtcheterlmfcSearch $searchModel */
/** @var yii\data\ActiveDataProvider $dataProvider */

$this->title = 'Ошибки МФЦ';
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="otcheterlmfc-index">

    <h1><?php // echo Html::encode($this->title) ?></h1>

    <p>
        <?= Html::a('Добавить', ['create'], ['class' => 'btn btn-success']) ?>
    </p>

    <?php // echo $this->render('_search', ['model' => $searchModel]); ?>

    <?php
        $gridColumns = [
            'area.name',
            'ref_num',
            'application_date:date',
            'address',
            'fio_mfc',
            'description',
            'username'
        ];

        echo ExportMenu::widget([
            'dataProvider' => $dataProvider,
            'columns' => $gridColumns,
            'target' => ExportMenu::TARGET_SELF,
            'showConfirmAlert' => false,
            'showColumnSelector' => true,
            // 'exportConfig' => [
            //     ExportMenu::FORMAT_HTML => false,
            //     ExportMenu::FORMAT_TEXT => false,
            //     ExportMenu::FORMAT_PDF => false,
            // ],
            'filename' => 'exported-data_' . date('Y-m-d_H-i-s'),
        ]);
    ?>

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
            'ref_num',
            'application_date:date',
            'address',
            'fio_mfc',
            'description',
            'username',
            // 'date_create',
            [
                'class' => ActionColumn::className(),
                'urlCreator' => function ($action, Otcheterlmfc $model, $key, $index, $column) {
                    return Url::toRoute([$action, 'id' => $model->id]);
                 }
            ],
        ],
    ]); ?>


</div>
