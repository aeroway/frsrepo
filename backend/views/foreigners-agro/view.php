<?php

use yii\helpers\Html;
use yii\widgets\DetailView;

/** @var yii\web\View $this */
/** @var backend\models\ForeignersAgro $model */

$this->title = $model->kn;
$this->params['breadcrumbs'][] = ['label' => 'Иностранцы с/х', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
\yii\web\YiiAsset::register($this);
?>
<div class="foreigners-agro-view">

    <h1><?php // echo Html::encode($this->title) ?></h1>

    <p>
        <?= Html::a('Редактировать', ['update', 'id' => $model->id], ['class' => 'btn btn-primary']) ?>
        <?= Html::a('Удалить', ['delete', 'id' => $model->id], [
            'class' => 'btn btn-danger',
            'data' => [
                'confirm' => 'Are you sure you want to delete this item?',
                'method' => 'post',
            ],
        ]) ?>
    </p>

    <?= DetailView::widget([
        'model' => $model,
        'attributes' => [
            // 'id',
            'kn',
            'address',
            'category',
            'permit_use',
            'num_reg',
            'date_reg:date',
            'date_term_right:date',
            'fio',
            'citizenship',
            'notice_ogv_oms',
            'notice_prosecutor',
            'sent_claims_ogv',
            'notice_interior_portal',
        ],
    ]) ?>

</div>
