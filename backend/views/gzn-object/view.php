<?php

use yii\helpers\Html;
use yii\widgets\DetailView;

/* @var $this yii\web\View */
/* @var $model backend\models\GznObject */

$this->title = $model->id;
$this->params['breadcrumbs'][] = ['label' => 'Объект проверок', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="gzn-object-view">

    <h1><?= Html::encode($this->title) ?></h1>

    <p>
        <?= Html::a('Редактировать', ['update', 'id' => $model->id], ['class' => 'btn btn-primary']) ?>
        <?php
        if(in_array("GznDelete", Yii::$app->user->identity->groups)) {
            echo Html::a('Удалить', ['delete', 'id' => $model->id], [
                'class' => 'btn btn-danger',
                'data' => [
                    'confirm' => 'Are you sure you want to delete this item?',
                    'method' => 'post',
                ],
            ]);
        }
        ?>
    </p>

    <?= DetailView::widget([
        'model' => $model,
        'attributes' => [
            //'id',
            [
                'attribute' => 'gznTypeCheckName',
                'label' => 'Тип проверки',
            ],
            'authoritie_check',
            'kn',
            'land_num',
            [
                'attribute' => 'land_area',
                'value' => Yii::$app->formatter->asDecimal($model->land_area, 1),
            ],
            'kn_cost',
            'order_check',
            'act_check',
            [
                'attribute' => 'date_enforcement',
                'format' =>  ['date', 'php:d M Y'],
            ],
            'land_category',
            [
                'attribute' => 'landCategory.name',
                'label' => 'Категория земель',
            ],
            [
                'attribute' => 'landUserCategory.name',
                'label' => 'Категория землепользователя',
            ],
            'requisites_land_user',
            'address_land_plot',
            'type_func_use',
            'description_violation',
            'full_name_inspector',
            [
                'attribute' => 'areaOtchet.name',
                'label' => 'Привязан к району',
            ],
            'date_check',
        ],
    ]) ?>

</div>
