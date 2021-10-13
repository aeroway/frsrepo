<?php

use yii\helpers\Html;
use yii\grid\GridView;

/* @var $this yii\web\View */
/* @var $searchModel backend\models\OtvetSearch */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = 'Ответы';
$this->params['breadcrumbs'][] = ['label' => 'Раздел тестов', 'url' => ['vopros/index']];
$this->params['breadcrumbs'][] = ['label' => 'Вопросы', 'url' => ['vopros/index', 'id' => $modelVopros->otdel_id]];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="otvet-index">

    <h1><?= Html::encode($this->title) ?></h1>

    <p>
        <?= Html::a('Добавить', ['create', 'id' => $modelVopros->id], ['class' => 'btn btn-success']) ?>
    </p>

    <?php // echo $this->render('_search', ['model' => $searchModel]); ?>

    <?= GridView::widget([
        'dataProvider' => $dataProvider,
        'filterModel' => $searchModel,
        'columns' => [
            ['class' => 'yii\grid\SerialColumn'],

            // 'id',
            'text',
            // 'vopros_id',
            [
                'attribute' => 'pr',
                'value' => function($data) {
                    if ($data->pr) {
                        return 'Да';
                    }

                    return 'Нет';
                }
            ],

            [
                'class' => 'yii\grid\ActionColumn',
                'template' => '{update} {delete}',
            ],
        ],
    ]); ?>


</div>
