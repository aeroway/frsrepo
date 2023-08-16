<?php

use yii\helpers\Html;

/* @var $this yii\web\View */
/* @var $model backend\models\XmlAnalysisFns */

$this->title = 'Создать';
$this->params['breadcrumbs'][] = ['label' => 'Xml Analyses', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="xml-analysis-fns-create">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
