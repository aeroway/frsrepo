<?php

use yii\helpers\Html;


/* @var $this yii\web\View */
/* @var $model backend\models\OraDopDoc */

$this->title = 'Create Ora Dop Doc';
$this->params['breadcrumbs'][] = ['label' => 'Ora Dop Docs', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="ora-dop-doc-create">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
