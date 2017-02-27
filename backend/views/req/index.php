<?php

use yii\helpers\Html;
use yii\grid\GridView;

use yii\bootstrap\Modal;
use yii\bootstrap\ActiveForm;
//use yii\bootstrap\BaseHtml;
use yii\widgets\Pjax;
use yii\helpers\ArrayHelper;
use backend\models\ReqSt;

/* @var $this yii\web\View */
/* @var $searchModel backend\models\ReqSearch */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = 'Заявки на получение правоустанавливающих документов';
$this->params['breadcrumbs'][] = $this->title;

?>

<?php
$statusbutton = 
[
    'ccuruser'=>function ($url, $model)
    {
        $options = [
            'title' => Yii::t('yii', 'Назначить исполнителя'),
            'aria-label' => Yii::t('yii', 'Curuser'),
            'data-toggle' => Yii::t('yii', 'modal'),
            'data-target' => Yii::t('yii', '#w1'),
        ];

        if(empty(Yii::$app->request->queryParams["page"]))
        {
            $page = 1;
        }
        else 
        {
            $page = Yii::$app->request->queryParams["page"];
        }

        if(empty(Yii::$app->request->queryParams["sort"]))
        {
            $sort = '';
        }
        else
        {
            $sort = Yii::$app->request->queryParams["sort"];
        }

        if(empty(Yii::$app->request->queryParams['ReqSearch']['status']))
        {
            $status = '';
        }
        else
        {
            $status = Yii::$app->request->queryParams['ReqSearch']['status'];
        }

        if(!empty(Yii::$app->request->queryParams["ReqSearch"]["id"]))
            $idReqsearch = Yii::$app->request->queryParams["ReqSearch"]["id"];
        else
            $idReqsearch = '';

        $url=Yii::$app->getUrlManager()->createUrl(['req/setcuruser', 'id' => $model["id"], 'page' => $page, 'sort' => $sort, 'status' => $status, 'idReqsearch' => $idReqsearch]);

        return Html::a('<span class="glyphicon glyphicon-send"></span>', $url, $options);
    },
    'log'=>function ($url, $model)
    {
        $options = [
            'title' => Yii::t('yii', 'История'),
            'aria-label' => Yii::t('yii', 'История'),
        ];
        $url=Yii::$app->getUrlManager()->createUrl(['req/log','logid'=>$model['id']]);
            return Html::a('<span class="glyphicon glyphicon-calendar"></span>', $url, $options);
    },
    'cdatereturn'=>function ($url, $model)
    {
        $options = [
            'title' => Yii::t('yii', 'Назначить дату возврата'),
            'aria-label' => Yii::t('yii', 'Return'),
            'data-toggle' => Yii::t('yii', 'modal'),
            'data-target' => Yii::t('yii', '#w1'),
        ];

        if(empty(Yii::$app->request->queryParams["page"]))
        {
            $page = 1;
        }
        else 
        {
            $page = Yii::$app->request->queryParams["page"];
        }

        if(empty(Yii::$app->request->queryParams["sort"]))
        {
            $sort = '';
        }
        else
        {
            $sort = Yii::$app->request->queryParams["sort"];
        }

        $url=Yii::$app->getUrlManager()->createUrl(['req/createdatereturn','id'=>$model['id'], 'page'=>$page, 'sort'=>$sort]);
            return Html::a('<span class="glyphicon glyphicon-time"></span>', $url, $options);
    },
];

if(in_array("alvl4", Yii::$app->user->identity->groups))
{
    $buttons =     [
                    'class' => 'yii\grid\ActionColumn',
                    'buttons'=>$statusbutton,
                    'template' => '{view} {update} {cdatereturn} {log} {ccuruser}',
                    'contentOptions'=>['style'=>'width: 31px;'],
                ];
}
elseif (in_array("alvl3", Yii::$app->user->identity->groups))
{
    $buttons =  [
                    'class' => 'yii\grid\ActionColumn',
                    'buttons'=>$statusbutton,
                    'template' => '{view} {ccuruser}',
                    'contentOptions'=>['style'=>'width: 31px;'],
                ];
}
elseif (in_array("alvl2", Yii::$app->user->identity->groups))
{
    $buttons =  [
                    'class' => 'yii\grid\ActionColumn',
                    'template' => '{view}',
                    'contentOptions'=>['style'=>'width: 31px;'],
                ];    
}
elseif (in_array("alvl1", Yii::$app->user->identity->groups))
{
    $buttons =  [
                    'class' => 'yii\grid\ActionColumn',
                    'template' => '{view} {delete}',
                    'contentOptions'=>['style'=>'width: 31px;'],
                ];
}
?>

