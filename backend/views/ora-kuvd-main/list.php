<?php

use yii\helpers\Html;
use yii\grid\GridView;
use backend\models\AreaOtchet;

/* @var $this yii\web\View */
/* @var $searchModel backend\models\OraKuvdMainSearch */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = $otdel;
$this->params['breadcrumbs'][]= ['label' => 'Отделы', 'url' => ['ora-kuvd-main/index']];
$this->params['breadcrumbs'][] = $this->title;

?>
<div class="ora-kuvd-main-index">

    <h1><?= Html::encode($this->title) ?></h1>
    <?php // echo $this->render('_search', ['model' => $searchModel]); ?>


    <?= GridView::widget([
        'dataProvider' => $dataProvider,
        'filterModel' => $searchModel,
        'tableOptions' => [
            'class' => 'table table-striped table-bordered table-hover'
        ],
        'columns' => [
            ['class' => 'yii\grid\SerialColumn'],
            [
                'attribute'=>'otdel',
                'label'=>'Отдел',
                'filter'    =>  $filials,
                'content'   =>  function($data) {
                    return AreaOtchet::find()->where(['fl'=>$data->otdel])->one()->name;    
                }
            ],
            [
                'attribute'=>'fio',                
            ],
            'vsego',
            [
                'attribute' =>  'pr',

                'content'   =>  function($model) {
                    $style= ($model->prProcent > 18) ? 'color:red' : '' ;

                    return Html::a($model->pr.' ('.$model->prProcent.'%)',['ora-kuvd-main/details', 't' => '6','fio'=>$model->fio,'fl'=>$model->otdel],['target'=>'_blanc','style'=>$style,'title'=>'Приостановки от общего кол-ва заявлений']);
               },
            ],
            //'pr',
            [
                'attribute' =>  'otkaz',
                'content'   =>  function($model) {
                    $style= ($model->prProcent > 18) ? 'color:red' : '' ;
                    return Html::a($model->otkaz.' ('.$model->otkazProcent.'%)',['ora-kuvd-main/details', 't' => '7','fio'=>$model->fio,'fl'=>$model->otdel],['target'=>'_blanc','style'=>$style,'title'=>'Отказы от общего кол-ва заявлений']);
                },
            ],
            
            [
                'attribute' =>  'doublepr',
                'content'   =>  function($data) use ($params){
                    return Html::a($data->doublepr,['ora-kuvd-main/details', 't' => '2','fio'=>$data->fio,'fl'=>$data->otdel],['title'=>'Приостановка не снята после рассмотрения дополнительных документов']);
                }
            ],
            [
                'attribute' =>  'noUvedoml',
                'content'   =>  function($data) use ($params){
                    return Html::a($data->noUvedoml,['ora-kuvd-main/details', 't' => '4','fio'=>$data->fio,'fl'=>$data->otdel]);
                }
            ],
            [
                'attribute' =>  'prSdopom',
                 'content'   =>  function($data){
                    return Html::a($data->prSdopom,['ora-kuvd-main/details', 't' => '1','fio'=>$data->fio,'fl'=>$data->otdel]);
                },
            ],
            [
                'attribute' =>  'prosrPR',
                'content'   =>  function($data) {
                    $style = ($data->prosrPR > 0) ? 'color:red' : '' ;
                    return Html::a($data->prosrPR,['ora-kuvd-main/details', 't' => '5','fio'=>$data->fio,'fl'=>$data->otdel],['style'=>$style,'title'=>'Срок приостановки истёк']);
                }
            ],
        ],
    ]); ?>
</div>
