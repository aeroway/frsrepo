<?php

use backend\models\SpartakiadRating;
use yii\helpers\Html;
use yii\helpers\Url;
use yii\grid\ActionColumn;
use kartik\grid\GridView;
use kartik\editable\Editable;
use yii\widgets\Pjax;

/** @var yii\web\View $this */
/** @var backend\models\SpartakiadRatingSearch $searchModel */
/** @var yii\data\ActiveDataProvider $dataProvider */

$this->title = 'Cпартакиада 2024';
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="spartakiad-rating-index">

    <h1><?php // Html::encode($this->title) ?></h1>

    <p>
        <?php // Html::a('Create Spartakiad Rating', ['create'], ['class' => 'btn btn-success']) ?>
    </p>

    <?php // echo $this->render('_search', ['model' => $searchModel]); ?>

    <?php Pjax::begin(); ?>
    <?= GridView::widget([
        'dataProvider' => $dataProvider,
        'filterModel' => $searchModel,
        'columns' => [
            ['class' => 'yii\grid\SerialColumn'],

            // 'id',
            [
                'attribute' => 'department_id',
                'value' => 'department.name',
            ],
            [
                'attribute' => 'score1',
                'class' => 'kartik\grid\EditableColumn',
                'editableOptions'=> function ($model, $key, $index) {
                    return [
                        'header'=>'Редактирование',
                        // 'format' => Editable::FORMAT_BUTTON,
                        'size'=>'md',
                        'formOptions' => ['action' => '/index.php?r=spartakiad-rating/rating'],
                        'inputType'=> Editable::INPUT_TEXT,
                        'valueIfNull' => '-',
                    ];
                },
            ],
            [
                'attribute' => 'score2',
                'class' => 'kartik\grid\EditableColumn',
                'editableOptions'=> function ($model, $key, $index) {
                    return [
                        'header'=>'Редактирование',
                        'size'=>'md',
                        'formOptions' => ['action' => '/index.php?r=spartakiad-rating/rating'],
                        'inputType'=> Editable::INPUT_TEXT,
                        'valueIfNull' => '-',
                    ];
                },
            ],
            [
                'attribute' => 'score3',
                'class' => 'kartik\grid\EditableColumn',
                'editableOptions'=> function ($model, $key, $index) {
                    return [
                        'header'=>'Редактирование',
                        'size'=>'md',
                        'formOptions' => ['action' => '/index.php?r=spartakiad-rating/rating'],
                        'inputType'=> Editable::INPUT_TEXT,
                        'valueIfNull' => '-',
                    ];
                },
            ],
            [
                'attribute' => 'score4',
                'class' => 'kartik\grid\EditableColumn',
                'editableOptions'=> function ($model, $key, $index) {
                    return [
                        'header'=>'Редактирование',
                        'size'=>'md',
                        'formOptions' => ['action' => '/index.php?r=spartakiad-rating/rating'],
                        'inputType'=> Editable::INPUT_TEXT,
                        'valueIfNull' => '-',
                    ];
                },
            ],
            [
                'attribute' => 'score5',
                'class' => 'kartik\grid\EditableColumn',
                'editableOptions'=> function ($model, $key, $index) {
                    return [
                        'header'=>'Редактирование',
                        'formOptions' => ['action' => '/index.php?r=spartakiad-rating/rating'],
                        'inputType'=> Editable::INPUT_TEXT,
                        'valueIfNull' => '-',
                    ];
                },
            ],
            [
                'attribute' => 'score6',
                'class' => 'kartik\grid\EditableColumn',
                'editableOptions'=> function ($model, $key, $index) {
                    return [
                        'header'=>'Редактирование',
                        'asPopover' => false,
                        'formOptions' => ['action' => '/index.php?r=spartakiad-rating/rating'],
                        'inputType'=> Editable::INPUT_TEXT,
                        'valueIfNull' => '-',
                    ];
                },
            ],
            [
                'attribute' => 'sumScore',
                'format' => 'html',
                'value' => function ($model) {
                    return '<b>' . $model->sumScore . '</b>';
                }
            ],
            [
                'class' => ActionColumn::className(),
                'urlCreator' => function ($action, SpartakiadRating $model, $key, $index, $column) {
                    return Url::toRoute([$action, 'id' => $model->id]);
                 }
            ],
        ],
    ]); ?>
    <?php Pjax::end(); ?>


</div>
