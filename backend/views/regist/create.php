<?php

use yii\helpers\Html;

/* @var $this yii\web\View */
/* @var $model backend\models\Regist */

$this->title = 'Создать элемент';
$this->params['breadcrumbs'][] = ['label' => '214-ФЗ и объекты действующие', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="regist-create">

    <h1><?php //echo Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
