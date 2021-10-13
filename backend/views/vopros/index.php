<?php

use yii\helpers\Html;
use yii\grid\GridView;

/* @var $this yii\web\View */
/* @var $searchModel backend\models\VoprosSearch */
/* @var $dataProvider yii\data\ActiveDataProvider */

if (Yii::$app->request->get('id') > 0) {
    $this->title = 'Вопросы';
    $this->params['breadcrumbs'][] = ['label' => 'Раздел тестов', 'url' => ['index']];
    $this->params['breadcrumbs'][] = $this->title;
} else {
    $this->title = 'Раздел тестов';
    $this->params['breadcrumbs'][] = $this->title;
}
?>
<div class="vopros-index">

    <h1><?= Html::encode($this->title) ?></h1>

    <p>
        <?php
        if (Yii::$app->request->get('id') > 0) {
            echo Html::a('Добавить', ['create', 'id' => Yii::$app->request->get('id')], ['class' => 'btn btn-success']);
        } else {
            echo Html::a('Добавить', ['create'], ['class' => 'btn btn-success']);
        }
        ?>
    </p>

    <?php // echo $this->render('_search', ['model' => $searchModel]); ?>

    <?php
    if (Yii::$app->request->get('id') > 0) {
        $valueOtdel = function($data) {
            return Html::a(Html::encode($data->text), ['otvet/index', 'id' => $data->id]);
        };
        $labelOtdel = 'Вопрос';
        $buttons = [
            'class' => 'yii\grid\ActionColumn',
            'template' => '{update} {delete}',
        ];
        $columns = [
            ['class' => 'yii\grid\SerialColumn'],
            [
                'attribute' => 'otdel_id',
                'value' => $valueOtdel,
                'format' => 'html',
                'label' => $labelOtdel,
            ],
            [
                'attribute' => 'cnt',
                'label' => 'Кол-во ответов',
            ],
            $buttons,
        ];
    } else {
        $valueOtdel = function($data) {
            return Html::a(Html::encode($data->text), ['vopros/index', 'id' => $data->id]);
        };

        $labelOtdel = 'Отдел';

        $buttons = [
            'class' => 'yii\grid\ActionColumn',
            'buttons' => [
                'update' => function ($url, $model) {
                    $options = [
                        'title' => Yii::t('yii', 'Update'),
                        'aria-label' => Yii::t('yii', 'Update'),
                    ];
                    $url = Yii::$app->getUrlManager()->createUrl(['vopros/update','otdel_id' => $model['id']]);

                    return Html::a('<span class="glyphicon glyphicon-pencil"></span>', $url, $options);
                },
                'result' => function ($url, $model) {
                    $options = [
                        'title' => Yii::t('yii', 'Результат'),
                        'aria-label' => Yii::t('yii', 'Результат'),
                    ];

                    $resultUrl = Yii::$app->getUrlManager()->createUrl(['vopros/result', 'id' => $model['id']]);

                    return Html::a('<span class="glyphicon glyphicon-calendar"></span>', $resultUrl, $options);
                },
            ],
            'template' => '{update} {result}',
        ];

        $columns = [
            ['class' => 'yii\grid\SerialColumn'],
            [
                'attribute' => 'otdel_id',
                'value' => $valueOtdel,
                'format' => 'html',
                'label' => $labelOtdel,
            ],
            [
                'attribute' => 'cnt',
                'label' => 'Кол-во вопросов',
            ],
            'otdel.date_start:datetime',
            'otdel.date_stop:datetime',
            $buttons,
        ];
    }
    ?>

    <?= GridView::widget([
        'dataProvider' => $dataProvider,
        'filterModel' => $searchModel,
        'columns' => $columns,
    ]); ?>

</div>