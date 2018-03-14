<?php

use yii\helpers\Html;
use yii\grid\GridView;
use yii\helpers\Url;
use backend\models\GznViolationsSearch;
use backend\models\GznTypeCheck;
use yii\helpers\ArrayHelper;


/* @var $this yii\web\View */
/* @var $searchModel backend\models\GznObjectSearch */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = 'Объект проверок';
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="gzn-object-index">

    <h1><?= Html::encode($this->title) ?></h1>
    <?php // echo $this->render('_search', ['model' => $searchModel]); ?>

    <p>
    <?php
        if(in_array("GznEdit", Yii::$app->user->identity->groups) || in_array("GznDelete", Yii::$app->user->identity->groups))
        {
            echo Html::a('Создать', ['create'], ['class' => 'btn btn-success']);
        }
    ?>
    </p>

    <?php

    if((in_array("GznView", Yii::$app->user->identity->groups))) {
        $template = '{view}';
    } elseif(in_array("GznEdit", Yii::$app->user->identity->groups) || in_array("GznView", Yii::$app->user->identity->groups)) {
        $template = '{create} {view} {update}';
    } elseif(in_array("GznEdit", Yii::$app->user->identity->groups) || in_array("GznDelete", Yii::$app->user->identity->groups) || in_array("GznView", Yii::$app->user->identity->groups)) {
        $template = '{create} {view} {update} {delete}';
    } else {
        $template = '';
    }

    $button =
    [
        'class' => 'yii\grid\ActionColumn',
        'buttons' =>
        [
            'create' => function($url, $model)
            {
                $options = [
                    'title' => Yii::t('yii', 'Добавить нарушение'),
                    'aria-label' => Yii::t('yii', 'Добавить нарушение'),
                ];

                $url = Yii::$app->getUrlManager()->createUrl(['gzn-violations/create', 'sid' => $model['id']]);

                return Html::a('<span class="glyphicon glyphicon-plus"></span>', $url, $options);
            },
            'view' => function($url, $model)
            {
                $options = [
                    'title' => Yii::t('yii', 'Просмотр'),
                    'aria-label' => Yii::t('yii', 'Просмотр'),
                ];

                $url = Yii::$app->getUrlManager()->createUrl(['gzn-object/view', 'id' => $model['id']]);

                return Html::a('<span class="glyphicon glyphicon-eye-open"></span>', $url, $options);
            },
            'update' => function($url, $model, $key)
            {
                $options = [
                    'title' => Yii::t('yii', 'Редактировать'),
                    'aria-label' => Yii::t('yii', 'Редактировать'),
                ];

                if(empty(Yii::$app->request->queryParams["page"])) {
                    $page = 1;
                } else {
                    $page = Yii::$app->request->queryParams["page"];
                }
                if(empty(Yii::$app->request->queryParams["sort"])) {
                    $sort = '';
                } else {
                    $sort = Yii::$app->request->queryParams["sort"];
                }

                $url = Yii::$app->getUrlManager()->createUrl(['gzn-object/update', 'id' => $model['id'], 'page' => $page, 'sort' => $sort]);

                return Html::a('<span class="glyphicon glyphicon-pencil"></span>', $url, $options);
            }
        ],
        'template' => $template,
    ];
    ?>

    <?= GridView::widget([
        'dataProvider' => $dataProvider,
        'filterModel' => $searchModel,
        'columns' => [
            ['class' => 'yii\grid\SerialColumn'],

            //'id',
            [
                'attribute' => 'gzn_type_check_id',
                'value' => function($data) {
                    return Html::a(Html::encode($data->gznTypeCheckName), Url::to(['gzn-violations/index', 'id' => $data['id']]));
                },
                'format' => 'raw',
                'filter' => ArrayHelper::map(GznTypeCheck::find()->asArray()->all(), 'name', 'name'),
            ],
            [
                'attribute' => 'authoritie_check',
                'filter' => ['МВД' => 'МВД', 'МЗК' => 'МЗК', 'КубЗК' => 'КубЗК', 'Прокуратура' => 'Прокуратура', 'ТО' => 'ТО', 'ТО внеплан' => 'ТО внеплан', 'ТО 28.1' => 'ТО 28.1'],
            ],
            'kn',
            // 'land_num',
            /*
            [
                'attribute' => 'land_area',
                'value' => function($data) {
                    return Yii::$app->formatter->asDecimal($data->land_area, 1);
                },
            ],
            */
            // 'kn_cost',
            // 'order_check',
            'act_check',
            // 'date_enforcement',
            // 'land_category',
            // 'requisites_land_user',
            'address_land_plot',
            // 'type_func_use',
            // 'description_violation',
            'full_name_inspector',
            [
                'attribute' => 'areaOtchetName',
                'label' => 'Отдел',
                'value' => function($data) {
                    return $data->areaOtchetName;
                },
            ],
            [
                'attribute' => 'success',
                'label' => 'Результат',
                'format' => 'html',
                'value' => 'IconStatus',
                'contentOptions'=>['style' => 'text-align: center;'],
                'filter' => ['1' => '✔ - Результативный', '0' => '✖ - Нерезультативный'],
            ],
            [
                'attribute' => 'checklist',
                'label' => 'ЕРП',
                'format' => 'html',
                'value' => 'IconСhecklist',
                'contentOptions'=>['style' => 'text-align: center;'],
                'filter' => ['1' => '✔ - Проверка внесена в ЕРП', '0' => '✖ - Проверка не внесена ЕРП'],
            ],

            //['class' => 'yii\grid\ActionColumn'],
            $button,
        ],
    ]); ?>
</div>
