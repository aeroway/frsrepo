<?php

use yii\helpers\Html;
use yii\grid\GridView;
use backend\models\OraKuvdMain;
use backend\models\ViewByFio;


/* @var $this yii\web\View */
/* @var $searchModel backend\models\OraKuvdMainSearch */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = 'Приостановки в разрезе отделов';
$this->params['breadcrumbs'][]= ['label' => 'Главная', 'url' => ['ora-kuvd-main/index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="ora-kuvd-main-index">

    <h1><?= Html::encode($this->title) ?></h1>
    <?php // echo $this->render('_search', ['model' => $searchModel]); 
    $dataProvider->pagination->pageSize=60;
    
    ?>


    <?= GridView::widget([
        'dataProvider' => $dataProvider,
        'filterModel' => $searchModel,
        'tableOptions' => [
            'class' => 'table table-striped table-bordered table-hover'
        ],
        'columns' => [
            ['class' => 'yii\grid\SerialColumn'],
            [
                'attribute'=>'name',
                'content'   =>  function($model) {
                    return Html::a($model->name,['ora-kuvd-main/list', 'ViewByFioSearch[otdel]' => $model->fl],['target'=>'_blanc']);
                },
                'filter'    =>  $filials,
            ],
            'vsego',
            [
                'attribute' =>  'pr',

                'content'   =>  function($model) {
                    $style= ($model->prProcent > 18) ? 'color:red' : '' ;
                    return Html::a($model->pr.' ('.$model->prProcent.'%)',['ora-kuvd-main/list', 'ViewByFioSearch[otdel]' => $model->fl],['target'=>'_blanc','style'=>$style]);
                },
            ],
            //'pr',
            [
                'attribute' =>  'otkaz',
            ],
            [
                'attribute' =>  'doublepr',
            ],
            [
                'attribute' =>  'noUvedoml',
                'content'   =>  function($model) {
                    $style = ($model->noUvedoml > 18) ? 'color:red' : '' ;
                    return Html::a($model->noUvedoml.' ('.$model->noUvedomlProcent.'%)',['ora-kuvd-main/list', 'ViewByFioSearch[otdel]' => $model->fl],['target'=>'_blanc','style'=>$style,'title'=>'Уведомления не сформированы по '.$model->noUvedomlProcent.'% от всех приостановок отдела']);
                },
            ],
            [
                'attribute' =>  'prSdopom',
            ],
            [
                'attribute' =>  'prosrPR',
                'content'   =>  function($data){
                    $style= ($data->prosrPR > 0) ? 'color:red' : '' ;
                    return Html::a($data->prosrPR,['ora-kuvd-main/list', 'ViewByFioSearch[otdel]' => $data->fl],['style'=>$style,'title'=>'Срок приостановки истёк']);
                }

            ],

            //['class' => 'yii\grid\ActionColumn'],
        ],
    ]); ?>
</div>
