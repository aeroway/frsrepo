<?php

use yii\helpers\Html;
use yii\widgets\DetailView;

/* @var $this yii\web\View */
/* @var $model backend\models\Otchetfns */

$this->title = $model->kn;
$this->params['breadcrumbs'][] = ['label' => 'Перечни без правообладателя', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
\yii\web\YiiAsset::register($this);
?>
<div class="otchetfns-view">

    <h1><?= Html::encode($this->title) ?></h1>

    <p>
        <?= Html::a('Редактировать', ['update', 'id' => $model->id], ['class' => 'btn btn-primary']) ?>
        <?php /* echo Html::a('Удалить', ['delete', 'id' => $model->id], [
            'class' => 'btn btn-danger',
            'data' => [
                'confirm' => 'Are you sure you want to delete this item?',
                'method' => 'post',
            ],
        ]) */ ?>
    </p>

    <?= DetailView::widget([
        'model' => $model,
        'attributes' => [
            // 'id',
            'area',
            'type_obj',
            'kn',
            'address',
            'category',
            'permit_use',
            'square',
            // 'date_reg',
            'info_tax',
            [
                'attribute' => 'flag',
                'value' => function ($model) {
                    if ($model->flag == 0) {
                        return 'Да';
                    } else {
                        return 'Нет';
                    }
                },
            ],
            // 'flag',
            'status',
            // 'in_process',
            // 'remove_reg',
            // 'identified',
            'comment',
            'date',
            'username',
            'status',
            'filename',
            'date_update',
            'date_load',
        ],
    ]) ?>

</div>
