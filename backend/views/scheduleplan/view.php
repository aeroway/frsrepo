<?php

use yii\helpers\Html;
use yii\widgets\DetailView;

/* @var $this yii\web\View */
/* @var $model backend\models\SchedulePlan */

$this->params['breadcrumbs'][] = ['label' => 'Главная', 'url' => ['spending/index']];
//$this->params['breadcrumbs'][] = ['label' => 'План закупок', 'url' => ['purchaseplan/index', 'id' => $modelpp->st_id]];
$this->title = $model->name;
$this->params['breadcrumbs'][] = ['label' => 'План график', 'url' => ['index', 'sid' => $model->pp_id]];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="schedule-plan-view">

    <h1><?= Html::encode($this->title) ?></h1>

    <p>
        <?= Html::a('Редактировать', ['update', 'sid' => $model->id, 'sort' => '', 'page' => ''], ['class' => 'btn btn-primary']) ?>
    </p>

    <?= DetailView::widget([
        'model' => $model,
        'attributes' => [
            'id',
            'name',
            'sum',
            'comment',
            //'pm_id',
            'sum_fact',
            'sum_contract',
            'name_doc',
            'date_doc:date',
            'date_exp_from:date',
            'date_exp_to:date',
            'inn',
            'name_org',
        ],
    ]) ?>

</div>
