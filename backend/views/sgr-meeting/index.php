<?php

use yii\helpers\Html;
use yii\helpers\Url;
use yii\grid\ActionColumn;
use yii\grid\GridView;
use backend\models\SgrMeeting;

/* @var $this yii\web\View */
/* @var $searchModel backend\models\SgrMeetingSearch */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = 'Заседания';
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="sgr-meeting-index">

    <h1><?php // echo Html::encode($this->title) ?></h1>

    <p>
        <?= Html::a('Добавить', ['create'], ['class' => 'btn btn-success']) ?>
        <?= Html::a('Состав совета', ['sgr-members/index'], ['class' => 'btn btn-warning']) ?>
        <?= Html::a('Регламент Совета', ['sgr-regulations/index'], ['class' => 'btn btn-warning']) ?>

        <?php
        $modelSgrMeeting = new SgrMeeting();
        $years = $modelSgrMeeting->getYears();

        foreach ($years as $year) {
            echo Html::a($year["year"], ['index', 'prm' => $year["year"]], ['class' => 'btn btn-info', 'title' => $year["year"]]) . ' ';
        }
        ?>
        
        <?= Html::a('Сброс', ['index'], ['class' => 'btn btn-info', 'title' => 'Сброс']); ?>
    </p>

    <?php // echo $this->render('_search', ['model' => $searchModel]); ?>

    <?php
    $buttons =
    [
        'class' => 'yii\grid\ActionColumn',
        'buttons' =>
        [
            'qfile' => function ($url, $model, $key) {
                if ($model->questions_file) {
                    $urlFile = $model->pathSovGosRegDocMeeting . $model->questions_file;

                    return Html::a('<span class="glyphicon glyphicon-file"></span>', $urlFile,
                        [
                            'title' => Yii::t('yii', 'Скачать материалы'),
                            'aria-label' => Yii::t('yii', 'Скачать материалы'),
                            'target' => '_blank',
                        ],
                    );
                }
            },
            'pfile' => function ($url, $model, $key) {
                if ($model->protocol) {
                    $urlFile = $model->pathSovGosRegDocMeeting . $model->protocol;

                    return Html::a('<span class="glyphicon glyphicon-save-file"></span>', $urlFile,
                        [
                            'title' => Yii::t('yii', 'Скачать протокол'),
                            'aria-label' => Yii::t('yii', 'Скачать протокол'),
                            'target' => '_blank',
                        ],
                    );
                }
            },
        ],
        'template' => '{view} {delete} {update} {qfile} {pfile}',
    ];
    ?>

    <?= GridView::widget([
        'dataProvider' => $dataProvider,
        'filterModel' => $searchModel,
        'columns' => [
            ['class' => 'yii\grid\SerialColumn'],

            // 'id',
            'questions:html',
            'date_event:datetime',
            'status',
            // 'protocol',
            // 'year',
            //'questions_file',

            $buttons,
        ],
    ]); ?>


</div>
