<?php

use yii\helpers\Html;
use yii\grid\GridView;

/* @var $this yii\web\View */
/* @var $searchModel backend\models\ReqLogSearch */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = 'Заявки на получение правоустанавливающих документов';
$this->params['breadcrumbs'][] = ['label' => 'Заявки', 'url' => ['index']];
//$this->params['breadcrumbs'][] = $this->title;

?>

<div class="req-log">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= GridView::widget([
        'dataProvider' => $dataProvider,
        //'filterModel' => $searchModel,
        'columns' => [
            //['class' => 'yii\grid\SerialColumn'],
            [
                'attribute' => 'id',
                'contentOptions'=>['style'=>'text-align: center;width: 80px;'],
                //'contentOptions', 'headerOptions'
            ],
            [
                //'attribute' => 'reqsReqSt.text',
                'attribute' => 'IconStatus',
                'label' => 'Статус',
                'format' => 'html',
                'value' => 'IconStatus',
                'contentOptions'=>['style'=>'text-align: center; width: 65px;'],
            ],
            [
                //'attribute' => 'typesType.text',
                'attribute' => 'IconType',
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
            //*Для кого 'user_to',
            /*[
                'attribute' => 'otdelsOtdel.text',
                'label' => 'Отдел',
            ],*/
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
            [
                'attribute' => 'user_print',
                'contentOptions'=>['style'=>'width: 115px;'],
            ],
            'log_user',
            [
                'attribute' => 'date_return',
                'format' =>  ['date', 'php:d.m.Y'],
                'contentOptions' => ['style'=>'width: 90px;'],
            ],
            // 'zayavitel_num',
            // 'obj_id',
            // 'kuvd_id',
            //'date_in',
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
            // 'code_mesto',
            // 'date_v',
            // 'area_id',
            // 'org',
            // 'inn',

            /*
            [
                'attribute' => 'areasArea.name',
                'label' => 'Район',
            ],
            */

            /* Стандартное отображение кнопок
            [
                'class' => 'yii\grid\ActionColumn',
                //'options'=>['style'=>'width: 50px;']
            ],
            */
        ],
    ]); ?>

</div>
