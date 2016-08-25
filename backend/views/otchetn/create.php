<?php

use yii\helpers\Html;


/* @var $this yii\web\View */
/* @var $model backend\models\Otchetn */

$this->title = 'Create Otchetn';
$this->params['breadcrumbs'][] = ['label' => 'Отчёты', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="otchetn-create">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
