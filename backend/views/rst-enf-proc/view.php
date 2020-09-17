<?php

use yii\helpers\Html;
use yii\widgets\DetailView;

/* @var $this yii\web\View */
/* @var $model backend\models\RstEnfProc */

$this->title = $model->num_req;
$this->params['breadcrumbs'][] = ['label' => 'Реестр исполнительных производств', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
\yii\web\YiiAsset::register($this);
?>
<div class="rst-enf-proc-view">

    <h1><?= Html::encode($model->num_req) ?></h1>

    <p>
        <?php echo Html::a('Редактировать', ['update', 'id' => $model->id], ['class' => 'btn btn-primary']) ?>
        <?php /* echo Html::a('Delete', ['delete', 'id' => $model->id], [
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
            'otdel.text',
            'num_req',
            'agency',
            'num_enf_proc',
            'decision',
            'num_notice',
            'num_appeal',
            [
                'attribute' => 'date_edit',
                'format' =>  ['date', 'php:d M Y'],
            ],
            'username',
            'result',
            'comment',
        ],
    ]) ?>

</div>
