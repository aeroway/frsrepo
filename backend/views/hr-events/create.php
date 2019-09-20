<?php

use yii\helpers\Html;

/* @var $this yii\web\View */
/* @var $model backend\models\HrEvents */

$this->title = 'Create Hr Events';
$this->params['breadcrumbs'][] = ['label' => 'Hr Events', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="hr-events-create">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
