<?php

use yii\helpers\Html;
use yii\helpers\Url;
use kartik\grid\ActionColumn;
use kartik\grid\GridView;
use yii\helpers\ArrayHelper;
use kartik\export\ExportMenu;
use backend\models\Otchetfns;

/* @var $this yii\web\View */
/* @var $searchModel backend\models\OtchetfnsSearch */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = 'Перечни без правообладателя';
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="otchetfns-index">

    <h1><?= Html::encode($this->title) ?></h1>

    <p>
        <?php // echo Html::a('Добавить', ['create'], ['class' => 'btn btn-success']) ?>
        <?= Html::a('Сброс фильтров', ['reset'], ['class' => 'btn btn-warning', 'title' => 'Сброс фильтров']); ?>
        <?= Html::a('Статистика', ['stat-fns'], ['class' => 'btn btn-info', 'title' => 'Статистика']); ?>
    </p>

    <?php
        $gridColumns = [
            'area',
            'type_obj',
            'kn',
            'address',
            // 'category',
            // 'permit_use',
            // 'square',
            'info_tax',
            'info_gfd',
            'status',
            'comment',
            [
                'attribute' => 'flag',
                'value' => function ($model) {
                    if ($model->flag == 0) {
                        return 'Да';
                    } else {
                        return 'Нет';
                    }
                },
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
            'filename' => 'exported-data_' . date('Y-m-d_H-i-s'),
        ]);
    ?>

    <?php // echo $this->render('_search', ['model' => $searchModel]); ?>

    <?= GridView::widget([
        'dataProvider' => $dataProvider,
        'filterModel' => $searchModel,
        // 'rowOptions' => function($model) { if ($model->flag == 0) return ['class'=>'success']; },
        'columns' => [
            ['class' => 'yii\grid\SerialColumn'],

            // 'id',
            [
                'attribute' => 'area',
                'value' => 'area',
                // 'filter' => Html::activeDropDownList($searchModel, 'area', ArrayHelper::map(Otchetfns::find()->asArray()->where(['IS NOT', 'area', NULL])->orderBy(['area' => SORT_ASC])->all(), 'area', 'area'), ['class'=>'form-control', 'prompt' => '']),
            ],
            'type_obj',
            'kn',
            'address',
            'category',
            'permit_use',
            'square',
            // 'date_reg',
            [
                'attribute' => 'info_tax',
                'value' => 'info_tax',
                'filter' => Html::activeDropDownList($searchModel, 'info_tax', ["Да" => "Да", "Нет" => "Нет"], ['class'=>'form-control','prompt' => '']),
            ],
            [
                'attribute' => 'info_gfd',
                'value' => 'info_gfd',
                'filter' => Html::activeDropDownList($searchModel, 'info_gfd', ["Да" => "Да", "Нет" => "Нет"], ['class'=>'form-control','prompt' => '']),
            ],
            [
                'attribute' => 'status',
                'value' => 'status',
                'filter' => Html::activeDropDownList($searchModel, 'status', ["Взят в работу (ОМС)" => "Взят в работу (ОМС)", "Снят с учёта" => "Снят с учёта", "Выявлен правообладатель (внесено в ЕГРН)" => "Выявлен правообладатель (внесено в ЕГРН)", "Зарегистрировано право" => "Зарегистрировано право", "Не подлежит выявлению" => "Не подлежит выявлению"], ['class'=>'form-control','prompt' => '']),
            ],
            // 'in_process',
            // 'remove_reg',
            // 'identified',
            'comment',
            [
                'attribute' => 'flag',
                'value' => function ($model) {
                    if ($model->flag == 0) {
                        return 'Да';
                    } else {
                        return 'Нет';
                    }
                },
                'filter' => Html::activeDropDownList($searchModel, 'flag', [0 => 'Да', 2 => 'Нет'], ['class'=>'form-control','prompt' => '']),
            ],
            //'date',
            //'username',
            //'filename',
            //'date_update',
            //'date_load',
            [
                'class' => ActionColumn::className(),
                'urlCreator' => function ($action, \backend\models\Otchetfns $model, $key, $index, $column) {
                    return Url::toRoute([$action, 'id' => $model->id]);
                },
                'template' => '{view} {update}',
            ],
        ],
    ]); ?>


</div>
