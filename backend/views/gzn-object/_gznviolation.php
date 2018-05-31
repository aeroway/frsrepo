<?php
use yii\helpers\Html;
//use yii\grid\GridView;
use kartik\grid\GridView;
use backend\models\GznInjunctionSearch;

/* @var $this yii\web\View */
/* @var $searchModel backend\models\GznViolationsSearch */
/* @var $dataProvider yii\data\ActiveDataProvider */

//$this->title = 'Gzn Violations';
//$this->params['breadcrumbs'][] = $this->title;
?>
<div class="gzn-violations-index">

    <?= GridView::widget([
        'dataProvider' => $dataProvider,
        //'filterModel' => $searchModel,
        'export' => false,
        'toggleData' => false,
        'panel'=>[
            'type' => GridView::TYPE_PRIMARY,
            'footer' => false,
            'pjax' => true,
            'bordered' => true,
        ],
        'columns' => [
            //['class' => 'yii\grid\SerialColumn'],
            [
                'class' => 'kartik\grid\ExpandRowColumn',
                'value' => function($model, $key, $index, $column) {
                    return GridView::ROW_COLLAPSED;
                },
                'detail' => function($model, $key, $index, $column) {
                    $searchModel = new GznInjunctionSearch();
                    $searchModel->gzn_violations_id = $model->id;
                    $dataProvider = $searchModel->search(Yii::$app->request->queryParams);

                    return Yii::$app->controller->renderPartial('_gzninjunction', [
                        'searchModel' => $searchModel,
                        'dataProvider' => $dataProvider,
                    ]);
                },
            ],
            [
                'attribute' => 'decision_punishment',
                'format' =>  ['date', 'php:d M Y'],
            ],
            [
                'attribute' => 'amount_fine',
                'value' => function($data) {
                    return Yii::$app->formatter->asDecimal($data->amount_fine, 2);
                },
            ],
            [
                'attribute' => 'amount_fine_collected',
                'value' => function($data) {
                    return Yii::$app->formatter->asDecimal($data->amount_fine, 2);
                },
            ],
            [
                'attribute' => 'decision_cancellation',
                'format' =>  ['date', 'php:d M Y'],
            ],

            //['class' => 'yii\grid\ActionColumn'],
        ],
    ]); ?>

</div>