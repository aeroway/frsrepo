<?php

use yii\helpers\Html;

/* @var $this yii\web\View */
/* @var $model backend\models\Otvet */

$this->title = 'Добавить ответ';
$this->params['breadcrumbs'][] = ['label' => 'Раздел тестов', 'url' => ['vopros/index']];
$this->params['breadcrumbs'][] = ['label' => 'Вопросы', 'url' => ['vopros/index', 'id' => $modelVopros->otdel_id]];
$this->params['breadcrumbs'][] = ['label' => 'Ответы', 'url' => ['index', 'id' => $modelVopros->id]];
$this->params['breadcrumbs'][] = $this->title;
?>

<div class="otvet-create">

    <h1><?php // Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
