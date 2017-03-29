<?php

use yii\helpers\Html;
use yii\widgets\DetailView;

/* @var $this yii\web\View */
/* @var $model backend\models\PurchasePlan */

$this->params['breadcrumbs'][] = ['label' => 'Смета', 'url' => ['spending/index']];
$this->title = $model->id;
$this->params['breadcrumbs'][] = ['label' => 'План закупок', 'url' => ['index', 'id' => $model->st_id]];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="purchase-plan-view">

    <h1><?= Html::encode($this->title) ?></h1>

    <p>
        <?= Html::a('Редактировать', ['update', 'id' => $model->id, 'sort' => '', 'page' => ''], ['class' => 'btn btn-primary']) ?>
    </p>

    <?= DetailView::widget([
        'model' => $model,
        'attributes' => [
            //'id',
            //'type',
            'okpd',
            'name_object',
            'outlay',
            'p_year',
            'c_year',
            'special',
            //'sum',
            'year',
        ],
    ]) ?>

</div>
