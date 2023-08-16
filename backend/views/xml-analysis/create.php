<?php

use yii\helpers\Html;

/* @var $this yii\web\View */
/* @var $model backend\models\XmlAnalysis */

$this->title = 'Create Xml Analysis';
$this->params['breadcrumbs'][] = ['label' => 'Xml Analyses', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="xml-analysis-create">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
