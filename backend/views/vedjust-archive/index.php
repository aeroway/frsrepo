<?php

use yii\helpers\Html;
use yii\grid\GridView;

/* @var $this yii\web\View */
/* @var $searchModel backend\models\VedjustArchiveSearch */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = 'Приём дел в архив';
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="vedomost-check-form-index">

    <h1><?php // echo Html::encode($this->title) ?></h1>

    <p>
        <?php // echo Html::a('Добавить', ['create'], ['class' => 'btn btn-success']) ?>
    </p>

    <?= $this->render('_add', ['model' => $model]); ?>

    <?= GridView::widget([
        'dataProvider' => $dataProvider,
        'filterModel' => $searchModel,
        'columns' => [
            ['class' => 'yii\grid\SerialColumn'],

            // 'id',
            'date_in',
            'user_in',
            ['attribute' => 'vedomost_num', 'label' => '№ вед.'],
            ['value' => 'vedComment', 'label' => 'Комментарий'],
            ['value' => 'affairsCount', 'label' => 'Дела'],
            //'vedomost_date',
            //'vedomost_res',
            //'check_type',
            //'module',
            //'ip',
            //'sektors_ip',
            //'dt_fr',

            ['class' => 'yii\grid\ActionColumn'],
        ],
    ]); ?>


</div>
