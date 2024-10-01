<?php

use backend\models\GenTeamMembers;
use yii\helpers\Html;
use yii\helpers\Url;
use yii\grid\ActionColumn;
use kartik\grid\GridView;
use diecoding\barcode\generator\Barcode;
use yii\helpers\ArrayHelper;
use kartik\export\ExportMenu;

/** @var yii\web\View $this */
/** @var backend\models\GenTeamMembersSearch $searchModel */
/** @var yii\data\ActiveDataProvider $dataProvider */

$this->title = 'Участники';
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="gen-team-members-index">

    <h1><?php // echo Html::encode($this->title) ?></h1>

    <p>
        <?= Html::a('Добавить', ['create'], ['class' => 'btn btn-success']) ?>
        <?= Html::a('Распределить', ['create-team'], ['class' => 'btn btn-success']) ?>
        <?= Html::a('Сброс', ['index'], ['class' => 'btn btn-info', 'title' => 'Сброс']); ?>
    </p>

    <?php // echo $this->render('_search', ['model' => $searchModel]); ?>

    <div id="successCheckGenTeamBarcode" style="display: <?= Yii::$app->session->getFlash('successCheckGenTeamBarcode'); ?>;">
        <?php if ($model->getStatusBarcode() !== NULL) : ?>
            <?= ($model->getStatusBarcode() > 0) ? '<div class="alert alert-success">Подтвержена запись</div>' : '<div class="alert alert-danger">Запись отсутствует</div>' ?>
        <?php endif; ?>
    </div>

    <?= $this->render('_formGenTeamBarcode', [
        'model' => $model,
    ]) ?>

    <?php
    $gridColumns = [
        // [
        //     'attribute' => 'team',
        //     'value'=>function ($model) {
        //         return empty($model->team) ? '_' : $model->team;
        //     },
        //     'options' => [
        //         'style' => "width: 1cm; text-align: center;",
        //     ],
        //     'group' => true,
        // ],
        'team',
        'full_name',
        'position',
        [
            'attribute' => 'agency_id',
            'value' => 'AgencyName',
        ],
    ];

    echo ExportMenu::widget([
        'dataProvider' => $dataProvider,
        'columns' => $gridColumns,
        'exportConfig' => [
            ExportMenu::FORMAT_HTML => false,
            ExportMenu::FORMAT_TEXT => false,
            ExportMenu::FORMAT_PDF => false,
        ],
    ]);
    ?>

    <?= GridView::widget([
        'dataProvider' => $dataProvider,
        'filterModel' => $searchModel,
        'columns' => [
            [
                'class' => 'yii\grid\SerialColumn',
                'contentOptions' => function ($model) {
                    if ($model->flag == 1) {
                        return ['style' => 'background-color: green;'];
                    } else {
                        return ['style' => ''];
                    }
                }
            ],

            // 'id',
            [
                'attribute' => 'team',
                'value'=>function ($model) {
                    return empty($model->team) ? '_' : $model->team;
                },
                'options' => [
                    'style' => "width: 1cm; text-align: center;",
                ],
                'group' => true,
            ],
            'full_name',
            'position',
            [
                'attribute' => 'agency_id',
                'value' => 'AgencyName',
                'filter' => Html::activeDropDownList($searchModel, 'agency_id', ['' => '', '1' => 'УРР', '2' => 'ПКК', '3' => 'РБ'], ['class' => 'form-control']),
                // 'filter' => Html::activeDropDownList($searchModel, 'agency_id', ArrayHelper::map(GenTeamMembers::find()->asArray()->all(), 'agency_id', 'agency_id'), ['class' => 'form-control', 'prompt' => 'Все статусы']),
            ],
            [
                'attribute' => 'guidBarcode',
                'value' => function ($model) {
                    return Barcode::widget([
                        'tag' => 'img',
                        'value' => $model->guid,
                        'options' => [
                            'style' => "width: 4cm; height: 1cm;",
                        ],
                        'pluginOptions' => [
                            'displayValue' => false,
                        ],
                    ]);;
                },
                'format' => 'raw',
            ],
            [
                'class' => ActionColumn::className(),
                'buttons' =>
                [
                    'activation' => function ($url, $model, $key) {
                        return Html::a('<span class="btn-xs btn-success glyphicon glyphicon-plus"></span>', $url,
                            [
                                'title' => Yii::t('yii', 'Активация'),
                                'aria-label' => Yii::t('yii', 'Активация'),
                                // 'target' => '_blank',
                            ],
                        );
                    },
                    'deactivation' => function ($url, $model, $key) {
                        return Html::a('<span class="btn-xs btn-warning glyphicon glyphicon-minus"></span>', $url,
                            [
                                'title' => Yii::t('yii', 'Деактивация'),
                                'aria-label' => Yii::t('yii', 'Деактивация'),
                                // 'target' => '_blank',
                            ],
                        );
                    }
                ],
                'template' => '{view} {delete} {update} {activation} {deactivation}',
                'urlCreator' => function ($action, GenTeamMembers $model, $key, $index, $column) {
                    return Url::toRoute([$action, 'id' => $model->id]);
                 }
            ],
        ],
    ]);

    $model->unsetSession();
    ?>


</div>
