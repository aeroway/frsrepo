<?php

use yii\helpers\Html;
use yii\grid\GridView;

/* @var $this yii\web\View */
/* @var $searchModel backend\models\InventoryRepairSearch */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = 'Техника на ремонт';
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="inventory-repair-index">

    <h1><?= Html::encode($this->title) ?></h1>

    <p>
        <?php if (in_array("ИТО", Yii::$app->user->identity->groups)): ?>
            <?= Html::a('Добавить', ['create'], ['class' => 'btn btn-success']) ?>
        <?php endif; ?>
        <?= Html::a('Образец накладной на внутреннее перемещение', 'docs/obrazec_nakladnoi_vnut_perem.xls', ['class' => 'btn btn-info']) ?>
    </p>

    <?php // echo $this->render('_search', ['model' => $searchModel]); ?>

    <?php
    if(in_array("ИТО", Yii::$app->user->identity->groups)) {
        $button = [
            'class' => 'yii\grid\ActionColumn',
            'buttons'=>
            [
                'log'=>function ($url, $model)
                {
                    $options = [
                        'title' => Yii::t('yii', 'История'),
                        'aria-label' => Yii::t('yii', 'История'),
                    ];
                    $customurl = Yii::$app->getUrlManager()->createUrl(['inventory-repair/log', 'id' => $model['id']]);

                    return Html::a('<span class="glyphicon glyphicon-calendar"></span>', $customurl, $options);
                },
            ],    
            'template'=>'{view} {update} {delete} {log}',
        ];
    } else {
        $button = [
            'class' => 'yii\grid\ActionColumn',
            'template'=>'{view}',
        ];    
    }
    ?>

    <?= GridView::widget([
        'dataProvider' => $dataProvider,
        'filterModel' => $searchModel,
        'columns' => [
            ['class' => 'yii\grid\SerialColumn'],

            // 'id',
            'area',
            'name',
            'invnum',
            'inventory_moo',
            'inventory_status',
            [
                'attribute' => 'date_edit',
                'format' =>  ['date', 'php:d M Y'],
            ],
            'note',

            $button,
        ],
    ]); ?>


</div>
