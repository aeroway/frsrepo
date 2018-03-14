<?php

use yii\helpers\Html;


/* @var $this yii\web\View */
/* @var $model backend\models\Otchetur */

$this->title = 'Создать';
$this->params['breadcrumbs'][] = ['label' => 'Otcheturs', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="otchetur-create">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
