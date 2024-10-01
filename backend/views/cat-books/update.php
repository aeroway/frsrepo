<?php

use yii\helpers\Html;

/** @var yii\web\View $this */
/** @var backend\models\CatBooks $model */

$this->title = 'Редактировать: ' . $model->title;
$this->params['breadcrumbs'][] = ['label' => 'Книги', 'url' => ['index']];
$this->params['breadcrumbs'][] = ['label' => $model->title, 'url' => ['view', 'id' => $model->id]];
$this->params['breadcrumbs'][] = 'Редактировать';
?>
<div class="cat-books-update">

    <h1><?php // echo Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
        'selectedAuthors' => $selectedAuthors,
    ]) ?>

</div>
