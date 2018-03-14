<?php

use yii\helpers\Html;
use yii\grid\GridView;

use backend\models\Otchett;
use yii\helpers\ArrayHelper;
use backend\models\Employee;
use yii\bootstrap\Alert;

/* @var $this yii\web\View */
/* @var $searchModel backend\models\OtchetSearch */
/* @var $dataProvider yii\data\ActiveDataProvider */

$otchett = new Otchett();

$this->title = 'Отчёт: ' . $otchett->otchetList(Otchett::$name);
$this->params['breadcrumbs'][] = $this->title;

if(Otchett::$name == 'otchet29')
    echo Alert::widget([
        'options' => [
            'class' => 'alert-info'
        ],
        'body' => '<h4>Слева площадь ЕГРП. Справа площадь ГКН.</h4>'
    ]);

?>
<div class="otchet-index">

    <h1><?= Html::encode($this->title) ?></h1>
    <?php // echo $this->render('_search', ['model' => $searchModel]); ?>
    <?php Yii::$app->session->setFlash('table', Otchett::$name); ?>

    <p>
        <?php /* echo Html::a('Create Otchet', ['create'], ['class' => 'btn btn-success']) */ ?>
    </p>

    <?=Html::beginForm(['otchett/bulk'],'post');?>
    <?php
    if(in_array("OtchetManager", Yii::$app->user->identity->groups))
    {
        echo Html::dropDownList('action', '', ArrayHelper::map(Employee::find()
            ->where(['or', ['idm_otdel' => 139], ['idm_otdel' => 3], ['idm_otdel' => 170]])
            ->orderBy(['fam' => SORT_ASC])
            ->all(),
        'fullName', 'fullName'),
        ['class' => 'form-control', 'style' => 'width: 90%; margin-bottom: 10px; margin-right: 10px; float: left']);

        echo Html::submitButton('Назначить', ['class' => 'btn btn-info', 'style' => 'margin-bottom: 10px;']);
    }
    ?>

    <?= GridView::widget([
        'dataProvider' => $dataProvider,
        'filterModel' => $searchModel,
        'rowOptions' => function($model)
        {
            if(isset($model->control) and $model->control == 1) return ['class'=>'warning'];
            if($model->flag == 1) return ['class'=>'danger'];
            if($model->flag == 2) return ['class'=>'success'];
        },
        'columns' => [
            ['class' => 'yii\grid\SerialColumn'],
            ['class' => 'yii\grid\CheckboxColumn'],

            //'id',
            [
                'attribute' => 'kn',
                'contentOptions' => ['style'=>'width: 160px;'],
            ],
            'description',
            'status',
            'comment',
            [
                'attribute' => 'date',
                'format' =>  ['date', 'php:M d Y'],
                'contentOptions' => ['style'=>'width: 120px; text-align: center;'],
            ],
            [
                'attribute' => 'username',
                'contentOptions' => ['style'=>'width: 150px;'],
            ],
            'flag',
            //'id_dpt',
            //'id_egrp',
            /*
            [
                'attribute' => 'date_update',
                'format' =>  ['date', 'php:M d Y'],
                'contentOptions' => ['style'=>'width: 120px; text-align: center;'],
            ],
            */
            //'filename',
            [
                'attribute' => 'date_load',
                'format' =>  ['date', 'php:M d Y'],
                'contentOptions' => ['style'=>'width: 120px; text-align: center;'],
            ],
            'area',
            'protocol',

            //['class' => 'yii\grid\ActionColumn'],
            [
                'class' => 'yii\grid\ActionColumn',
                'buttons' =>
                [
                    'view' => function ($url, $model)
                    {
                        $customurl = Yii::$app->getUrlManager()->createUrl(['otchett/view', 'id' => $model['id'], 'table' => Otchett::$name]);

                        return Html::a('<span class="glyphicon glyphicon-eye-open"></span>', $customurl);
                    },
                    'update' => function ($url, $model)
                    {
                        $customurl = Yii::$app->getUrlManager()->createUrl(['otchett/update', 'id' => $model['id'], 'table' => Otchett::$name]);

                        return Html::a('<span class="glyphicon glyphicon-pencil"></span>', $customurl);
                    }
                ],
                'template' => '{view} {update}',
            ],
        ],
    ]); ?>
    <?= Html::endForm();?> 

</div>
