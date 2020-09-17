<?php

use yii\helpers\Html;

/* @var $this yii\web\View */
/* @var $model backend\models\DocSrchReq */

$this->title = 'Создать запрос';
$this->params['breadcrumbs'][] = ['label' => 'Запрос на поиск документов для передачи в МФЦ', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="doc-srch-req-create">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
