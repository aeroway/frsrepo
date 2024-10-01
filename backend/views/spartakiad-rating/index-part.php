<?php

use kartik\grid\GridView;
use yii\widgets\Pjax;

/** @var yii\web\View $this */
/** @var backend\models\SpartakiadRatingSearch $searchModel */
/** @var yii\data\ActiveDataProvider $dataProvider */

$this->title = 'Cпартакиада 2024';
$this->params['breadcrumbs'][] = $this->title;
?>

<div class="spartakiad-rating-index-part">
    <table border="0">
    <tbody>
        <tr>
            <td style="padding: 10px; width: 33.33%; vertical-align: top">
                <?php Pjax::begin(['id' => 'pj-1']); ?>
                <?= GridView::widget([
                    'dataProvider' => $dataProvider,
                    'filterModel' => $searchModel,
                    'summary' => false,
                    'filterPosition' => false,
                    'columns' => [
                        ['class' => 'yii\grid\SerialColumn'],

                        [
                            'attribute' => 'department_id',
                            'value' => 'department.name',
                        ],
                        [
                            'attribute' => 'score1',
                            'value' => 'score1',
                            'contentOptions' => ['style'=>'width: 155px; text-align: center;'],
                        ],
                    ],
                ]); ?>
                <?php Pjax::end(); ?>
            </td>
            <td style="padding: 10px; width: 33.33%; vertical-align: top">
                <?php Pjax::begin(['id' => 'pj-2']); ?>
                <?= GridView::widget([
                    'dataProvider' => $dataProvider,
                    'filterModel' => $searchModel,
                    'summary' => false,
                    'filterPosition' => false,
                    'columns' => [
                        ['class' => 'yii\grid\SerialColumn'],

                        [
                            'attribute' => 'department_id',
                            'value' => 'department.name',
                        ],
                        [
                            'attribute' => 'score2',
                            'value' => 'score2',
                            'contentOptions' => ['style'=>'width: 155px; text-align: center;'],
                        ],
                    ],
                ]); ?>
                <?php Pjax::end(); ?>
            </td>
            <td style="padding: 10px; width: 33.33%; vertical-align: top">
                <?php Pjax::begin(['id' => 'pj-3']); ?>
                <?= GridView::widget([
                    'dataProvider' => $dataProvider,
                    'filterModel' => $searchModel,
                    'summary' => false,
                    'filterPosition' => false,
                    'columns' => [
                        ['class' => 'yii\grid\SerialColumn'],

                        [
                            'attribute' => 'department_id',
                            'value' => 'department.name',
                        ],
                        [
                            'attribute' => 'score3',
                            'value' => 'score3',
                            'contentOptions' => ['style'=>'width: 155px; text-align: center;'],
                        ],
                    ],
                ]); ?>
                <?php Pjax::end(); ?>
            </td>
        </tr>
        <tr>
            <td style="padding: 10px; width: 33.33%; vertical-align: top">
                <?php Pjax::begin(['id' => 'pj-4']); ?>
                <?= GridView::widget([
                    'dataProvider' => $dataProvider,
                    'filterModel' => $searchModel,
                    'summary' => false,
                    'filterPosition' => false,
                    'columns' => [
                        ['class' => 'yii\grid\SerialColumn'],

                        [
                            'attribute' => 'department_id',
                            'value' => 'department.name',
                        ],
                        [
                            'attribute' => 'score4',
                            'value' => 'score4',
                            'contentOptions' => ['style'=>'width: 155px; text-align: center;'],
                        ],
                    ],
                ]); ?>
                <?php Pjax::end(); ?>
            </td>
            <td style="padding: 10px; width: 33.33%; vertical-align: top">
                <?php Pjax::begin(['id' => 'pj-5']); ?>
                <?= GridView::widget([
                    'dataProvider' => $dataProvider,
                    'filterModel' => $searchModel,
                    'summary' => false,
                    'filterPosition' => false,
                    'columns' => [
                        ['class' => 'yii\grid\SerialColumn'],

                        [
                            'attribute' => 'department_id',
                            'value' => 'department.name',
                        ],
                        [
                            'attribute' => 'score5',
                            'value' => 'score5',
                            'contentOptions' => ['style'=>'width: 155px; text-align: center;'],
                        ],
                    ],
                ]); ?>
                <?php Pjax::end(); ?>
            </td>
            <td style="padding: 10px; width: 33.33%; vertical-align: top">
                <?php Pjax::begin(['id' => 'pj-6']); ?>
                <?= GridView::widget([
                    'dataProvider' => $dataProvider,
                    'filterModel' => $searchModel,
                    'summary' => false,
                    'filterPosition' => false,
                    'columns' => [
                        ['class' => 'yii\grid\SerialColumn'],

                        [
                            'attribute' => 'department_id',
                            'value' => 'department.name',
                        ],
                        [
                            'attribute' => 'score6',
                            'value' => 'score6',
                            'contentOptions' => ['style'=>'width: 155px; text-align: center;'],
                        ],
                    ],
                ]); ?>
                <?php Pjax::end(); ?>
            </td>
        </tr>
    </tbody>
    </table>
</div>