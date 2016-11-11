<?php

use yii\helpers\Html;
use yii\grid\GridView;

/* @var $this yii\web\View */
/* @var $searchModel backend\models\PoItemSearch */
/* @var $dataProvider yii\data\ActiveDataProvider */

//$this->title = 'Все заявки';
//$this->params['breadcrumbs'][] = $this->title;
?>
<div class="po-item-index">

    <?= GridView::widget([
        'dataProvider' => $dataProvider,
        'filterModel' => $searchModel,
        'columns' => [
            ['class' => 'yii\grid\SerialColumn'],
            //'id',
            'partsname_invpo',
            'count_invpo',
        ],
    ]); ?>
</div>
