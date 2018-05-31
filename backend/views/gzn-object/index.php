<?php

use yii\helpers\Html;
//use yii\grid\GridView;
use kartik\grid\GridView;
use yii\helpers\Url;
use backend\models\GznViolationsSearch;
use backend\models\GznTypeCheck;
use backend\models\GznAuthoritieCheck;
use yii\helpers\ArrayHelper;


/* @var $this yii\web\View */
/* @var $searchModel backend\models\GznViolationsSearch */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = 'Объект проверок';
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="gzn-object-index">

    <h1><?= Html::encode($this->title) ?></h1>
    <?php echo $this->render('_search', ['model' => $searchModel]); ?>

    <p>
        <?php
        if(in_array("GznEdit", Yii::$app->user->identity->groups) || in_array("GznDelete", Yii::$app->user->identity->groups))
        {
            echo Html::a('Создать', ['create'], ['class' => 'btn btn-success']);
        }
        ?>
        <?= Html::a('Сброс фильтров', ['reset'], ['class' => 'btn btn-warning']); ?>
        <?= Html::a('Статистика', ['stat'], ['class' => 'btn btn-info']) ?>
        <?= Html::a('Нарушения', ['gzn-violations/violations'], ['class' => 'btn btn-info']) ?>
        <?= Html::a('Предписания', ['gzn-injunction/injunction'], ['class' => 'btn btn-info']) ?>
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

                $url = Yii::$app->getUrlManager()->createUrl([
                    'gzn-object/update',
                    'id' => $model['id'],
                    //'page' => empty(Yii::$app->request->queryParams["page"]) ? 1 : Yii::$app->request->queryParams["page"],
                    //'sort' => empty(Yii::$app->request->queryParams["sort"]) ? '' : Yii::$app->request->queryParams["sort"],
                ]);

                return Html::a('<span class="glyphicon glyphicon-pencil"></span>', $url, $options);
            }
        ],
        'template' => $template,
    ];
    ?>

    <?= GridView::widget([
        'dataProvider' => $dataProvider,
        'filterModel' => $searchModel,
        'export' => false,
        'pjax' => false,
        'layout' => "{pager}\n{summary}\n{items}\n{pager}\n <h3>Итого: " . $dataProvider->getTotalCount() . '</h3>',
        'rowOptions' => function($model)
        {
            return $model->datePerformancePrescription;
        },
        'containerOptions' => ['style' => 'overflow: visible'],
        'columns' => [
            [
                'class' => 'kartik\grid\ExpandRowColumn',
                'value' => function($model, $key, $index, $column) {
                    return GridView::ROW_COLLAPSED;
                },
                'detail' => function($model, $key, $index, $column) {
                    $searchModel = new GznViolationsSearch();
                    $searchModel->gzn_obj_id = $model->id;
                    $dataProvider = $searchModel->search(Yii::$app->request->queryParams);

                    return Yii::$app->controller->renderPartial('_gznviolation', [
                        'searchModel' => $searchModel,
                        'dataProvider' => $dataProvider,
                    ]);
                },
            ],
            //['class' => 'yii\grid\SerialColumn'],
            //'id',
            [
                'attribute' => 'gzn_type_check_id',
                'value' => function($data) {
                    return Html::a(Html::encode($data->gznTypeCheckName), Url::to(['gzn-violations/index', 'id' => $data['id']]));
                },
                'format' => 'raw',
                'filter' => Html::activeCheckBoxList($searchModel, 'gzn_type_check_id',
                                ArrayHelper::map(GznTypeCheck::find()->asArray()->all(), 'name', 'name'), ['multiple' => true]),
            ],
            [
                'label' => 'Орган проводивший мер-я',
                'attribute' => 'gznAuthoritieCheck.name',
                'format' => 'raw',
                'filter' => Html::activeListBox($searchModel, 'authoritie_check_id', 
                                ArrayHelper::map(GznAuthoritieCheck::find()->asArray()->all(), 'name', 'name'), ['multiple' => true, 'class' => 'form-control']),
            ],
            'order_check',
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
            'act_check',
            [
                'label' => 'Кат. землепользователя',
                'attribute' => 'land_user_category_id',
                'value' => 'landUserCategory.name',
            ],
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
            //Дата выдачи предписания
            [
                'label' => 'Предписания',
                'value' => 'DateIssuePrescription',
                'format' => 'html',
            ],

            //['class' => 'yii\grid\ActionColumn'],
            $button,
        ],
    ]); ?>
</div>
