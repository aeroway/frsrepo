<?php

use yii\helpers\Html;

/* @var $this yii\web\View */
/* @var $model backend\models\XmlAnalysis */

$this->title = 'Update Xml Analysis: ' . $model->id;
$this->params['breadcrumbs'][] = ['label' => 'Xml Analyses', 'url' => ['index']];
$this->params['breadcrumbs'][] = ['label' => $model->id, 'url' => ['view', 'id' => $model->id]];
$this->params['breadcrumbs'][] = 'Update';
?>
<div class="xml-analysis-update">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