<div class="req-index">

    <h1><?= Html::encode($this->title) ?></h1>
    <?= $this->render('_search', ['model' => $searchModel]); ?>

    <p>
        <?php
            if(in_array("alvl1", Yii::$app->user->identity->groups))
            {
                echo Html::a('Создать', ['create'], ['class' => 'btn btn-success']);
            }
        ?>
        <?= Html::a('Сброс фильтров', ['index'], ['class' => 'btn btn-warning']); ?>

        <?php if(in_array("alvl3", Yii::$app->user->identity->groups) or in_array("alvl4", Yii::$app->user->identity->groups)) : ?>
        <?php $urlm = Yii::$app->getUrlManager()->createUrl(['req/print','status' => 5]); ?>
        <?= Html::a('Печать Мачуга', $urlm, ['class' => 'btn btn-success']); ?>
        <?php $urlf = Yii::$app->getUrlManager()->createUrl(['req/print','status' => 6]); ?>
        <?= Html::a('Печать Фурманова', $urlf, ['class' => 'btn btn-success']); ?>
        <?php endif; ?>
    </p>

<?php
Modal::begin([
    'header' => '<h3>Указать</h3>',
]);
    ActiveForm::begin();
    echo '<div id="req-setup"></div>';
    ActiveForm::end();
Modal::end();
?>

<?php Pjax::begin(); ?>    
    <?= GridView::widget([
        'dataProvider' => $dataProvider,
        'filterModel' => $searchModel,
        'rowOptions' => function($model)
        {
            if(date('Y-m-d',strtotime($model->date_return)) <= date('Y-m-d') and $model->date_return <> NULL) return ['class' => 'danger'];
        },
        'columns' => [
            //['class' => 'yii\grid\SerialColumn'],
            [
                'attribute' => 'id',
                //'contentOptions', 'headerOptions'
                'contentOptions' => function ($model) {
                    if($model->fast == 1) 
                        return ['style' => 'background-color: orange;'];
                    else 
                        return ['style' => 'text-align: center;width: 80px;'];
                },
            ],
            [
                //'attribute' => 'reqsReqSt.text',
                'attribute' => 'status',
                'label' => 'Статус',
                'format' => 'html',
                'value' => 'IconStatus',
                'contentOptions'=>['style'=>'text-align: center; width: 65px;'],
                'filter' => Html::activeDropDownList($searchModel, 'status', ArrayHelper::map(ReqSt::find()->asArray()->all(), 'id', 'text'),['class'=>'form-control','prompt' => 'Все статусы']),
            ],
            [
                //'attribute' => 'typesType.text',
                'attribute' => 'iconType',
                'label' => 'Материал',
                'format' => 'html',
                'value' => 'IconType',
                'contentOptions'=>['style'=>'text-align: center; width: 90px;'],
            ],
            [
                //'attribute' => 'obj_addr',
                'attribute' => 'fullAddress',
                'label' => 'Адрес',
                'format' => 'html',
                'value' => 'fullAddress',
                'contentOptions' => ['style'=>'width: 200px;'],
            ],
            [
                'attribute' => 'kn',
                'label' => 'Кадастровый №',
                'contentOptions' => ['style'=>'width: 180px;'],
            ],
            [
                'attribute' => 'kuvd',
                'contentOptions' => ['style'=>'width: 190px;'],
            ],
            [
                //'attribute' => 'zayavitel_fio',
                'attribute' => 'findOrg',
                'label' => 'Заявитель',
                'format' => 'html',
                'value' => 'findOrg',
                'contentOptions' => ['style'=>'width: 135px;'],
            ],
            [
                'attribute' => 'user_text',
                'label' => 'Пользователь',
                'contentOptions'=>['style'=>'width: 130px;'],
            ],
            //'user_to',
            //[
                //'attribute' => 'otdelsOtdel.text',
                //'label' => 'Отдел',
            //],
            [
                'attribute' => 'date_in',
                //'format' => ['raw', 'Y-m-d H:i:s'],
                'format' =>  ['date', 'php:d.m.Y H:i:s'],
                'contentOptions' => ['style'=>'width: 90px;'],
            ],
            [
                'attribute' => 'cur_user',
                'contentOptions'=>['style'=>'width: 115px;'],
            ],
            //[
                //'attribute' => 'user_print',
                //'contentOptions'=>['style'=>'width: 115px;'],
            //],
            //[
                //'attribute' => 'date_return',
                //'label' => 'Возврат',
                //'format' =>  ['date', 'php:d.m.Y'],
                //'contentOptions' => ['style'=>'width: 90px;'],
            //],

            // 'zayavitel_num',
            // 'obj_id',
            // 'kuvd_id',
            // 'date_in',
            // 'coment',
            // 'cel',
            // 'date_end',
            // 'fast',
            // 'phone',
            // 'vedomost_num',
            // 'user_last',
            // 'vedomost_unform',
            // 'srok',
            // 'print_date',
            'code_mesto',
            // 'date_v',
            // 'area_id',
            // 'org',
            // 'inn',

            //[
                //'attribute' => 'areasArea.name',
                //'label' => 'Район',
            //],

            $buttons,

            //['class' => 'yii\grid\ActionColumn'],

        ],
    ]); ?>

<?php Pjax::end(); ?>

</div>
