<?php

use yii\helpers\Html;


/* @var $this yii\web\View */
/* @var $model backend\models\OraKuvdMain */

$this->title = 'Create Ora Kuvd Main';
$this->params['breadcrumbs'][] = ['label' => 'Ora Kuvd Mains', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="ora-kuvd-main-create">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
