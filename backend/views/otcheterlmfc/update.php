<?php

use yii\helpers\Html;

/** @var yii\web\View $this */
/** @var backend\models\Otcheterlmfc $model */

$this->title = 'Редактировать: ' . $model->ref_num;
$this->params['breadcrumbs'][] = ['label' => 'Ошибки МФЦ', 'url' => ['index']];
$this->params['breadcrumbs'][] = ['label' => $model->ref_num, 'url' => ['view', 'id' => $model->id]];
$this->params['breadcrumbs'][] = 'Редактировать';
?>
<div class="otcheterlmfc-update">

<h1><?php // echo Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
