<?php

use backend\models\Otcheterl;
use yii\helpers\Html;
use yii\helpers\Url;
use yii\grid\ActionColumn;
use kartik\export\ExportMenu;
use kartik\grid\GridView;
use yii\helpers\ArrayHelper;
use backend\models\AreaOtchet;

/** @var yii\web\View $this */
/** @var backend\models\OtcheterlSearch $searchModel */
/** @var yii\data\ActiveDataProvider $dataProvider */

$this->title = 'Журнал запросов';
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="otcheterl-index">

    <h1><?php // echo Html::encode($this->title) ?></h1>

    <p>
        <?= Html::a('Добавить', ['create'], ['class' => 'btn btn-success']) ?>
    </p>

    <?php // echo $this->render('_search', ['model' => $searchModel]); ?>

    <?php
        $gridColumns = [
            'area.name',
            'kuvd',
            'application_date',
            'kn',
            'coordinates',
            'address',
            'fio_reg',
            'draft_number',
            'draft_date:date',
            'outgoing_number',
            'outgoing_date:date'
        ];

        echo ExportMenu::widget([
            'dataProvider' => $dataProvider,
            'columns' => $gridColumns,
            // 'target' => ExportMenu::TARGET_SELF,
            // 'showConfirmAlert' => false,
            // 'showColumnSelector' => false,
            'exportConfig' => [
                ExportMenu::FORMAT_HTML => false,
                ExportMenu::FORMAT_TEXT => false,
                ExportMenu::FORMAT_PDF => false,
            ],
            'filename' => 'exported-data_' . date('Y-m-d_H-i-s'),
        ]);
    ?>

    <?= GridView::widget([
        'dataProvider' => $dataProvider,
        'filterModel' => $searchModel,
        'columns' => [
            ['class' => 'yii\grid\SerialColumn'],

            // 'id',
            [
                'attribute' => 'area_id',
                'value' => 'area.name',
                'filter' => Html::activeDropDownList($searchModel, 'area_id', ArrayHelper::map(AreaOtchet::find()->asArray()->where(['IS NOT', 'name_2', NULL])->orderBy(['name_2' => SORT_ASC])->all(), 'name', 'name'), ['class'=>'form-control','prompt' => '']),
            ],
            'kuvd',
            [
                'attribute' => 'application_date',
                'format' =>  ['date', 'php:d.m.Y'],
            ],
            'kn',
            [
                'attribute' => 'coordinates',
                'value' => 'coordinates',
                'format' => 'html',
            ],
            'address',
            'fio_reg',
            'draft_number',
            [
                'attribute' => 'draft_date',
                'format' =>  ['date', 'php:d.m.Y'],
            ],
            'outgoing_number',
            [
                'attribute' => 'outgoing_date',
                'format' =>  ['date', 'php:d.m.Y'],
            ],
            [
                'attribute' => 'send',
                'value' => 'SendStatus',
                'format' => 'html',
                'filter' => Html::activeDropDownList($searchModel, 'send', [0 => 'Нет', 1 => 'Да'], ['class'=>'form-control', 'prompt' => '']),
                'contentOptions'=>['style' => 'text-align: center;'],
            ],
            [
                'class' => ActionColumn::className(),
                'buttons' =>
                [
                    'createpdferl' => function ($url, $model, $key) {
                            return Html::a('<span class="glyphicon glyphicon-file"></span>', $url,
                                [
                                    'title' => Yii::t('yii', 'Сформировать PDF'),
                                    'aria-label' => Yii::t('yii', 'Сформировать PDF'),
                                    'target' => '_blank',
                                ],
                            );
                    },
                    'sendmail' => function ($url, $model, $key) {
                        return Html::a('<span class="glyphicon glyphicon-envelope"></span>', $url,
                            [
                                'title' => Yii::t('yii', 'Отправить письмо'),
                                'aria-label' => Yii::t('yii', 'Отправить письмо'),
                                'target' => '_blank',
                                'data-confirm' => "Вы уверены, что хотите отправить это письмо?"
                            ],
                        );
                },
                ],
                'urlCreator' => function ($action, Otcheterl $model, $key, $index, $column) {
                    return Url::toRoute([$action, 'id' => $model->id]);
                },
                'template' => '{view} {delete} {update} {createpdferl}',
            ],
        ],
    ]); ?>


</div>
