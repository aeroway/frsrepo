<?php

use yii\helpers\Html;
use yii\grid\GridView;

use yii\helpers\ArrayHelper;
use backend\models\Employee;

/* @var $this yii\web\View */
/* @var $searchModel backend\models\OtchetnSearch */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = 'Отчёты';
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="otchetn-index">

    <h1><?= Html::encode($this->title) ?></h1>
    <?php // echo $this->render('_search', ['model' => $searchModel]); ?>

    <p>
        <?php //Html::a('Создать', ['create'], ['class' => 'btn btn-success']) ?>
    </p>

    <?=Html::beginForm(['otchetn/bulk'],'post');?>
    <?php
    if(in_array("OtchetManager", Yii::$app->user->identity->groups))
    {
        echo Html::dropDownList('action', '', ArrayHelper::map(Employee::find()
            ->where(['and', ['or', ['idm_otdel' => 139], ['idm_otdel' => 3], ['idm_otdel' => 170]], ['status' => 1]])
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
            if($model->flag == 1) return ['class'=>'danger'];
            if($model->flag == 2) return ['class'=>'success'];
        },
        'columns' => [
            ['class' => 'yii\grid\SerialColumn'],
            ['class' => 'yii\grid\CheckboxColumn'],

            //'id',
            'area',
            'condnum',
            'status',
            'reason1',
            [
                'attribute' => 'reason2',
                'contentOptions' => ['title'=>'Количество объектов недвижимости с разбивкой по причинам'],
            ],
            [
                'attribute' => 'offer',
                'contentOptions' => ['title'=>'Предложения по выходу из ситуации (по каждому блоку причин)'],
            ],
            'comment',
            [
                'attribute' => 'dateon',
                'format' =>  ['date', 'php:d M Y'],
                'contentOptions' => ['style'=>'text-align: center;'],
            ],
            'usernameon',
            [
                'attribute' => 'date_load',
                'format' =>  ['date', 'php:d M Y'],
                'contentOptions' => ['style'=>'width: 120px; text-align: center;'],
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
                'class' => 'yii\grid\ActionColumn',
                'template' => '{view} {update}',
            ],
        ],
    ]); ?>
    <?= Html::endForm();?> 

</div>
