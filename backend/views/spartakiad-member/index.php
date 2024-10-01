<?php

use backend\models\SpartakiadMember;
use yii\helpers\Html;
use yii\helpers\Url;
use yii\grid\ActionColumn;
use yii\grid\GridView;
use diecoding\barcode\generator\Barcode;

/** @var yii\web\View $this */
/** @var backend\models\SpartakiadMemberSearch $searchModel */
/** @var yii\data\ActiveDataProvider $dataProvider */

$this->title = 'Участники';
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="spartakiad-member-index">

    <h1><?php // Html::encode($this->title) ?></h1>

    <p>
        <?= Html::a('Добавить', ['create'], ['class' => 'btn btn-success']) ?>
        <?= Html::a('Сброс', ['index'], ['class' => 'btn btn-info', 'title' => 'Сброс']); ?>
    </p>

    <?php // echo $this->render('_search', ['model' => $searchModel]); ?>

    <div id="successCheckSpartakiadMemberBarcode" style="display: <?= Yii::$app->session->getFlash('successCheckSpartakiadMemberBarcode'); ?>;">
        <?php if ($model->getStatusBarcode() !== NULL) : ?>
            <?= ($model->getStatusBarcode() > 0) ? '<div class="alert alert-success">Подтвержена запись</div>' : '<div class="alert alert-danger">Запись отсутствует</div>' ?>
        <?php endif; ?>
    </div>

    <?= $this->render('_formSpartakiadMemberBarcode', [
        'model' => $model,
    ]) ?>

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
                'attribute' => 'department_id',
                'value' => 'department.name',
            ],
            'name',
            'sport_type',
            [
                'attribute' => 'guidBarcode',
                'value' => function ($model) {
                    return Barcode::widget([
                        'tag' => 'img',
                        'value' => $model->department_id,
                        'options' => [
                            'style' => "width: 30%",
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
                        $url = Yii::$app->getUrlManager()->createUrl(['spartakiad-member/activation', 'id' => $model['department_id']]);

                        return Html::a('<span class="btn-xs btn-success glyphicon glyphicon-plus"></span>', $url,
                            [
                                'title' => Yii::t('yii', 'Активация'),
                                'aria-label' => Yii::t('yii', 'Активация'),
                                // 'target' => '_blank',
                            ],
                        );
                    },
                    'deactivation' => function ($url, $model, $key) {
                        $url = Yii::$app->getUrlManager()->createUrl(['spartakiad-member/deactivation', 'id' => $model['department_id']]);

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
                'urlCreator' => function ($action, SpartakiadMember $model, $key, $index, $column) {
                    return Url::toRoute([$action, 'id' => $model->id]);
                 }
            ],
        ],
    ]); ?>


</div>
