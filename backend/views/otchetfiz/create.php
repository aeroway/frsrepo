<?php

use yii\helpers\Html;


/* @var $this yii\web\View */
/* @var $model backend\models\Otchetfiz */

$this->title = 'Создать';
$this->params['breadcrumbs'][] = ['label' => 'Otchetfizs', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="otchetfiz-create">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
