<?php

use yii\helpers\Html;

/* @var $this yii\web\View */
/* @var $model backend\models\Vopros */

if (Yii::$app->request->get('id') > 0) {
    $this->title = 'Добавить вопрос';
    $this->params['breadcrumbs'][] = ['label' => 'Раздел тестов', 'url' => ['index']];
    $this->params['breadcrumbs'][] = ['label' => 'Вопросы', 'url' => ['index', 'id' => Yii::$app->request->get('id')]];
    $this->params['breadcrumbs'][] = $this->title;
} else {
    $this->title = 'Добавить отдел';
    $this->params['breadcrumbs'][] = ['label' => 'Раздел тестов', 'url' => ['index']];
    $this->params['breadcrumbs'][] = $this->title;
}

?>
<div class="vopros-create">

    <h1><?php // Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
